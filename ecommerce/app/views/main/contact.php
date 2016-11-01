<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 25/10/2016
 * Time: 11:41
 */?>
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4 text-center well">
            <?php
            Validation::displayErrors();
            Message::displayMessage();
            ?>
            <form action="" method="POST" >
                <div class="form-group ">

                    <label for="name">First name*:</label><br>
                    <input type="text"  class="form-control" name="name" placeholder="Name" value="<?php echo ($data['user']->isLoggedIn()) ? $data['user']->data()->name : Input::get('name'); ?>">
                </div>
                <div class="form-group">
                    <label for="last_name">Last name:</label><br>
                    <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="<?php echo Input::get('last_name');?>" >
                </div>
                <div class="form-group">
                    <label for="email">Email*:</label><br>
                    <input type="text" class="form-control"  name="email" placeholder="Email" value="<?php echo ($data['user']->isLoggedIn()) ? $data['user']->data()->username : Input::get('username'); ?>" >
                </div>
                <div class="form-group">
                    <label for="message">Message*:</label><br>
                    <textarea rows="8" cols="50" class="form-control" placeholder="Your Message" name="message"><?php echo Input::get('message');?></textarea>
                </div>

                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                <button type="submit" name="submit" class="btn btn-default">Send</button><br><br>
                <p>*-Required fields</p>
            </form>


        </div>
    </div>
</div>

