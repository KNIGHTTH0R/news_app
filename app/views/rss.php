<?php  echo '<?xml version="1.0" encoding="' . $encoding . '"?>' . "\n"; ?>

<rss version="2.0"
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
    xmlns:admin="http://webns.net/mvcb/"
    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
    xmlns:content="http://purl.org/rss/1.0/modules/content/">
 
    <channel>
    <title><?php echo $feed_name; ?></title>
	<link><?php echo $feed_url; ?></link>
	<description><?php echo $page_description; ?></description>
	<dc:language><?php echo $page_language; ?></dc:language>

	<?php foreach($news as $thenews): ?>
	   <item>
	      <title><?php echo xml_convert($thenews->title); ?></title>
	      <link><?php echo base_url().'news/show/' . $thenews->id ?></link>
	      <image><?php echo base_url().'uploads/news_images/'.$thenews->news_image ?></image>
	      <description><![CDATA[ <?php echo character_limiter($thenews->news_text, 200); ?> ]]></description>
	        <pubTime><?php echo $thenews->added_on; ?></pubTime>
	    </item>
	<?php endforeach; ?>
	 
	    </channel>
</rss>