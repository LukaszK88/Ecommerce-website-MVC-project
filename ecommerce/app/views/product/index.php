<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 10/10/2016
 * Time: 14:00
 */?>

<div class="col-lg-3">
    <img class="img-responsive" src="<?php echo $data['product']->image ?>" alt="">
</div>
<div class="col-md-6">

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
            <a href="#" class="btn btn-default btn-sm">Add to cart</a>
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
            <a class="btn btn-success">Leave a Review</a>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-12">
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star-empty"></span>
                Anonymous
                <span class="pull-right">10 days ago</span>
                <p>This product was great in terms of quality. I would definitely buy another!</p>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-12">
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star-empty"></span>
                Anonymous
                <span class="pull-right">12 days ago</span>
                <p>I've alredy ordered another one!</p>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-12">
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star-empty"></span>
                Anonymous
                <span class="pull-right">15 days ago</span>
                <p>I've seen some better than this, but not at this price. I definitely recommend this item.</p>
            </div>
        </div>

    </div>

</div>

