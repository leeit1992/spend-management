<div id="atl-page-handle-user">
    <form action="<?php echo url('/atl-admin/validate-user') ?>" method="post" id="atl-form-user" enctype="multipart/form-data">
        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-large-7-10">
                <div class="md-card">
                    <?php 
                        View(
                            'backend/user/layout/addUserHead.tpl', 
                            [ 'actionName' => $actionName, 'meta' => $meta, 'mdUser' => $mdUser, 'self' => $self ] 
                        );
                    ?>
                    <div class="user_content">
                        <ul id="user_edit_tabs" class="uk-tab" data-uk-tab="{connect:'#user_edit_tabs_content'}">
                            <?php if( empty( $user ) ) : ?>
                            <li class="uk-active"><a href="#">Account</a></li>
                            <li><a href="#">Basic</a></li>
                            <?php endif;  ?>
                            <?php if( !empty( $user ) ) : ?>
                            <li class="uk-active"><a href="#">Basic</a></li>
                            <li><a href="#">Account</a></li>
                            <?php endif;  ?>
                        </ul>
                        <ul id="user_edit_tabs_content" class="uk-switcher uk-margin">
                            <?php 
                                if( empty( $user ) )  {
                                    View('backend/user/layout/addUserAccount.tpl', [ 'user' => $user, 'self' => $self ] );
                                    View('backend/user/layout/addUserBasic.tpl', 
                                        ['meta' => $meta, 'user' => $user, 'social' => $social, 'self' => $self ] 
                                    );
                                }else{
                                    View('backend/user/layout/addUserBasic.tpl', 
                                        ['meta' => $meta, 'user' => $user, 'social' => $social, 'self' => $self ]
                                    );
                                    View('backend/user/layout/addUserAccount.tpl', [ 'user' => $user, 'self' => $self ] );
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="uk-width-large-3-10">
                <div class="md-card">
                    <div class="md-card-content">
                        <h3 class="heading_c uk-margin-medium-bottom">Other settings</h3>
                        <div class="uk-form-row">
                            <?php
                                echo $self->renderInput( [
                                        'name' => 'atl_user_status',
                                        'type' => 'checkbox',
                                        'class' => 'atl-required-js',
                                        'value' => 1,
                                        'attr' => [
                                            'id' => 'user_edit_active',
                                            'data-switchery' => '',
                                            isset( $user['user_status'] ) ? checked( 1, $user['user_status'] ) : '' => ''
                                        ]
                                    ] );
                            ?>
                            <label for="user_edit_active" class="inline-label">User Active</label>
                        </div>
                        <hr class="md-hr">
                        <div class="uk-form-row">
                            <h3 class="heading_c uk-margin-bottom">User Role</h3>
                            <select data-md-selectize name="atl_user_role">
                                <?php foreach ($mdUser->getRoleUser() as $key => $value) {
                                    $selected = isset( $meta['user_role'] ) ? selected($meta['user_role'], $key) : '';
                                    echo '<option ' . $selected . ' value="' . $key . '">' . $value . ' </option>';
                                } ?>
                            </select>
                        </div>
                        <hr class="md-hr">
                        <div class="uk-form-row">
                            <h3 class="heading_c uk-margin-bottom">User Office</h3>
                            <select data-md-selectize name="atl_user_office">
                                <option value="">Choose Office</option>
                                <?php
                                    foreach ($listOffice as $office) {
                                        $selected = isset( $meta['user_office'] ) ? selected( $meta['user_office'], $office['id'] ) : '';
                                    ?>
                                    <option <?php echo $selected ?> value="<?php echo $office['id']; ?>"> <?php echo $office['office_name'] ?></option>
                                    <?php }
                                ?>
                            </select>
                        </div>
                        <?php
                            if( !empty( $user ) ) {
                                echo $self->renderInput( [
                                        'name' => 'atl_spend_user_id', 
                                        'type' => 'hidden', 
                                        'value' => $user['id']
                                    ]
                                );
                                echo $self->renderInput( [
                                        'name' => 'atl_user_avatar',
                                        'type' => 'hidden',
                                        'value' => $meta['user_avatar']
                                    ]
                                );
                                View(
                                    $addButton,
                                    [
                                        'link' => url('/atl-admin/add-user'),
                                        'title' => 'user'
                                    ]
                                );
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="uk-notify uk-notify-bottom-right atl-notify-js" style="display: none;" data-notify="<?php echo isset( $notify[0] ) ? $notify[0] : ''; ?>"></div>
</div>

<?php 
    registerScrips( [ 'page-admin-user' => assets('backend/js/page-admin-user.min.js') ] );
