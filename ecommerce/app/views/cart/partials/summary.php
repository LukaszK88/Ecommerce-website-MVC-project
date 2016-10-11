<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 11/10/2016
 * Time: 12:13
 */?>
<table class="table">
    <tr>
        <td>Sub total</td>
        <td>£<?php echo $basket->subTotal(); ?></td>
    </tr>
    <tr>
        <td>Shipping</td>
        <td>£500</td>
    </tr>
    <tr>
        <td class="success">Total</td>
        <td class="success">£<?php echo $basket->subTotal() + 5;?></td>
    </tr>

</table>
