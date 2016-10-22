<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 11/10/2016
 * Time: 15:52
 */?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php if($data['address']->userAndAddressExists()) :?>
            <div class="col-md-8 well">
                <?php Validation::displayErrors(); ?>
                <div class="row">
                <div class="col-md-6">
                    <h3>Your details</h3>
                    <hr>

                    <label>Email:</label><br>
                    <p><?php echo $data['user']->username ?></p><br>
                    <label>Name:</label><br>
                    <p><?php echo $data['user']->name ?></p><br>
                </div>
                <div class="col-md-6">
                    <h3>Your Adress</h3>
                    <form action="<?php echo Url::path()?>/order/index" method="post" class="form-inline">
                        <select name="addresses" class="form-control input-sm">
                            <?php foreach( $data['address']->data() as $address):?>
                                <option value="<?php echo $address->address1 ?>">
                                    <?php echo $address->address1 ?></option>
                            <?php endforeach;?>
                        </select>
                        <input type="submit" value="Select" class="btn btn-default btn-sm">
                        <a href="<?php echo Url::path()?>/main/profile" type="button" class="btn btn-default btn-sm">add/delete</a>
                    </form>
                    <hr>

                    <label>Delivery Address:</label><br>
                    <?php echo $data['userAddress']->address1 ?><br>
                    <?php echo $data['userAddress']->address2 ?><br>
                    <?php echo $data['userAddress']->post_code ?><br>
                    <?php echo $data['userAddress']->city ?><br>

                </div>
                </div>
                <form action="<?php echo Url::path()?>/order/index" method="post">
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




            <?php else: ?>
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
            <?php endif; ?>
        
        </div>
    </div>    
</div>