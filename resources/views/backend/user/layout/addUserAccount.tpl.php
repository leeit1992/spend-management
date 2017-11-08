<li>
    <div class="uk-margin-top">
        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
                <label for="user_edit_uname_control">Email</label>
                <?php 
                    echo $self->renderInput( [ 
                            'name'  => 'atl_user_email', 
                            'type'  => 'email',
                            'class' => 'md-input atl-required-js',
                            'value' => $user['user_email']
                        ] );
                ?>
            </div>
            <div class="uk-width-medium-1-2">
                <div class="md-input-wrapper md-input-filled">
                    <label for="user_edit_position_control">Password</label>
                    <?php 
                        echo $self->renderInput( [ 
                                'name'  => 'atl_user_pass', 
                                'type'  => 'password',
                                'class' => 'md-input atl-required-js',
                                'value' => $user['user_password']
                            ] );
                    ?>
                    <a href="#" class="uk-form-password-toggle" data-uk-form-password="">Show</a>
                    <span class="md-input-bar"></span>
                </div>
            </div>
            <div class="uk-width-medium-1-2">
                <div class="md-input-wrapper md-input-filled">
                    <label for="user_edit_position_control">Confirm password</label>
                    <?php 
                        echo $self->renderInput( [ 
                                'name'  => 'atl_user_cf_pass', 
                                'type'  => 'password',
                                'class' => 'md-input atl-required-js',
                                'value' => $user['user_password']
                            ] );
                    ?>
                    <a href="#" class="uk-form-password-toggle" data-uk-form-password="">Show</a>
                    <span class="md-input-bar"></span>
                </div>
            </div>
        </div>
    </div>  
</li>
