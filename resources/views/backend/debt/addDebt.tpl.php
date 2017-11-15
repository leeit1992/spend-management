<div id="atl-page-handle-debt">
    <form action="<?php echo url( '/atl-admin/validate-debt' ) ?>" method="post" id="atl-form-debt" enctype="multipart/form-data">
        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-large-9-10 uk-container-center">
                <div class="md-card">
                    <div class="user_heading" data-uk-sticky="{ top: 48, media: 960 }">
                        <div class="user_heading_content">
                            <h2 class="heading_b">
                                <span class="uk-text-truncate"><?php echo $actionName; ?> Amount of Debt</span>
                            </h2>
                        </div>
                        <button type="submit" class="md-fab md-fab-small md-fab-success">
                            <i class="material-icons">save</i>
                        </button>
                        <?php 
                            if( !empty( $debt ) ) {
                                echo $self->renderInput( [
                                        'name'  => 'atl_debt_id', 
                                        'type'  => 'hidden', 
                                        'value' => $debt['id']
                                    ] );
                                View(
                                    $addButton,
                                    [
                                        'link'  => url( '/atl-admin/add-debt' ),
                                        'title' => 'debt'
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
                                                'name'  => 'atl_debt_price', 
                                                'class' => 'md-input masked_input atl-required-js',
                                                'value' => isset( $debt['debt_price'] ) ? $debt['debt_price'] : '',
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
                                                <label>Date</label>
                                                <?php
                                                    echo $self->renderInput( [
                                                            'type'  => 'text',
                                                            'name'  => 'atl_debt_date', 
                                                            'class' => 'md-input atl-required-js',
                                                            'value' => isset( $debt['debt_date'] ) ? $debt['debt_date'] : '',
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
                                                            'name'  => 'atl_debt_time', 
                                                            'class' => 'md-input',
                                                            'value' => isset( $debt['debt_time'] ) ? $debt['debt_time'] : '',
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
                                    <textarea class="md-input" name="atl_debt_description" cols="30" rows="6"><?php echo isset( $debt['debt_description'] ) ? $debt['debt_description'] : ''; ?></textarea>
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
    registerScrips( [ 'page-admin-debt' => assets( 'backend/js/page-admin-debt-debug.js' ) ] );
