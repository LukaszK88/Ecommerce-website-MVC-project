<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 23/10/2016
 * Time: 18:01
 */?>
<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <img class="img-responsive" src="<?php echo $data['product']->image ?>" alt="">
        </div>

        <div class="col-md-6">
            <div class="well">
                <?php Validation::displayErrors(); ?>
                <h3>Your review</h3>
                <hr>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="rating">Rating:</label><br>
                        <input class="ex1" data-slider-id='ex1Slider' name="rating" type="text" data-slider-min="0" data-slider-max="5" data-slider-step="0.5" data-slider-value="<?php  if($data['update']=='update'){echo $data['userReview']->rating ;} ?>"/>
                    </div>
                <div class="form-group">
                    <label for="review">Review*:</label><br>
                    <textarea rows="4"  name="review" class="form-control" ><?php if($data['update']=='update'){echo $data['userReview']->review ;} ;?></textarea>
                </div>

                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                    <button type="submit" name="submit" class="btn btn-default">Leave review</button>

                </form>

            </div>
        </div>
        
        
     </div>  
</div>
    