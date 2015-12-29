
<?php if(isset($news)) : ?>
<h1><?php echo $news->title; ?></h1>
<div>
	<img class="image" width="620" height="480" src="<?php echo base_url()."uploads/news_images/".$news->news_image; ?>" ></img>
</div>
<div>

	<p><?php echo $news->news_text; ?>"</p>

</div>
<?php endif; ?>
<?php if( !strcmp($this->session->userdata('user_id'),$news->added_by) ): ?>
	<p>Delete News <a href="<?php echo base_url()."news/delete/".$news->id; ?>">Click here</a></p>
<?php endif; ?>
<p>Download as Pdf <a href="<?php echo base_url()."news/pdf/".$news->id; ?>">Click here</a></p>