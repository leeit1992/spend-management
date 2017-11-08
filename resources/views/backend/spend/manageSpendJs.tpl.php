<?php foreach ( $cars as $car ) : ?>
<tr class="atl-car-item-<?php echo $car['id']; ?>">
    <td class="uk-text-center">
        <input type="checkbox" class="atl-checkbox-child-js" value="<?php echo $car['id'] ?>" />
    </td>
    <td class="uk-text-center">
        <?php
            $car_image = $mdCar->getMetaData( $car['id'], 'car_image' );
            if ( !empty($car_image ) ) { ?>
                <img class="md-user-image" style="height: 34px;" src="<?php echo url( $car_image ); ?>">
        <?php  }
        ?>
    </td>
    <td>
        <?php echo $car['service_name']; ?>
    </td>
    <td class="uk-text-center">
        <?php echo $mdCar->getMetaData( $car['id'], 'car_seats' ); ?>
    </td>
    <td class="uk-text-center">
        <a href="<?php echo url( '/atl-admin/edit-car/' . $car['id'] ) ?>">
            <i class="md-icon material-icons">edit</i>
        </a>
        <a href="#" class="atl-manage-car-delete-js" data-id="<?php echo $car['id']; ?>">
            <i class="md-icon material-icons">delete</i>
        </a>
    </td>
</tr>
<?php endforeach; ?>