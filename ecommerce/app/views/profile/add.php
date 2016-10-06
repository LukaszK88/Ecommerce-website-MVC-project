Add User Page


<?php
$build = new Build();
$build->openForm();?>
Name    <?php $build->input(array(
    'type' =>'text',
    'name' =>'name'
));?><br>
Surname    <?php $build->input(array(
    'type' =>'text',
    'name' =>'surname'
));?><br>
Age   <?php $build->input(array(
    'type' =>'text',
    'name' =>'age'
));?><br>
<?php $build->submit('Submit');?>
<?php $build->closeForm();?>