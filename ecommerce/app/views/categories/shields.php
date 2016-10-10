<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 03/10/2016
 * Time: 21:30
 */?>
<div class="row">
 <div class="col-md-9">

     <?php foreach ($data['product'] as $product):?>
    <div class="col-sm-3 col-lg-3 col-md-3">
        <div class="thumbnail">
            <img src="<?php echo $product->image ?>" alt="">
            <div class="caption">
                <h4 class="pull-right"><?php echo $product->price ?></h4>
                <h4><a href="<?php echo Url::path()?>/product/<?php echo $product->slug ?>"><?php echo $product->title ?></a>
                </h4>
                <p><?php echo $product->description ?><a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
            </div>
            <div class="ratings">
                <p class="pull-right">15 reviews</p>
                <p>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                </p>
            </div>
        </div>
    </div>
<?php endforeach;?>


 </div>

</div>
