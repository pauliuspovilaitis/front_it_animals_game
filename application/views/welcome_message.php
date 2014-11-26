<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php echo form_open('action/question/');?>
<div class="jumbotron">
    <p class="lead">How to play</p>
    <h5>  Please think of any animal. <br>Once You are ready - please press the start button. </h5>
    <p>
        <?php echo form_submit('start', 'Start', "class='btn btn-lg btn-success'");?>
    </p>
</div>
<?php echo form_close();?>
    