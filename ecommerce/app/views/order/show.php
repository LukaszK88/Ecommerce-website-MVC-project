<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 18/10/2016
 * Time: 12:04
 */?>
<div class="container">
    <div class="row">
        <div class="col-md-12 well theme">
            <?php Message::displayMessage(); ?>
                <h3>Order#<?php echo $data['order']->id ?></h3>
                <hr>
            <div class="row">
                <div class="col-md-6">
                    <h4>Shipped to:</h4><br>
                    <?php echo $data['address']->address1; ?><br>
                    <?php echo $data['address']->address2; ?><br>
                    <?php echo $data['address']->post_code; ?><br>
                    <?php echo $data['address']->city; ?><br>

                </div>
                <div class="col-md-6">
                    <h4>Products:</h4>

                    <?php foreach ($data['product'] as $product):?>

                        <a href="<?php echo Url::path()?>/product/<?php echo $product->slug ?>"> <?php echo $product->title?></a> x <?php echo $product->quantity?><br>

                    <?php endforeach;?>
                </div>

            </div>
            <hr>
            <h4>
                Shipping total: £5<br>
                <strong>Order total: £<?php echo $data['order']->total+5 ?></strong>

            </h4>
        </div>
    </div>
</div>



