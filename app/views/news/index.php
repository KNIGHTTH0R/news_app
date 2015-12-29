<h1>My Published News</h1>
<?php if($this->session->flashdata('news_created')) : ?>
    <?php echo '<p class="text-success">' .$this->session->flashdata('list_created') . '</p>'; ?>
<?php endif; ?>
<?php if($this->session->flashdata('news_deleted')) : ?>
    <?php echo '<p class="text-success">' .$this->session->flashdata('list_deleted') . '</p>'; ?>
<?php endif; ?>
<?php if($this->session->flashdata('news_updated')) : ?>
    <?php echo '<p class="text-success">' .$this->session->flashdata('list_updated') . '</p>'; ?>
<?php endif; ?>
<?php if($this->session->flashdata('published')) : ?>
    <?php echo '<p class="text-success">' .$this->session->flashdata('published') . '</p>'; ?>
<?php endif; ?>

<?php if(!empty($user_news)):?>
    <?php if(isset($headline)):?>
        <p><?php $headline ?></p>
    <?php else:?>
         <p>This are your current News</p>
    <?php endif;?> 
    <table style="border-collapse: collapse;">
    <?php foreach ($user_news as $news) : ?>
        <tr style="outline: thin solid black;">
            <td style="padding-top: 1em;padding-bottom: 1em;">
            	<img src="<?php echo base_url()."./uploads/news_images/".$news->news_image; ?>" class="news_image" height="200" width="200"  > </img>
            </td>
            <td>
            	<a href="<?php echo base_url(); ?>news/show/<?php echo $news->id; ?>"><h3><?php echo $news->title; ?></h3></a>
            	<div class="news"> <?php echo substr($news->news_text,0,200); ?></div>
                <br/>
                <div style="color:red;align:right;">Added on <?php echo $news->added_on; ?> </div>
            </td>

            <td>
                <a href="<?php echo base_url(); ?>news/delete/<?php echo $news->id; ?>">Delete News</a>
                <?php if($news->is_published):?>
                    <a href="<?php echo base_url(); ?>news/unpublish/<?php echo $news->id; ?>">Unpublish News</a>
                <?php else:?>    
                    <a href="<?php echo base_url(); ?>news/publish/<?php echo $news->id; ?>">publish News</a>
                <?php endif;?>
            </td>
        </tr>

    <?php endforeach; ?>
    </table>
    <br />
 <?php else: ?>
    <p>You dont have posted any news yet.</p>
 <?php endif; ?>
<p>To create a new News - <a href="<?php echo base_url(); ?>news/add">Click here</a>