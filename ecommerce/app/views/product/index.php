<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 10/10/2016
 * Time: 14:00
 */?>
<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <img class="img-responsive" src="<?php echo $data['product']->image ?>" alt="">
        </div>
        <div class="col-md-6">
            <?php Message::displayMessage();?>
            <div class="thumbnail">
                <div class="caption-full">
                    <?php if($data['products']->outOfStock()) :?>
                    <span class="label label-danger"> Out of stock</span>
                    <?php endif ?>
                    <?php if($data['products']->hasLowStock()) :?>
                        <span class="label label-warning"> Low stock</span>
                    <?php endif ?>
                    <h4 class="pull-right"><?php echo $data['product']->price ?></h4>

                    <h4><a href="#"><?php echo $data['product']->title ?></a>
                    </h4>

                    <p><?php echo $data['product']->description ?></p>
                    <a href="<?php echo Url::path() ?>/cart/add/<?php echo $data['product']->slug?>/1" class="btn btn-default btn-sm">Add to cart</a>
                </div>
                <div class="ratings">
                    <p class="pull-right">3 reviews</p>
                    <p>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star-empty"></span>
                        4.0 stars
                    </p>
                </div>
            </div>

            <div class="well">

                <div class="text-right">
                    <a href="<?php echo Url::path() ?>/product/review/<?php echo $data['product']->slug?>" class="btn btn-default">Leave a Review</a>
                </div>

                <hr>

                <?php if ($data['reviews'][0]->product_id == $data['product']->id) : ?>
                <?php foreach ($data['reviews'] as $review) :?>

                    <div class="row">
                        <div class="col-md-12">
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                            <?php echo $review->name ?>
                            
                            <p><?php echo $review->review ?></p>
                        </div>
                    </div>

                    <hr>

                <?php endforeach;?>
                    <?php else:?>
                <div class="row">
                    <div class="col-md-12">
                        <p>There is no reviews for this item yet, be First!</p>
                    </div>
                </div>
                <?php endif ; ?>

            </div>

        </div>
    </div>
</div>
