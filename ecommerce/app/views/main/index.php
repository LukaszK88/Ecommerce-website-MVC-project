<!-- Page Content -->
<div class="container">
    <div class="row">

        <div class="col-md-12 text-center ">

            <?php Message::displayMessage();?>
            <div class="jumbotron theme">
                
                <p class="lead">"Si vis pacem, para bellum"<br>
                 "If you want peace, prepare for war"</p>
                <p>Variety of full contact equipment, to ensure you can bring as much "Peace" as possible upon your enemies!</p>
            </div>
        </div>
    </div>

    <div class="row text-center">

        <div class="col-md-3 col-sm-6 hero-feature ">
            <div class="thumbnail">


                <a href="<?php echo Url::path()?>/categories/Shields"><img src="<?php echo $data['shields'][0]->image ?>" alt=""></a>


                <div class="caption theme">
                    <h3>Shields</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    <p>
                        <a href="<?php echo Url::path()?>/categories/Shields" class="btn btn-success">Shop Now!</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 hero-feature">
            <div class="thumbnail">
                <a href="<?php echo Url::path()?>/categories/Armours"><img src="<?php echo $data['armours'][0]->image ?>" alt=""></a>
                <div class="caption theme">
                    <h3>Armour</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    <p>
                        <a href="<?php echo Url::path()?>/categories/Armours" class="btn btn-success">Shop Now!</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 hero-feature">
            <div class="thumbnail">
                <a href="<?php echo Url::path()?>/categories/Paddings"><img src="<?php echo $data['paddings'][0]->image ?>" alt=""></a>
                <div class="caption theme">
                    <h3>Paddings</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    <p>
                        <a href="<?php echo Url::path()?>/categories/Paddings" class="btn btn-success">Shop Now!</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 hero-feature">
            <div class="thumbnail">
                <a href="<?php echo Url::path()?>/categories/Others"><img src="<?php echo $data['others'][0]->image ?>" alt=""></a>
                <div class="caption theme">
                    <h3>Other</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    <p>
                        <a href="<?php echo Url::path()?>/categories/Others" class="btn btn-success">Shop Now!</a>
                    </p>
                </div>
            </div>
        </div>

    </div>


</div>



