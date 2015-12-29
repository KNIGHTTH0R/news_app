<?php if($this->session->userdata('logged_in')) : ?>
    <p>You are logged in as <?php echo $this->session->userdata('name'); ?></p>
    <!--Start Form-->
    <?php $attributes = array('id' => 'logout_form',
                          'class' => 'form-horizontal'); ?>
    <?php echo form_open('users/logout',$attributes); ?>
         <!--Submit Buttons-->
    <?php $data = array("value" => "Logout",
                    "name" => "submit",
                    "class" => "btn btn-primary"); ?>
    <?php echo form_submit($data); ?>
    <?php echo form_close(); ?>
    <a href="<?php echo base_url(); ?>news/my_news"> All News </a>
    <br/>
    <a href="<?php echo base_url(); ?>news/published"> Published News </a>
    <br/>
    <a href="<?php echo base_url(); ?>news/unpublished"> Unpublished News </a>
    <br/>
    <a href="<?php echo base_url(); ?>news/add"> Add News </a>
<?php else : ?>
    <h3>Login Form</h3>

<?php if($this->session->flashdata('login_failed')) : ?>
    <?php echo '<p class="text-error">' .$this->session->flashdata('login_failed') . '</p>'; ?>
<?php endif; ?>

<!--Start Form-->
<?php $attributes = array('id' => 'login_form',
                          'class' => 'form-horizontal'); ?>
<?php echo form_open('users/login',$attributes); ?>

<!--Field: Username-->
<p>
<?php echo form_label('Username:'); ?>
<?php
$data = array(
              'name'        => 'username',
              'placeholder' => 'Enter Username', 
              'style'       => 'width:90%',
              'value'       => set_value('username')
            );
?>
<?php echo form_input($data); ?>
</p>

<!--Field: Password-->
<p>
<?php echo form_label('Password:'); ?>
<?php
$data = array(
              'name'        => 'password',
              'placeholder' => 'Enter Password',
              'style'       => 'width:90%',
              'value'       => set_value('password')
            );
?>
<?php echo form_password($data); ?>
</p>
<br />
<p>
    <!--Submit Buttons-->
    <?php $data = array("value" => "Login",
                    "name" => "submit",
                    "class" => "btn btn-primary"); ?>
    <?php echo form_submit($data); ?>
</p>
<?php echo form_close(); ?>
<?php endif; ?>
