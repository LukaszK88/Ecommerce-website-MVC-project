<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 06/10/2016
 * Time: 19:50
 */?>
        <div class="col-lg-9">
            <div class="text-center m-t-lg">
                    <?php
                    Message::displayMessage();
                    Validation::displayErrors();
                    ?>
                <form action="" method="POST">
                        <div class="form-group">
                            <label for="name">Name:</label><br>
                            <input type="text"  id="name" name="name" value="<?php echo Input::get('name')?>">
                        </div>
                        <div class="form-group">
                            <label for="password_current">Current Password:</label><br>
                            <input type="password"  id="password_current" name="password_current" value="<?php if(!empty($data['temp_password'])){ echo $data['temp_password'];} ?>">
                        </div>
                        <div class="form-group">
                            <label for="new_password">New Password:</label><br>
                            <input type="password"  id="new_password" name="new_password" value="">
                        </div>
                        <div class="form-group">
                            <label for="new_password_again">New Password Again:</label><br>
                            <input type="password"  id="new_password_again" name="new_password_again" value="">
                        </div>

                        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                        <button type="submit" name="submit" class="btn btn-primary">Update</button>
                    </form>
                
            </div>
        </div>

