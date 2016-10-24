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
                    <p class="pull-right">
                        <?php if(!empty($data['products']->countReviews($data['product']->id))):?>
                        <?php echo $data['products']->countReviews($data['product']->id).' reviews' ?>
                        <?php else:?>
                        <?php echo 'no reviews'?>
                        </p>
                        <?php endif; ?>
                    <p>
                        <span class="glyphicon glyphicon-star"></span>
                       <?php echo $data['avgRating'] ?>
                    </p>
                </div>
            </div>

            <div class="well">

                <div class="text-right">
                    <a href="<?php echo Url::path() ?>/product/review/<?php echo $data['product']->slug?>" class="btn btn-default">Leave a Review</a>
                </div>

                <hr>

                <?php if ($data['products']->countReviews($data['product']->id) == false) : ?>
                <div class="row">
                    <div class="col-md-12">
                        <p>There is no reviews for this item yet, be the First!</p>
                    </div>
                </div>
                <?php else : ?>
                <?php foreach ($data['reviews'] as $review) :?>
                    <?php if ($review->product_id == $data['product']->id) : ?>
                    <div class="row">
                        <div class="col-md-12">
                            <span class="glyphicon glyphicon-star"></span>
                            <?php echo $review->rating ?> / 5
                            <?php echo $review->name ?>
                        <?php if($data['user']->isLoggedIn() and ($review->username == Session::get('username'))):  ?>
                            <a href="<?php echo Url::path() ?>/product/delete/<?php echo $data['product']->slug?>" class="btn btn-default btn-sm pull-right ">delete</a>
                            <a href="<?php echo Url::path() ?>/product/review/<?php echo $data['product']->slug?>/<?php echo $review->id?>/update" class="btn btn-default btn-sm pull-right ">update</a>
                            <?php endif;?>
                            <p><?php echo $review->review ?></p>
                        </div>
                    </div>

                    <hr>
                    <?php endif ; ?>
                <?php endforeach ; ?>
                <?php endif ; ?>



            </div>

        </div>
    </div>
</div>
