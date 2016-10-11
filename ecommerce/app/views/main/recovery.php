<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 07/10/2016
 * Time: 14:23
 */?>
<div class="col-lg-9 text-center">
    <?php
    Message::displayMessage();
    Validation::displayErrors();
    ?>
    <div class="text-center m-t-lg">
            <form action="" method="POST">
                <div class="form-group">
                    <label for="username">Email:</label><br>
                    <input type="text"  id="username" name="username">
                </div>

                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                <button type="submit" name="submit" class="btn btn-primary">Send</button>

            </form>
    </div>
</div>