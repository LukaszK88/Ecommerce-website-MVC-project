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
            <h3><?php echo !empty($data['productId']) ? 'Update Item' :'Add Item' ;?></h3>
            <?php Message::displayMessage(); ?>
        </div>
    </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-4 text-center well">
        <?php Validation::displayErrors(); ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Item Name*:</label><br>
                    <input type="text"  name="title"  class="form-control" value="<?php echo !empty($data['productId']) ? $data['product'][0]->title : Input::get('title'); ?>" >
                </div>
                <div class="form-group">
                    <label for="slug">Item Name-Slug*:</label><br>
                    <input type="text"  name="slug"  class="form-control" value="<?php echo !empty($data['productId']) ? $data['product'][0]->slug : Input::get('slug'); ?>" >
                </div>
                <div class="form-group">
                    <label for="price">Item Price*:</label><br>
                    <input type="text"  name="price" class="form-control" value="<?php echo !empty($data['productId']) ? $data['product'][0]->price : Input::get('price'); ?>" >
                </div>
                <div class="form-group">
                    <label for="category">Item Category*:</label><br>

                    <select name="category" class="form-control"  >
                        <option >Western Shields</option>
                        <option >Eastern Shields</option>
                        <option >1v1 Head</option>
                        <option >1v1 Upper Body</option>
                        <option >1v1 Lower Body</option>
                        <option >Bohurt Head</option>
                        <option >Bohurt Upper Body</option>
                        <option >Bohurt Lower Body</option>
                        <option >Upper Body Paddings</option>
                        <option >Head Paddings</option>
                        <option >Lower Body Paddings</option>
                        <option>Others</option>
                        <?php echo !empty($data['productId']) ? '<option selected="selected">'.$data['product'][0]->category.'</option>' : '<option selected="selected">'.Input::get('category').'</option>'; ?>
                    </select>

                </div>
                <div class="form-group">
                    <label for="category_slug">Item Category-Slug*:</label><br>

                    <select  name="category_slug" class="form-control"  >
                        <option >western-shields</option>
                        <option >easter-shields</option>
                        <option >1v1-head</option>
                        <option >1v1-upperbody</option>
                        <option >1v1-lowerbody</option>
                        <option >bohurt-head</option>
                        <option >bohurt-upperbody</option>
                        <option >bohurt-lowerbody</option>
                        <option >paddings-upperbody</option>
                        <option >paddings-head</option>
                        <option >paddings-lowerbody</option>
                        <option>others</option>
                        <?php echo !empty($data['productId']) ? '<option selected="selected">'.$data['product'][0]->category_slug.'</option>' : '<option selected="selected">'.Input::get('category_slug').'</option>'; ?>
                    </select>

                </div>
                <div class="form-group">
                    <label for="stock">Item Stock:</label><br>
                    <input class="ex1" data-slider-id='ex1Slider' name="stock" type="text" data-slider-min="0" data-slider-max="50" data-slider-step="1" data-slider-value="<?php echo !empty($data['productId']) ? $data['product'][0]->stock : Input::get('stock')?>"/>
                </div>
                <div class="form-group">
                    <label for="description">Item Description*:</label><br>
                    <textarea rows="8" cols="50" name="description" class="form-control"><?php echo !empty($data['productId']) ? $data['product'][0]->description : Input::get('description'); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="photo">Item Photo*:</label><br>
                    <input type="file" class="form-control"  name="photo" value="" >
                </div>

                <div class="form-group">
                    <label for="image">Item Photo path*:</label><br>
                    <input type="text" class="form-control"  name="image" value="<?php echo !empty($data['productId']) ? $data['product'][0]->image : Input::get('image'); ?>" >
                </div>
                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                <button type="submit" name="submit" class="btn btn-default"><?php echo !empty($data['productId']) ? 'Update Product' :'Add Product' ;?></button><br><br>
                <p>*- Required fields</p>
            </form>
        </div>
    </div>
</div>
