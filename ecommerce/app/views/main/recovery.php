<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 07/10/2016
 * Time: 14:23
 */?>
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4 text-center well">
            <?php
            Message::displayMessage();
            Validation::displayErrors();
            ?>
            <div class="m-t-lg">
            <form action="" method="POST">
                <div class="form-group">
                    <label for="username">Email:</label><br>
                    <input type="text"  id="username" name="username" placeholder="Email">
                </div>

                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                <button type="submit" name="submit" class="btn btn-default">Send</button>

            </form>
             </div>
        </div>
    </div>
</div>