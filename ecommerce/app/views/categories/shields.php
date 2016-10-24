<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 03/10/2016
 * Time: 21:30
 */?>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-4-offset text-center pull-right">
            <h2 class="well">Western Shields</h2>
        </div>
    </div>
    <div class="row">
         <div class="col-md-12">

             <?php foreach ($data['product'] as $product):?>
            <div class="col-sm-3 col-lg-3 col-md-3">
                <div class="thumbnail">
                    <img src="<?php echo $product->image ?>" alt="">
                    <div class="caption">
                        <h4 class="pull-right"><?php echo $product->price ?></h4>
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
                </div>
            </div>
        <?php endforeach;?>


         </div>
    </div>
</div>
