<div id="atl-page-handle-debt">
    <div class="md-card">
        <div class="md-card-toolbar">
            <h3 class="md-card-toolbar-heading-text">
                Filter List Debt
            </h3>
        </div>
        <div class="md-card-content">
            <?php View( 'backend/debt/layout/manageDebtFilter.tpl', [ 'mdDebt' => $mdDebt ] ); ?>
        </div>
    </div>
    <div class="md-card uk-margin-medium-bottom">
        <div class="md-card-content">
            <h3 class="heading_a uk-margin-bottom">Debts Management</h3>
            <br>
            <?php View( $manageAction ); ?>
            <br>
                <table class="uk-table uk-table-hover">
                    <thead>
                    <tr>
                        <th class="uk-text-center uk-text-nowrap">
                            <input type="checkbox" class="atl-checkbox-primary-js" />
                        </th>
                        <th class="uk-width-2-10 uk-text-center uk-text-nowrap">Date pay</th>
                        <th class="uk-width-4-10 uk-text-center uk-text-nowrap">Description</th>
                        <th class="uk-width-1-10 uk-text-center uk-text-nowrap">Price pay</th>
                        <th class="uk-width-1-10 uk-text-center uk-text-nowrap">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="atl-list-debt-not-js">
                        <?php foreach ( $listDebt as $value ): ?>
                        <tr class="atl-debt-item-<?php echo $value['id']; ?> uk-text-center">
                            <td class="uk-text-middle">
                                <input type="checkbox" class="atl-checkbox-child-js" value="<?php echo $value['id']; ?>" />
                            </td>
                            <td class="uk-text-middle">
                                <?php echo $value['debt_date']; ?>
                            </td>
                            <td class="uk-text-middle">
                                <?php echo $value['debt_description']; ?>
                            </td>
                            <td class="uk-text-middle">
                                <?php echo $helpPrice->formatPrice( $value['debt_price'] ); ?>
                            </td>
                            <td class="uk-text-middle">
                                <a href="<?php echo url( '/atl-admin/edit-debt/' . $value['id'] ) ?>">
                                    <i class="md-icon material-icons">edit</i>
                                </a>
                                <a href="#" class="atl-manage-debt-delete-js" data-id="<?php echo $value['id']; ?>">
                                    <i class="md-icon material-icons">delete</i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tbody class="atl-list-debt-js"></tbody>
                </table>
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
                    'link'  => url( '/atl-admin/add-debt' ),
                    'title' => 'debt'
                ]
            );
        ?>
    </div>  
</div>

<?php 
    registerScrips( [ 'page-admin-debt' => assets( 'backend/js/page-admin-debt-debug.js' ) ] );
