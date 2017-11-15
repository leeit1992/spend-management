<div id="atl-page-handle-collected">
    <form action="<?php echo url( '/atl-admin/validate-collected' ) ?>" method="post" id="atl-form-collected" enctype="multipart/form-data">
        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-large-9-10 uk-container-center">
                <div class="md-card">
                    <div class="user_heading" data-uk-sticky="{ top: 48, media: 960 }">
                        <div class="user_heading_content">
                            <h2 class="heading_b">
                                <span class="uk-text-truncate"><?php echo $actionName; ?> Money Collected</span>
                            </h2>
                        </div>
                        <button type="submit" class="md-fab md-fab-small md-fab-success">
                            <i class="material-icons">save</i>
                        </button>
                        <?php 
                            if( !empty( $collected ) ) {
                                echo $self->renderInput( [
                                        'name'  => 'atl_collected_id', 
                                        'type'  => 'hidden', 
                                        'value' => $collected['id']
                                    ] );
                                View(
                                    $addButton,
                                    [
                                        'link'  => url( '/atl-admin/add-collected' ),
                                        'title' => 'collected'
                                    ]
                                );
                            }
                        ?>
                    </div>
                    <div class="md-card-content large-padding">
                        <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                            <div class="uk-width-large-1-2">
                                <div class="uk-form-row">
                                    <label>Price</label>
                                    <?php
                                        echo $self->renderInput( [
                                                'type'  => 'text',
                                                'name'  => 'atl_collected_price', 
                                                'class' => 'md-input masked_input atl-required-js',
                                                'value' => isset( $collected['collected_price'] ) ? $collected['collected_price'] : '',
                                                'attr' => [
                                                    'data-inputmask' => "'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': true, 'prefix': 'vnđ ', 'placeholder': '0'",
                                                    'data-inputmask-showmaskonhover' => 'false'
                                                ]
                                            ] ); 
                                    ?>
                                </div>
                                <div class="uk-form-row">
                                    <br>
                                    <div class="uk-grid">
                                        <div class="uk-width-large-1-2 uk-width-medium-1-1">
                                            <div class="uk-input-group">
                                                <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                <label>Date Pay</label>
                                                <?php
                                                    echo $self->renderInput( [
                                                            'type'  => 'text',
                                                            'name'  => 'atl_collected_date', 
                                                            'class' => 'md-input atl-required-js',
                                                            'value' => isset( $collected['collected_date'] ) ? $collected['collected_date'] : '',
                                                            'attr' => [
                                                                'data-uk-datepicker' => "{format:'DD.MM.YYYY'}"
                                                            ]
                                                        ] ); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="uk-width-large-1-2 uk-width-medium-1-1">
                                            <div class="uk-input-group">
                                                <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-clock-o"></i></span>
                                                <label for="uk_tp_1">Time</label>
                                                <?php
                                                    echo $self->renderInput( [
                                                            'type'  => 'text',
                                                            'name'  => 'atl_collected_time', 
                                                            'class' => 'md-input',
                                                            'value' => isset( $collected['collected_time'] ) ? $collected['collected_time'] : '',
                                                            'attr' => [
                                                                'data-uk-timepicker' => ""
                                                            ]
                                                        ] ); 
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-width-large-1-2">
                                <div class="uk-form-row">
                                    <label>Description</label>
                                    <textarea class="md-input" name="atl_collected_description" cols="30" rows="6"><?php echo isset( $collected['collected_description'] ) ? $collected['collected_description'] : ''; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="uk-notify uk-notify-bottom-right atl-notify-js" style="display: none;" data-notify="<?php echo isset( $notify[0] ) ? $notify[0] : ''; ?>"></div>
</div>

<?php 
    registerScrips( [ 'page-admin-collected' => assets( 'backend/js/page-admin-collected-debug.js' ) ] );
