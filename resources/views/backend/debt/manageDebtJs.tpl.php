<?php if ( !empty( $debts ) ): ?>
    <?php foreach ( $debts as $value ) : 
        $debt_remain = intval( $value['debt_price'] ) - intval( $value['debt_paid'] );
    ?>
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
                    if ( $debt_remain > 0) {
                        echo '<span class="uk-text-danger uk-text-bold">'. $helpPrice->formatPrice( $debt_remain ) .'</span>';
                    } elseif ( $debt_remain == 0) {
                        echo '<span class="uk-text-success uk-text-bold">pay off the debt</span>';
                    } elseif ( $debt_remain < 0) {
                        echo '<span class="uk-text-success uk-text-bold">'. $helpPrice->formatPrice( $debt_remain ) .'</span>';
                    }
                    
                ?>
            </td>
            <td class="uk-text-middle">
                <?php echo $helpPrice->formatPrice( $value['debt_price'] ); ?>
            </td>
            <td class="uk-text-middle">
                <?php if ( $debt_remain > 0 ): ?>
                    <a class="atl-debt-view-js" data-id="<?php echo $value['id']; ?>" title="Pay" data-uk-tooltip="{pos:'top'}" data-uk-modal="{target:'#modal_header_footer'}">
                        <i class="md-icon material-icons">payment</i>
                    </a>
                <?php endif ?>
                <a href="<?php echo url( '/atl-admin/edit-debt/' . $value['id'] ) ?>" title="Edit" data-uk-tooltip="{pos:'top'}">
                    <i class="md-icon material-icons">edit</i>
                </a>
                <a href="#" class="atl-manage-debt-delete-js" data-id="<?php echo $value['id']; ?>" title='Delete' data-uk-tooltip="{pos:'top'}">
                    <i class="md-icon material-icons">delete</i>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    <tr class="uk-text-bold">
        <td class="uk-text-center uk-text-nowrap" colspan="3">
        </td>
        <td class="uk-text-center uk-text-nowrap">
            TOTAL MONEY:
        </td>
        <td class="uk-text-center uk-text-danger uk-text-nowrap"><?php echo $helpPrice->formatPrice( $totalRemain ); ?></td>
        <td class="uk-text-center uk-text-success uk-text-nowrap"><?php echo $helpPrice->formatPrice( $totalPrice ); ?></td>
        <td></td>
    </tr> 
<?php else: ?>
    <tr>
        <td class="uk-text-center uk-text-nowrap" colspan="6">
            <span class="uk-text-danger uk-text-upper uk-text-bold">Not data</span>
        </td>
    </tr> 
<?php endif ?>
