<?php if ( !empty( $collecteds ) ): ?>
    <?php foreach ( $collecteds as $value ) : ?>
        <tr class="atl-collected-item-<?php echo $value['id']; ?> uk-text-center">
            <td class="uk-text-middle">
                <input type="checkbox" class="atl-checkbox-child-js" value="<?php echo $value['id']; ?>" />
            </td>
            <td class="uk-text-middle">
                <?php echo $value['collected_date']; ?>
            </td>
            <td class="uk-text-middle">
                <?php echo $value['collected_description']; ?>
            </td>
            <td class="uk-text-middle">
                <?php echo $helpPrice->formatPrice( $value['collected_price'] ); ?>
            </td>
            <td class="uk-text-middle">
                <a href="<?php echo url( '/atl-admin/edit-collected/' . $value['id'] ) ?>">
                    <i class="md-icon material-icons">edit</i>
                </a>
                <a href="#" class="atl-manage-collected-delete-js" data-id="<?php echo $value['id']; ?>">
                    <i class="md-icon material-icons">delete</i>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    <tr class="uk-text-bold">
        <td class="uk-text-center uk-text-nowrap" colspan="2">
        </td>
        <td class="uk-text-center uk-text-danger uk-text-nowrap">
            Total money:
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
