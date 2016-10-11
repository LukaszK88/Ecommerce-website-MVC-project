<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 10/10/2016
 * Time: 19:34
 */
?>
<div class="col-md-6">
    <?php if($basket->itemCount()):?>
        <div class="well">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($basket->all() as $item) :?>
                    <tr>
                        <td><a href="<?php echo Url::path()?>/product/<?php echo $item->slug ?>"><?php echo $item->title ?></a></td>
                        <td>£<?php echo $item->price ?></td>
                        <td><?php echo $item->quantity ?></td>
                    </tr>


                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        You have no items in your Basket <a href="<?php echo Url::path()?>/categories/index">start</a> shopping NOW!
    <?php endif; ?>
</div>

<div class="col-md-3">
    <?php if($basket->itemCount() and $basket->subTotal()):?>
        <div class="well">
            <h4>Cart Summary</h4>
            <hr>

            <?php include '../app/views/cart/partials/summary.php'?>

            <a href="#" class="btn btn-default">Check out</a>
        </div>
    <?php endif;?>
</div>

