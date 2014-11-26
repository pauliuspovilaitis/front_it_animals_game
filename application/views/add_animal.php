<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="jumbotron">
    <?php echo anchor('action/reset', 'Reset'); ?>
    <?php echo form_open('animal_add/add'); ?>
    <p class="lead">Please add this new animal - I can not guess it!</p>
	<div>
	   Please add this animal and select his features: 
       <?php
           echo br();
           echo form_input('new_animal', '', "placeholder='Type your animal name'");
           echo br(2);
           if (isset($features)) {
                echo $features;
           }
           echo br();
           echo form_submit('add', 'Add', "class='btn btn-lg btn-success'");   
       ?>
    </div>  
    <?php if(isset($status)){echo $status;} ?>
    <?php echo validation_errors(); ?>
    <?php echo form_close(); ?>
</div>