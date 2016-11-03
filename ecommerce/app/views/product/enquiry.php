<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 03/11/2016
 * Time: 15:45
 */?>
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4 text-center well">
            <?php
            Validation::displayErrors();
            Message::displayMessage();
            ?>
            <form action="" method="POST" >
                <?php if(empty($data['user']->data()->name)) : ?>
                <div class="form-group">
                    <label for="name">First name:</label><br>
                    <input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo Input::get('name');?>" >
                </div>
                <?php endif; ?>
                <?php if(empty($data['user']->data()->username)) : ?>
                <div class="form-group">
                    <label for="email">Email*:</label><br>
                    <input type="text" class="form-control"  name="email" placeholder="Email" value="<?php echo Input::get('email'); ?>" >
                </div>
                <?php endif; ?>
                <div class="form-group ">
                    <label for="item">Item*:</label><br>
                    <input type="text"  class="form-control" name="item" placeholder="Item Name" value="<?php echo !empty($data['product']) ? $data['product']->title : Input::get('item'); ?>">
                </div>
                <div class="form-group">
                    <label for="message">Message*:</label><br>
                    <textarea rows="8" cols="50" class="form-control" placeholder="Your Message" name="message"><?php echo Input::get('message');?></textarea>
                </div>

                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                <button type="submit" name="submit" class="btn btn-success">Send</button><br><br>
                <p>*-Required fields</p>
            </form>


        </div>
    </div>
</div>

