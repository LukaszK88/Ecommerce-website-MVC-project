<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 04/10/2016
 * Time: 18:57
 */?>
<div class="container-fluid">
    <div class="row">
<div class="col-md-2 text-center">
    <strong><font color="#8b0000" ><h2>Forge of Gypsy</h2></font></strong>
    <div class="btn-group-vertical btn-group-lg" role="group" aria-label="...">
        <a href="<?php echo Url::path(); ?>/categories/shields" type="button" class="btn btn-default">Shields</a>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Armour
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="#">1v1</a></li>
                <li><a href="#">Gypsy Secrets</a></li>
            </ul>
        </div>

        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Paddings
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="#">Head</a></li>
                <li><a href="#">Upper body</a></li>
                <li><a href="#">Lower</a></li>
            </ul>
        </div>
        <a type="button" class="btn btn-default">Others</a>
    </div>
</div>
