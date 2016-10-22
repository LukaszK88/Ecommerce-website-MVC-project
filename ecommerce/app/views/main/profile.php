<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 22/10/2016
 * Time: 15:29
 */?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="col-lg-4 text-center well">
                
                <?php
                Validation::displayErrors();
                Message::displayMessage();
                ?>
               <h3>Your Details</h3>
                <label for="username">Username: </label> <?php echo $data['user']->username ?><br>
                <label for="username">Username: </label> <?php echo $data['user']->name ?><br>

            </div>
            <div class="col-lg-6 text-center well">
                <h3>Your Delivery Addresses</h3>
                <form action="" method="post">
                    <?php if(!empty($data['addresses'])) :?>
                    <?php foreach ($data['addresses'] as $address): ?>
                    <div class="col-md-6">
                    <?php echo $address->address1 ?><br>
                    <?php echo $address->address2 ?><br>
                    <?php echo $address->post_code ?><br>
                    <?php echo $address->city ?><br>
                        <button type="submit" name="delete" value="<?php echo $address->id ?>" class="btn btn-default btn-sm">Delete</button>
                    </div>
                <?php endforeach; ?>
                    <?php else :?>

                            <div class="form-group">
                                <label for="address1">Address1*:</label><br>
                                <input type="text"  name="address1" class="form-control" value="<?php echo Input::get('address1'); ?>" >
                            </div>
                            <div class="form-group">
                                <label for="address2">Address2:</label><br>
                                <input type="text"  name="address2" class="form-control" value="<?php echo Input::get('address2'); ?>" >
                            </div>
                            <div class="form-group">
                                <label for="city">City*:</label><br>
                                <input type="text"  name="city" class="form-control" value="<?php echo Input::get('city'); ?>" >
                            </div>
                            <div class="form-group">
                                <label for="post_code">Post code*:</label><br>
                                <input type="text"  name="post_code" class="form-control" value="<?php echo Input::get('post_code'); ?>" >
                            </div>

                        
                        <button type="submit" name="add" class="btn btn-default btn-sm">Add</button>
                    <?php endif ?>
                </form>
            </div>
        </div>
    </div>
</div>
