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

  if ($feeddata) {
    echo "<p>Subscribed!</p>\n";
  } else {
    echo "<p>Give me the feed so that I can subscribe it!\n";
  }
?>
