<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 08/10/2016
 * Time: 11:14
 */?>
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4 text-center well">
            <h3>Add Items</h3>
            <?php Message::displayMessage(); ?>
        </div>
    </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-4 text-center well">
        <?php Validation::displayErrors(); ?>
            <form action="<?php echo Url::path()?>/main/admin" method="POST">
                <div class="form-group">
                    <label for="title">Item Name*:</label><br>
                    <input type="text"  name="title"  class="form-control" value="<?php if(empty(Input::get('title'))){echo $data['product']->title;}else{echo Input::get('title');} ?>" >
                </div>
                <div class="form-group">
                    <label for="slug">Item Name-Slug*:</label><br>
                    <input type="text"  name="slug"  class="form-control" value="<?php echo Input::get('slug'); ?>" >
                </div>
                <div class="form-group">
                    <label for="price">Item Price*:</label><br>
                    <input type="text"  name="price" class="form-control" value="<?php echo Input::get('price'); ?>" >
                </div>
                <div class="form-group">
                    <label for="category">Item Category*:</label><br>
                    <input type="text"  name="category" class="form-control" value="<?php echo Input::get('category'); ?>" >
                </div>
                <div class="form-group">
                    <label for="category_slug">Item Category-Slug*:</label><br>
                    <input type="text"  name="category_slug" class="form-control" value="<?php echo Input::get('category_slug'); ?>" >
                </div>
                <div class="form-group">
                    <label for="stock">Item Stock:</label><br>
                    <input class="ex1" data-slider-id='ex1Slider' name="stock" type="text" data-slider-min="0" data-slider-max="50" data-slider-step="1" data-slider-value="<?php Input::get('stock')?>"/>
                </div>
                <div class="form-group">
                    <label for="description">Item Description*:</label><br>
                    <textarea rows="8" cols="50" name="description" class="form-control"><?php echo Input::get('description'); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="image">Item Photo path*:</label><br>
                    <input type="text" class="form-control"  name="image" value="<?php echo Input::get('image'); ?>" >
                </div>
                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                <button type="submit" name="submit" class="btn btn-default">Add Product</button><br><br>
                <p>*- Required fields</p>
            </form>
        </div>
    </div>
</div>
