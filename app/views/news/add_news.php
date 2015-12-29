<h1>Add a News</h1>
<p>Please fill out the form below to create a new News</p>
<!--Display Errors-->
<?php echo validation_errors('<p class="text-error">'); ?>

<?php if($this->session->flashdata('error')) : ?>
    <?php echo '<p class="text-error">' .$this->session->flashdata('error') . '</p>'; ?>
<?php endif; ?>

 <?php echo form_open_multipart('news/add'); ?>

<!--Field: News Title-->
<p>
<?php echo form_label('Title:'); ?>
<?php
$data = array(
              'name'        => 'title',
              'value'       => set_value('title')
            );
?>
<?php echo form_input($data); ?>
</p>

<!--Field: News Image-->
<p>
<?php echo form_label('Upload Image:'); ?>
<?php
$data = array(
			  'type'		=> 'file',
              'name'        => 'news_image',
              'value'       => set_value('news_image')
            );
?>
<?php echo form_upload($data); ?>

</p>


<!--Field: News Text-->
<p>
<?php echo form_label('News Details:'); ?>
<?php
$data = array(
              'name'        => 'news_text',
              'value'       => set_value('news_text')
            );
?>
<?php echo form_textarea($data); ?>
</p>

<!--Submit Buttons-->
<?php $data = array("value" => "Add News",
                    "name" => "submit",
                    "class" => "btn btn-primary"); ?>
<p>
    <?php echo form_submit($data); ?>
</p>
<?php echo form_close(); ?>