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
                        <th class="uk-width-1-10 uk-text-center uk-text-nowrap">Date</th>
                        <th class="uk-width-4-10 uk-text-center uk-text-nowrap">Description</th>
                        <th class="uk-width-1-10 uk-text-center uk-text-nowrap">Amount paid</th>
                        <th class="uk-width-1-10 uk-text-center uk-text-nowrap">Money remain</th>
                        <th class="uk-width-2-10 uk-text-center uk-text-nowrap">Total money debt</th>
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
                                <?php echo $helpPrice->formatPrice( $value['debt_paid'] ); ?>
                            </td>
                            <td class="uk-text-middle">
                                <?php 
                                    $debt_remain = intval( $value['debt_price'] ) - intval( $value['debt_paid'] );
                                    if ( $debt_remain > 0) {
                                        echo '<span class="uk-text-danger uk-text-bold">'. $helpPrice->formatPrice( $debt_remain ) .'</span>';
                                    } else {
                                        echo '<span class="uk-text-success uk-text-bold">pay off the debt</span>';
                                    }
                                    
                                ?>
                            </td>
                            <td class="uk-text-middle">
                                <?php echo $helpPrice->formatPrice( $value['debt_price'] ); ?>
                            </td>
                            <td class="uk-text-middle">
                                <a title="Pay" data-uk-tooltip="{pos:'top'}" data-uk-modal="{target:'#modal_header_footer'}">
                                    <i class="md-icon material-icons">payment</i>
                                </a>

                                <a href="<?php echo url( '/atl-admin/edit-debt/' . $value['id'] ) ?>" title="Edit" data-uk-tooltip="{pos:'top'}">
                                    <i class="md-icon material-icons">edit</i>
                                </a>
                                <a href="#" class="atl-manage-debt-delete-js" data-id="<?php echo $value['id']; ?>" title='Delete' data-uk-tooltip="{pos:'top'}">
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
    <div class="uk-modal" id="modal_header_footer">
        <div class="uk-modal-dialog">
            <div class="uk-modal-header">
                <h3 class="uk-modal-title">Pay the debt</h3>
            </div>
            <input class="md-input masked_input atl-required-js" type="text" name="atl_debt_price" value="" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': true, 'prefix': 'vnđ ', 'placeholder': '0'" data-inputmask-showmaskonhover="false">
            <div class="uk-modal-footer uk-text-right">
                <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                <button type="button" class="md-btn md-btn-flat md-btn-flat-primary">Action</button>
            </div>
        </div>
    </div>
</div>

<?php 
    registerScrips( [ 'page-admin-debt' => assets( 'backend/js/page-admin-debt-debug.js' ) ] );
