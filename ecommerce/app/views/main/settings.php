<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 06/10/2016
 * Time: 19:50
 */?>
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4 text-center well theme">
            <div class="text-center m-t-lg">
                    <?php
                    Message::displayMessage();
                    Validation::displayErrors();
                    ?>
                <form action="" method="POST">
                    <?php if(empty($data['user']->temp_password)) :?>
                        <div class="form-group">
                            <label for="password_current">Current Password:</label><br>
                            <input type="password"  id="password_current" name="password_current" placeholder="Current Password" value="">
                        </div>
                    <?php endif; ?>
                        <div class="form-group">
                            <label for="new_password">New Password:</label><br>
                            <input type="password"  id="new_password" name="new_password" placeholder="New Password" value="">
                        </div>
                        <div class="form-group">
                            <label for="new_password_again">New Password Again:</label><br>
                            <input type="password"  id="new_password_again" name="new_password_again" placeholder="Repeat New Password" value="">
                        </div>

                        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                        <button type="submit" name="submit" class="btn btn-success">Update</button>
                    </form>
                
            </div>
        </div>
    </div>
</div>
