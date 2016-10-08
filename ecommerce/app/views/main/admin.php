<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 08/10/2016
 * Time: 11:14
 */?>
<div class="col-md-9 text-center">
    <?php Validation::displayErrors(); ?>
    <form action="" method="POST">
        <div class="form-group">
            <label for="name">Name*:</label><br>
            <input type="text"  name="name" value="<?php echo Input::get('name'); ?>" ><br>
        </div>
        <div class="form-group">
            <label for="price">Price*:</label><br>
            <input type="text"  name="price" value="<?php echo Input::get('price'); ?>" >
        </div>
        <div class="form-group">
            <label for="body">Description*:</label><br>
            <textarea rows="8" cols="50"  name="body" value="<?php echo Input::get('body'); ?>" ></textarea>
        </div>
        <div class="form-group">
            <label for="photo">Photo*:</label><br>
            <input type="file"  name="photo"  >
        </div>
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        <button type="submit" name="submit" class="btn btn-default">Add Product</button><br><br>
        <p>*- Required fields</p>
    </form>
</div>
