<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 04/10/2016
 * Time: 20:35
 */?>

    <div class="col-lg-9 text-center">
        <?php
        Validation::displayErrors();
        Message::displayMessage();
        ?>
        <div class="text-center m-t-lg">

            <form action="" method="POST">
                <div class="form-group">
                    <label for="username">Username:</label><br>
                    <input type="text"  id="username" name="username">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label><br>
                    <input type="password" id="password" name="password">
                </div>
                <div class="form-group">
                    <label for="remember">Remember me:</label>
                    <input type="checkbox" id="remember" name="remember">
                </div>
                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                <button type="submit" name="submit" class="btn btn-primary">Log in</button><br><br>
                Forgot your <a href="">username</a> or <a href="">password</a>?
            </form>

        </div>
    </div>

