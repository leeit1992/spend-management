<div id="atl-page-handle-spend">
    <form action="<?php echo url( '/atl-admin/validate-spend' ) ?>" method="post" id="atl-form-spend" enctype="multipart/form-data">
        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-large-7-10">
                <div class="md-card">
                    <div class="user_heading" data-uk-sticky="{ top: 48, media: 960 }">
                        <div class="user_heading_content">
                            <h2 class="heading_b">
                                <span class="uk-text-truncate"><?php echo $actionName; ?> Spend</span>
                            </h2>
                        </div>
                        <button type="submit" class="md-fab md-fab-small md-fab-success">
                            <i class="material-icons">save</i>
                        </button>
                        <?php 
                            if( !empty( $spend ) ) {
                                echo $self->renderInput( [
                                        'name'  => 'atl_spend_id', 
                                        'type'  => 'hidden', 
                                        'value' => $spend['id']
                                    ] );
                                View(
                                    $addButton,
                                    [
                                        'link'  => url( '/atl-admin/add-spend' ),
                                        'title' => 'spend'
                                    ]
                                );
                            }
                        ?>
                    </div>
                    <div class="md-card-content large-padding">
                        <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                            <div class="uk-width-large-1-2">
                                <div class="uk-form-row">
                                    <label>Price pay</label>
                                    <?php
                                        echo $self->renderInput( [
                                                'type'  => 'text',
                                                'name'  => 'atl_spend_price', 
                                                'class' => 'md-input masked_input atl-required-js',
                                                'value' => isset( $spend['spend_price'] ) ? $spend['spend_price'] : '',
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
                                                            'name'  => 'atl_spend_date', 
                                                            'class' => 'md-input atl-required-js',
                                                            'value' => isset( $spend['spend_date'] ) ? $spend['spend_date'] : '',
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
                                                <label for="uk_tp_1">Time pay</label>
                                                <?php
                                                    echo $self->renderInput( [
                                                            'type'  => 'text',
                                                            'name'  => 'atl_spend_time', 
                                                            'class' => 'md-input',
                                                            'value' => isset( $spend['spend_time'] ) ? $spend['spend_time'] : '',
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
                                    <textarea class="md-input" name="atl_spend_description" cols="30" rows="6"><?php echo isset( $spend['spend_description'] ) ? $spend['spend_description'] : ''; ?></textarea>
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
    registerScrips( [ 'page-admin-spend' => assets( 'backend/js/page-admin-spend-debug.js' ) ] );
