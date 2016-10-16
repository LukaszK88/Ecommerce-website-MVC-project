<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 11/10/2016
 * Time: 16:37
 */?>
<table class="table">
    <?php foreach ($basket->all() as $item) :?>
        <tr>
            <td><?php echo $item->title; ?></td>
            <td><?php echo $item->quantity; ?></td>
        </tr>
    <?php endforeach;?>
</table>
