<li>
    <div class="uk-margin-top">
        <h3 class="full_width_in_card heading_c">
            General info
        </h3>
        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-2">
                <label>User name</label>
                <?php
                    echo $self->renderInput( [
                            'name'  => 'atl_user_name',
                            'type'  => 'text',
                            'class' => 'md-input',
                            'value' => isset( $user['user_name'] ) ? $user['user_name'] : ''
                        ] );
                ?>
            </div>
            <div class="uk-width-medium-1-2">
                <div class="uk-input-group">
                    <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                    <div class="md-input-wrapper <?php echo isset( $meta['user_birthday'] ) ? 'md-input-filled' : '' ?>">
                        <label>Birthday</label>
                        <?php
                            echo $self->renderInput( [
                                    'name'  => 'atl_user_birthday',
                                    'type'  => 'text',
                                    'class' => 'md-input',
                                    'value' => isset( $meta['user_birthday'] ) ? $meta['user_birthday'] : '',
                                    'attr'  => [
                                            'data-uk-datepicker' => "{format:'DD.MM.YYYY'}"
                                        ]
                                ] );
                        ?>
                        <span class="md-input-bar"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="uk-grid">
            <div class="uk-width-1-1">
                <label>More information</label>
                <textarea class="md-input" name="atl_user_moreinfo" cols="30" rows="4"><?php echo isset( $meta['user_moreinfo'] ) ? $meta['user_moreinfo'] : ''; ?></textarea>
            </div>
        </div>
        <h3 class="full_width_in_card heading_c">
            Contact info
        </h3>
        <div class="uk-grid">
            <div class="uk-width-1-1">
                <div class="uk-grid uk-grid-width-1-1 uk-grid-width-large-1-2" data-uk-grid-margin>
                    <div>
                        <div class="uk-input-group">
                            <span class="uk-input-group-addon">
                                <i class="md-list-addon-icon material-icons material-icons">home</i>
                            </span>
                            <label>Address</label>
                            <?php
                                echo $self->renderInput( [
                                        'name'  => 'atl_user_address',
                                        'type'  => 'text',
                                        'class' => 'md-input',
                                        'value' => isset( $user['user_address'] ) ? $user['user_address'] : ''
                                    ] );
                            ?>
                        </div>
                    </div>
                    <div>
                        <div class="uk-input-group">
                            <span class="uk-input-group-addon">
                                <i class="md-list-addon-icon material-icons">&#xE0CD;</i>
                            </span>
                            <label>Phone Number</label>
                            <?php
                                echo $self->renderInput( [
                                        'name'  => 'atl_user_phone',
                                        'type'  => 'text',
                                        'class' => 'md-input',
                                        'value' => isset( $meta['user_phone'] ) ? $meta['user_phone'] : ''
                                    ] );
                            ?>
                        </div>
                    </div>
                    <div>
                        <div class="uk-input-group">
                            <span class="uk-input-group-addon">
                                <i class="md-list-addon-icon uk-icon-facebook-official"></i>
                            </span>
                            <label>Facebook</label>
                            <?php
                                echo $self->renderInput( [
                                        'name'  => 'atl_user_social[fb]',
                                        'type'  => 'text',
                                        'class' => 'md-input',
                                        'value' => isset( $social['fb'] ) ? $social['fb'] : ''
                                    ] );
                            ?>
                        </div>
                    </div>
                    <div>
                        <div class="uk-input-group">
                            <span class="uk-input-group-addon">
                                <i class="md-list-addon-icon uk-icon-google-plus"></i>
                            </span>
                            <label>Google+</label>
                            <?php
                                echo $self->renderInput( [
                                        'name'  => 'atl_user_social[gplus]',
                                        'type'  => 'text',
                                        'class' => 'md-input',
                                        'value' => isset( $social['gplus'] ) ? $social['gplus'] : ''
                                    ] );
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</li>
