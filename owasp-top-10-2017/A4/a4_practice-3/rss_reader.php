<?PHP
  // define script parameters
  $NUMITEMS   = 2;
  $TIMEFORMAT = "j F Y, g:ia";
  if (isset($_GET['feed']) && $_GET['feed'] !== "") {
    $BLOGURL = $_GET['feed'];
  }

  // get contents from feed
  $feed_contents = file_get_contents('php://input');
  if ($feed_contents === "") {
    $feed_contents = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<?xml-stylesheet title="XSL_formatting" type="text/xsl" href="/shared/bsp/xsl/rss/nolsol.xsl"?>
<rss xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:atom="http://www.w3.org/2005/Atom" version="2.0" xmlns:media="http://search.yahoo.com/mrss/">
    <channel>
        <title><![CDATA[BBC News - Home]]></title>
        <description><![CDATA[BBC News - Home]]></description>
        <link>https://www.bbc.co.uk/news/</link>
        <image>
            <url>https://news.bbcimg.co.uk/nol/shared/img/bbc_news_120x60.gif</url>
            <title>BBC News - Home</title>
            <link>https://www.bbc.co.uk/news/</link>
        </image>
        <generator>RSS for Node</generator>
        <lastBuildDate>Sat, 24 Nov 2018 15:37:21 GMT</lastBuildDate>
        <copyright><![CDATA[Copyright: (C) British Broadcasting Corporation, see http://news.bbc.co.uk/2/hi/help/rss/4498287.stm for terms and conditions of reuse.]]></copyright>
        <language><![CDATA[en-gb]]></language>
        <ttl>15</ttl>
        <item>
            <title><![CDATA[Brexit: Donald Tusk tells European Union to approve deal]]></title>
            <description><![CDATA[It comes after Spain withdraws its threat to boycott a summit to agree the UK's exit from the EU.]]></description>
            <link>https://www.bbc.co.uk/news/uk-politics-46330380</link>
            <guid isPermaLink="true">https://www.bbc.co.uk/news/uk-politics-46330380</guid>
            <pubDate>Sat, 24 Nov 2018 15:22:04 GMT</pubDate>
            <media:thumbnail width="976" height="549" url="http://c.files.bbci.co.uk/13FAD/production/_104473818_hi050641274.jpg"/>
        </item>
    </channel>
</rss>
XML;
  } else if (stristr($feed_contents, "system") || stristr($feed_contents, "public") || stristr($feed_contents, "?>")) {
    die("Security level upgrades! Therefore, ['system', 'public', '?>'] are not allowed!");
  }

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
  echo "<!-- $feed_contents -->";
?>
