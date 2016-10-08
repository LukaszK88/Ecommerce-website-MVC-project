<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 04/10/2016
 * Time: 20:35
 */?>

    <div class="col-md-9 text-center">
        <form action="" method="POST">
            <div class="form-group">
                <?php Validation::displayErrors(); ?>
                <label for="username">Email*:</label><br>
                <input type="text"  name="username" value="<?php echo Input::get('username'); ?>" >
            </div>
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
            <button type="submit" name="submit" class="btn btn-default">Register</button><br><br>
            <p>*- Required fields</p>
        </form>
    </div>
