<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="jumbotron">
    <?php echo anchor('action/reset', 'Reset'); ?>
    <?php echo form_open('action/question/check'); ?>
    <p class="lead">
    <span class="glyphicon glyphicon-volume-up" aria-hidden="true"></span>
    <span id = 'interaction'>
        <?php if(isset($status)){echo $status;}; ?>
    </span>
        <?php  
           echo br(2);
           echo form_submit('yes', 'Yes', "class='btn btn-lg btn-success' onclick='check_js(this.value);' ");
           echo form_submit('no', 'No', "class='btn btn-lg btn-danger'"); 
        ?>
    </p>
    <?php echo form_close(); ?>
</div>
<div id='results'></div>
<?php  echo '<script src = "' . base_url('JS/' . 'custom_js.js') . '" type = "text/javascript"> </script>'; ?>
