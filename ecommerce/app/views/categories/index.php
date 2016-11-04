<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 10/10/2016
 * Time: 14:10
 */?>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">
            <?php if($data['urlCategory'] == $data['product'][0]->category_slug) : ?>
            <h2 class="well "><?php echo $data['product'][0]->category ?></h2>
            <?php elseif ($data['urlCategory'] == $data['product'][0]->main_category) : ?>
            <h2 class="well "><?php echo $data['product'][0]->main_category ?></h2>
            <?php endif; ?>
            <?php Message::displayMessage() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <?php foreach ($data['product'] as $product):?>
                <div class="col-sm-3 col-lg-3 col-md-3">
                    <div class="thumbnail theme">
                        <a href="<?php echo Url::path()?>/product/<?php echo $product->slug ?>"><img src="<?php echo $product->image ?>" alt=""></a>
                        <div class="caption ">

                            <h4 class="pull-right">£ <?php echo $product->price ?></h4><br>
                            <h4><a href="<?php echo Url::path()?>/product/<?php echo $product->slug ?>"><?php echo $product->title ?></a>
                            </h4>
                            <p><?php echo $product->description ?></p>
                        </div>
                        <div class="ratings">
                            <?php if(empty($data['review']->countReviews($product->id))) : ?>
                                <p class="pull-right"> no reviews</p>
                                <p>
                                    <span class="glyphicon glyphicon-star"></span>
                                </p>
                            <?php else:?>
                            <p class="pull-right"><?php echo $data['review']->countReviews($product->id) ?> reviews</p>
                            <p>
                                <span class="glyphicon glyphicon-star"></span>
                                <?php echo number_format($data['review']->getAverageRating($product->id)->ratingAvg,1,'.','');?> / 5
                            </p>
                            <?php endif;?>
                        </div>
                        <?php if($data['user']->isLoggedIn() and $data['user']->hasPermission('admin')): ?>
                        <a href="<?php echo Url::path()?>/categories/delete/<?php echo $product->id ?>/<?php echo $product->category_slug ?>" class="btn btn-danger btn-sm">Delete</a>
                        <a href="<?php echo Url::path()?>/main/admin/<?php echo $product->id ?>/<?php echo $product->category_slug ?>" class="btn btn-warning btn-sm">Update</a>
                        <?php endif; ?>
                    </div>

                </div>

            <?php endforeach;?>


        </div>
    </div>
</div>

