<?PHP
  namespace Chirp;

  // Original PHP code by Chirp Internet: www.chirp.com.au
  // Please acknowledge use of this code by including this header.

  class RSSParser
  {
    // keeps track of current and preceding elements
    var $tags = [];

    // array containing all feed data
    var $output = [];

    // return value for display functions
    var $retval = "";

    var $errorlevel = 0;

    // constructor for new object
    public function __construct($feed_contents)
    {
      $errorlevel = error_reporting();
      error_reporting($errorlevel & ~E_NOTICE);

      libxml_disable_entity_loader(false);
      $this->output = simplexml_load_string($feed_contents, 'SimpleXMLElement', LIBXML_NOENT);

      error_reporting($errorlevel);
    }

    // display a single channel as HTML
    private function display_channel($data, $limit)
    {
      extract($data);
      if(isset($IMAGE) && $IMAGE) {
        // display channel image(s)
        foreach($IMAGE as $image) {
          $this->display_image($image);
        }
      }
      if($TITLE) {
        // display channel information
        $this->retval .= "<h1>";
        if($LINK) {
          $this->retval .= "<a href=\"$LINK\" target=\"_blank\">";
        }
        $this->retval .= stripslashes($TITLE);
        if($LINK) {
          $this->retval .= "</a>";
        }
        $this->retval .= "</h1>\n";
        if(isset($DESCRIPTION) && $DESCRIPTION) {
          $this->retval .= "<p>$DESCRIPTION</p>\n\n";
        }
        $tmp = [];
        if(isset($PUBDATE) && $PUBDATE) {
          $tmp[] = "<small>Published: $PUBDATE</small>";
        }
        if(isset($COPYRIGHT) && $COPYRIGHT) {
          $tmp[] = "<small>Copyright: $COPYRIGHT</small>";
        }
        if($tmp) {
          $this->retval .= "<p>" . implode("<br>\n", $tmp) . "</p>\n\n";
        }
        unset($tmp);
        $this->retval .= "<div class=\"divider\"><!-- --></div>\n\n";
      }
      if(isset($ITEM) && $ITEM) {
        // display channel item(s)
        foreach($ITEM as $item) {
          $this->display_item($item, "CHANNEL");
          if(is_int($limit) && --$limit <= 0) break;
        }
      }
    }

    // display a single image as HTML
    private function display_image($data, $parent = "")
    {
      extract($data);
      if(!$URL) return;

      $this->retval .= "<p>";
      if($LINK) {
        $this->retval .= "<a href=\"$LINK\" target=\"_blank\">";
      }
      $this->retval .= "<img src=\"$URL\"";
      if(isset($WIDTH, $HEIGHT) && $WIDTH && $HEIGHT) {
        $this->retval .= " width=\"$WIDTH\" height=\"$HEIGHT\"";
      }
      $this->retval .= " border=\"0\" alt=\"$TITLE\">";
      if($LINK) {
        $this->retval .= "</a>";
      }
      $this->retval .= "</p>\n\n";
    }

    // display a single item as HTML
    private function display_item($data, $parent)
    {
      extract($data);
      if(!$TITLE) return;

      $this->retval .=  "<p><b>";
      if($LINK) {
        $this->retval .=  "<a href=\"$LINK\" target=\"_blank\">";
      }
      $this->retval .= stripslashes($TITLE);
      if($LINK) {
        $this->retval .= "</a>";
      }
      $this->retval .=  "</b>";
      if(!isset($PUBDATE) && isset($DC['DATE']) && $DC['DATE']) {
        $PUBDATE = $DC['DATE'];
      }
      if(isset($PUBDATE) && $PUBDATE) {
        $this->retval .= " <small>($PUBDATE)</small>";
      }
      $this->retval .=  "</p>\n";

      // use feed-formatted HTML if provided
      if(isset($CONTENT['ENCODED']) && $CONTENT['ENCODED']) {
        $this->retval .= "<p>" . stripslashes($CONTENT['ENCODED']) . "</p>\n";
      } elseif(isset($DESCRIPTION) && $DESCRIPTION) {
        if(isset($IMAGE) && $IMAGE) {
          foreach($IMAGE as $IMG) {
            $this->retval .= "<img src=\"$IMG\" alt=\"\">\n";
          }
        }
        $this->retval .=  "<p>" . stripslashes($DESCRIPTION) . "</p>\n\n";
      }

      // RSS 2.0 - ENCLOSURE
      if(isset($ENCLOSURE) && $ENCLOSURE) {
        $this->retval .= "<p><small><b>Media:</b> <a href=\"{$ENCLOSURE['URL']}\">";
        $this->retval .= $ENCLOSURE['TYPE'];
        $this->retval .= "</a> ({$ENCLOSURE['LENGTH']} bytes)</small></p>\n\n";
      }

      if(isset($COMMENTS) && $COMMENTS) {
        $this->retval .= "<p style=\"text-align: right;\"><small>";
        $this->retval .= "<a href=\"$COMMENTS\">Comments</a>";
        $this->retval .= "</small></p>\n\n";
      }
    }

    private function fixEncoding(&$input, $key, $output_encoding)
    {
      if(!function_exists('mb_detect_encoding')) return $input;

      $encoding = mb_detect_encoding($input);
      switch($encoding)
      {
        case 'ASCII':
        case $output_encoding:
          break;

        case '':
          $input = mb_convert_encoding($input, $output_encoding);
          break;

        default:
          $input = mb_convert_encoding($input, $output_encoding, $encoding);

      }
    }

    // display entire feed as HTML
    public function getOutput($limit = FALSE, $output_encoding = 'UTF-8')
    {
      $this->retval = "";
      $start_tag = key($this->output);

      switch($start_tag)
      {
        case "RSS":
          // new format - channel contains all
          foreach($this->output[$start_tag]['CHANNEL'] as $channel) {
            $this->display_channel($channel, $limit);
          }
          break;

        case "RDF:RDF":
          // old format - channel and items are separate
          if(isset($this->output[$start_tag]['IMAGE'])) {
            foreach($this->output[$start_tag]['IMAGE'] as $image) {
              $this->display_image($image);
            }
          }
          foreach($this->output[$start_tag]['CHANNEL'] as $channel) {
            $this->display_channel($channel, $limit);
          }
          foreach($this->output[$start_tag]['ITEM'] as $item) {
            $this->display_item($item, $start_tag);
          }
          break;

        case "HTML":
          die("Error: cannot parse HTML document as RSS");

        default:
          die("Error: unrecognized start tag '$start_tag' in getOutput()");

      }

      if($this->retval && is_array($this->retval)) {
        array_walk_recursive($this->retval, [$this, 'fixEncoding'], $output_encoding);
      }
      return $this->retval;
    }

    // return raw data as array
    public function getRawOutput($output_encoding = 'UTF-8')
    {
      // array_walk_recursive($this->output, [$this, 'fixEncoding'], $output_encoding);
      return $this->output;
    }
  }
?>
