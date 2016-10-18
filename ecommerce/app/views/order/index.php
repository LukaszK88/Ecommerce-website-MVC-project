<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 11/10/2016
 * Time: 15:52
 */?>

<div class="col-md-9">
    <form action="<?php echo Url::path()?>/order/index" method="post">
        <div class="col-md-8 well">
            <?php Validation::displayErrors(); ?>
            <div class="row">
                <div class="col-md-6">
                    <h3>Your details</h3>
                    <hr>
                    <div class="form-group">
                        <label for="username">Email*:</label><br>
                        <input type="text"  name="username" class="form-control" value="<?php echo Input::get('username'); ?>" >
                    </div>
                    <div class="form-group">
                        <label for="name">Name*:</label><br>
                        <input type="text"  name="name" class="form-control" value="<?php echo Input::get('name'); ?>" >
                    </div>
                </div>

                <div class="col-md-6">
                    <h3>Your Adress</h3>
                    <hr>
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


                </div>
            </div>
            <h3>Payments</h3>
            <hr>
                <div id="payment">
                </div>
        </div>
        <div class="col-md-4">
            <div class="well">
                <h3>Your order</h3>
                <hr>

                <?php include '../app/views/cart/partials/content.php'?>
                <?php include '../app/views/cart/partials/summary.php'?>

                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                <button type="submit" name="submit" class="btn btn-default">Place order</button>
            </div>
        </div>
    </form>

</div>
