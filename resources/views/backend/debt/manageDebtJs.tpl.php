<?php if ( !empty( $debts ) ): ?>
    <?php foreach ( $debts as $value ) : ?>
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
    <tr class="uk-text-bold">
        <td class="uk-text-center uk-text-nowrap" colspan="2">
        </td>
        <td class="uk-text-center uk-text-danger uk-text-nowrap">
            Total price:
        </td>
        <td class="uk-text-center uk-text-danger uk-text-nowrap"><?php echo $helpPrice->formatPrice( $totalPrice ); ?></td>
        <td></td>
    </tr> 
<?php else: ?>
    <tr>
        <td class="uk-text-center uk-text-nowrap" colspan="6">
            <span class="uk-text-danger uk-text-upper uk-text-bold">Not data</span>
        </td>
    </tr> 
<?php endif ?>
