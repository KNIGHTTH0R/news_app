<!--Display Messages-->
<?php if($this->session->flashdata('registered')) : ?>
    <?php echo '<p class="text-success">' .$this->session->flashdata('registered') . '</p>'; ?>
<?php endif; ?>
<?php if($this->session->flashdata('logged_out')) : ?>
    <?php echo '<p class="text-success">' .$this->session->flashdata('logged_out') . '</p>'; ?>
<?php endif; ?>
<?php if($this->session->flashdata('need_login')) : ?>
    <?php echo '<p class="text-error">' .$this->session->flashdata('need_login') . '</p>'; ?>
<?php endif; ?>

<?php if($this->session->flashdata('already_member')) : ?>
    <?php echo '<p class="text-error">' .$this->session->flashdata('already_member') . '</p>'; ?>
<?php endif; ?>
<?php if($this->session->userdata('logged_in')) : ?>
<br />
<!--Display Errors-->
<?php echo validation_errors('<p class="text-error">'); ?>
<br />


<?php endif; ?>

<h3>Recently Posted News</h3>
<table class="table table-striped" width="50%" cellspacing="5" cellpadding="5">
    <tr>
        <th>Top Stories</th>
    </tr>
    <?php if(isset($news)) : ?>
    <?php foreach($news as $thenews) : ?>
    <tr style="outline: thin solid black;">
        <td style="padding-top: 1em;padding-bottom: 1em;">
            <img src="<?php echo base_url()."./uploads/news_images/".$thenews->news_image; ?>" class="news_image" height="200" width="200"  > </img>
        </td>
        <td>
            <a href="<?php echo base_url(); ?>news/show/<?php echo $thenews->id; ?>"><h3><?php echo $thenews->title; ?></h3></a>
            <div class="news"> <?php echo substr($thenews->news_text,0,200); ?></div>
            <br/>
            <div style="color:red;" >Added on : <?php echo $thenews->added_on; ?> </div>
        </td>
    </tr>


    <?php endforeach; ?>
    <?php endif; ?>
</table>