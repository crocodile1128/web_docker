<?PHP
  // define script parameters
  $BLOGURL    = "http://feeds.bbci.co.uk/news/rss.xml?edition=int";
  $NUMITEMS   = 2;
  $TIMEFORMAT = "j F Y, g:ia";
  if (isset($_GET['feed']) && $_GET['feed'] !== "") {
    $BLOGURL = $_GET['feed'];
  }

  function http_get_contents($url)
  {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_TIMEOUT, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    if(FALSE === ($retval = curl_exec($ch))) {
      error_log(curl_error($ch));
    } else {
      return $retval;
    }
  }

  // get contents from feed
  $feed_contents = http_get_contents($BLOGURL);

  include "rssparser.php";
  $rss_parser = new Chirp\RSSParser($feed_contents);

  // read feed data from cache file
  $feeddata = $rss_parser->getRawOutput();

  // display leading image
  $image = (array)$feeddata->channel->image;
  if(isset($image) && $image) {
    extract($image, EXTR_PREFIX_ALL, 'img');
    echo "<p><a title=\"{$img_title}\" href=\"{$img_link}\"><img src=\"{$img_url}\" alt=\"\"></a></p>\n";
  }

  // display feed title
  echo "<h4><a title=\"",htmlspecialchars($feeddata->channel->description),"\" href=\"{$feeddata->channel->link}\" target=\"_blank\">";
  echo htmlspecialchars($feeddata->channel->title);
  echo "</a></h4>\n";

  // display feed items
  $count = 0;
  foreach($feeddata->channel->item as $itemdata) {
    echo "<p><b><a href=\"{$itemdata->link}\" target=\"_blank\">";
    echo htmlspecialchars(stripslashes($itemdata->title));
    echo "</a></b><br>\n";
    echo htmlspecialchars(stripslashes($itemdata->description)),"<br>\n";
    echo "<i>",date($TIMEFORMAT, strtotime($itemdata->pubDate)),"</i></p>\n\n";
    if(++$count >= $NUMITEMS) break;
  }

  // display copyright information
  echo "<p><small>&copy; {",htmlspecialchars($feeddata->channel->copyright),"}</small></p>\n";
?>
