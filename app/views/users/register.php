<h1>Register</h1>
<p>Please fill out the form below to create an account</p>
<!--Display Errors-->
<?php echo validation_errors('<p class="text-error">'); ?>
 <?php echo form_open('users/register'); ?>
<div class="form-group">
<!--Field: Email Address-->
	<p>
		<?php echo form_label('Email Address:'); ?>
		<?php
		$data = array(
					  'class'		=> 'form-control',
		              'name'        => 'email',
		              'value'       => set_value('email')
		            );
		?>
		<?php echo form_input($data); ?>
	</p>
</div>
<!--Submit Buttons-->
<?php $data = array(
					'type'	=>'button',
					'value' => 'Register',
                    'name' 	=> 'submit',
                    'class' => 'btn btn-primary btn-lg'
                    ); 
?>
<p>
    <?php echo form_submit($data); ?>
</p>
<?php echo form_close(); ?>