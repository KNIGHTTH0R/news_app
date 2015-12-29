<h1>Register</h1>
<p>Please fill out the form below to create an account</p>
<!--Display Errors-->
<?php echo validation_errors('<p class="text-error">'); ?>
 <?php echo form_open('users/activate_user'); ?>

<!--Field: First Name-->
<p>

<?php
$data['name'] = 'email';
$data['email'] = $email;
?>
<?php echo form_hidden($data); ?>
</p>


<!--Field: First Name-->
<p>
<?php echo form_label('First Name:'); ?>
<?php
$data = array(
              'name'        => 'first_name',
              'value'       => set_value('first_name'),
              'placeholder' => 'First Name'
            );
?>
<?php echo form_input($data); ?>
</p>
<!--Field: Last Name-->
<p>
<?php echo form_label('Last Name:'); ?>
<?php
$data = array(
              'name'        => 'last_name',
              'value'       => set_value('last_name'),
              'placeholder' => 'Last Name'
            );
?>
<?php echo form_input($data); ?>
<!--Field: Password-->
<p>
<?php echo form_label('Password:'); ?>
<?php
$data = array(
              'name'        => 'password',
              'value'       => set_value('password'),
              'placeholder' => 'Password'
            );
?>
<?php echo form_password($data); ?>
</p>

<!--Field: Password2-->
<p>
<?php echo form_label('Confirm Password:'); ?>
<?php
$data = array(
              'name'        => 'password2',
              'value'       => set_value('password2'),
              'placeholder' => 'Confirm Password'
            );
?>
<?php echo form_password($data); ?>
</p>

<!--Submit Buttons-->
<?php $data = array("value" => "Register",
                    "name" => "submit",
                    "class" => "btn btn-primary"); ?>
<p>
    <?php echo form_submit($data); ?>
</p>
<?php echo form_close(); ?>