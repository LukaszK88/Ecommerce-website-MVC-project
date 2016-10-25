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
            <h2 class="well "><?php echo $data['product'][0]->category ?></h2>
            <?php Message::displayMessage() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <?php foreach ($data['product'] as $product):?>
                <div class="col-sm-3 col-lg-3 col-md-3">
                    <div class="thumbnail">
                        <img src="<?php echo $product->image ?>" alt="">
                        <div class="caption">
                            <h4 class="pull-right">£ <?php echo $product->price ?></h4>
                            <h4><a href="<?php echo Url::path()?>/product/<?php echo $product->slug ?>"><?php echo $product->title ?></a>
                            </h4>
                            <p><?php echo $product->description ?></p>
                        </div>
                        <div class="ratings">
                            <p class="pull-right"><?php echo $data['review']->countReviews($product->id) ?> reviews</p>
                            <p>
                                <span class="glyphicon glyphicon-star"></span>
                                <?php echo number_format($data['review']->getAverageRating($product->id)->ratingAvg,1,'.','');?>
                            </p>
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

