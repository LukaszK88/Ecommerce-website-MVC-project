<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 02/11/2016
 * Time: 15:20
 */?>
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4 text-center well">
            <div class="text-center m-t-lg">
                <?php
                Message::displayMessage();
                Validation::displayErrors();
                ?>
                <form action="" method="POST">
                    <?php if($data['update']=='username') :?>
                    <div class="form-group">
                        <label for="username">Username:</label><br>
                        <input type="text"  id="username" name="username" placeholder="Username" value="<?php echo !empty($data['user']->username) ? $data['user']->username : Input::get('username'); ?>">
                    </div>
                    <?php elseif ($data['update']=='name') : ?>
                    <div class="form-group">
                        <label for="name">Name:</label><br>
                        <input type="text"  id="name" name="name" placeholder="Name" value="<?php echo !empty($data['user']->name) ? $data['user']->name : Input::get('name'); ?>">
                    </div>
                    <?php endif; ?>
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                    <button type="submit" name="submit" class="btn btn-success">Update</button>
                </form>

            </div>
        </div>
    </div>
</div>

