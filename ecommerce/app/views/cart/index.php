<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 10/10/2016
 * Time: 19:34
 */
?>
<div class="container">
    <div class="row">
        <?php if($basket->itemCount()):?>
            <div class="col-md-8">
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
                                <td>
                                    <form action="<?php echo Url::path()?>/cart/update/<?php echo $item->slug ?>" method="post" class="form-inline">
                                        <select name="quantity" class="form-control input-sm">
                                            <?php for($num = 1;$num <= $item->stock;$num++):?>
                                                <option value="<?php echo $num ?>"
                                                <?php if($num == $item->quantity):?>
                                                    selected="selected"
                                                <?php endif;?>>
                                                    <?php echo $num ?></option>
                                            <?php endfor;?>
                                                <option value="0">none</option>
                                        </select>
                                        <input type="submit" value="Update" class="btn btn-default btn-sm">
                                    </form>
                                </td>
                            </tr>


                        <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="col-md-4 col-md-offset-4 well">
                You have no items in your Basket <a href="<?php echo Url::path()?>/main/index">start</a> shopping NOW!
                </div>
            <?php endif; ?>
        </div>

        <div class="col-md-4">
            <?php if($basket->itemCount() and $basket->subTotal()):?>
                <div class="well">
                    <h4>Cart Summary</h4>
                    <hr>

                    <?php include '../app/views/cart/partials/summary.php'?>

                    <a href="<?php echo Url::path()?>/order/index" class="btn btn-default">Check out</a>
                </div>
            <?php endif;?>
        </div>
     </div>
</div>
