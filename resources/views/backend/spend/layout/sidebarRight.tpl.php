<div class="uk-width-large-3-10">
    <div class="md-card">
        <div class="md-card-toolbar">
            <h3 class="md-card-toolbar-heading-text">Feature Image</h3>
            <?php
                if( !empty( $car['car_image'] ) ) {
                    echo $self->renderInput( [ 
                            'name' => 'atl_car_image', 
                            'type' => 'hidden', 
                            'value' => $car['car_image']
                        ] );
                }
            ?>
        </div>
        <div class="md-card-content">
            <?php if ( !empty( $car['car_image'] ) ) { ?>
                <div class="atl-featured-image-wrap">
                    <img src="<?php echo url($car['car_image']);?>">
                        <input type="hidden" value="<?php echo $car['car_image']; ?>" name="atl_car_image">
                </div>
                <a class="atl-featured-image-js"> Change featured image</a>                            
            <?php } else { ?>
                    <div class="atl-featured-image-wrap"></div>
                    <a class="atl-featured-image-js"> Chosse featured image</a> 
                <?php } ?>
        </div>
    </div>
    <div class="md-card">
        <div class="md-card-toolbar">
            <h3 class="md-card-toolbar-heading-text">Gallery Image</h3>
        </div>
        <div class="md-card-content">
            <div class="uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-3 atl-featured-gallery-wrap">
                <?php foreach ( $gallery as $gal ) {
                    ?>
                    <div>
                        <a href="<?php echo url($gal); ?>">
                        <img src="<?php echo url($gal); ?>" alt="">
                        <input type="hidden" value="<?php echo $gal; ?>" name="atl_car_gallery[]">
                        </a>
                        <span class="atl-gallery-remove"><i class="uk-icon-remove"></i></span>
                    </div>
                <?php } ?>
            </div>
            <a class="atl-gallery-js">Choose image gallery</a>     
        </div>
    </div>
</div>
