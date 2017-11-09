<div id="atl-page-handle-user">
    <div class="md-card uk-margin-medium-bottom">
        <div class="md-card-content">
            <h3 class="heading_a uk-margin-bottom">Users Management</h3>
            <?php View('backend/user/layout/manageUserFilter.tpl', [ 'mdUser' => $mdUser ]); ?>
            <br>
            <?php View( $manageAction ); ?>
            <br>
            <div class="uk-overflow-container">
                <table class="uk-table uk-table-hover">
                    <thead>
                    <tr>
                        <th class="uk-text-center uk-text-nowrap">
                            <input type="checkbox" class="atl-checkbox-primary-js" />
                        </th>
                        <th class="uk-text-center uk-text-nowrap"> 
                            Avatar 
                        </th>
                        <th class="uk-width-2-5 uk-text-nowrap">Email</th>
                        <th class="uk-width-1-5 uk-text-nowrap">Office</th>
                        <th class="uk-width-1-5 uk-text-center uk-text-nowrap">Role</th>
                        <th class="uk-width-1-5 uk-text-center uk-text-nowrap">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="atl-list-user-not-js">
                        <?php foreach ($listUser as $value): ?>
                        <tr class="atl-user-item-<?php echo $value['id'] ?>">
                            <td class="uk-text-center">
                                <input type="checkbox" class="atl-checkbox-child-js" value="<?php echo $value['id'] ?>" />
                            </td>
                            <td class="uk-text-center">
                            <?php
                                $avatar = $value['meta']['user_avatar'];
                            ?>
                                <img class="md-user-image" style="height: 34px;" src="<?php echo url(!empty($avatar)?$avatar:'/public/backend/assets/img/user.png') ?>">
                            </td>
                            <td>
                                <?php echo $value['user_email'] ?>
                            </td>
                            <td>
                                <?php 
                                /*
                                    $infoOffice = $mdOffice->getOfficeBy( 'id', $value['meta']['user_office']);
                                    echo isset( $infoOffice[0]['office_name'] ) ? $infoOffice[0]['office_name'] : '-nome-'; */
                                ?>
                            </td>
                            <td class="uk-text-center">
                                <span class="uk-badge <?php echo ('admin' == $value['meta']['user_role'] ? 'uk-badge-danger': '') ?>">
                                    <?php echo $mdUser->getRoleUser( $value['meta']['user_role'] ) ?>
                                </span>
                            </td>
                            <td class="uk-text-center">
                                <a href="<?php echo url('/atl-admin/edit-user/' . $value['id']) ?>">
                                    <i class="md-icon material-icons">edit</i>
                                </a>
                                <a href="#" class="atl-manage-user-delete-js" data-id="<?php echo $value['id'] ?>">
                                    <i class="md-icon material-icons">delete</i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tbody class="atl-list-user-js"></tbody>
                </table>
            </div>
            <br>
        <?php
            View( $manageAction );
            echo $pagination;
        ?>
        </div>
        <?php 
            View(
                $addButton,
                [
                    'link' => url('/atl-admin/add-user'),
                    'title' => 'partner'
                ]
            );
        ?>
    </div>  
</div>

<?php 
    registerScrips( [ 'page-admin-user' => assets('backend/js/page-admin-user.min.js') ] );