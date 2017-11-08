<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> 
<html lang="en"> <!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no"/>

    <title>Atl Travel Manage - Login Page</title>

    <?php  
        enqueueStyle( [
            'googleapis'  => 'http://fonts.googleapis.com/css?family=Roboto:300,400,500',
            'almost'      => assets( 'backend/bower_components/uikit/css/uikit.almost-flat.min.css' ),
            'login_page'  => assets( 'backend/assets/css/login_page.min.css' )
        ] );
    ?>

</head>
<body class="login_page">

    <div class="login_page_wrapper">
        <div class="md-card" id="login_card">

            <?php 
                if( !empty( $noticeLogin ) ) {
                    ?>
                    <div class="uk-alert uk-alert-warning" data-uk-alert="">
                        <a href="#" class="uk-alert-close uk-close"></a>
                        <?php
                            echo $noticeLogin[0];
                        ?>
                    </div>
                    <?php   
                }
            ?>
           
            <div class="md-card-content large-padding" id="login_form">
                <div class="login_heading">
                    <div class="user_avatar"></div>
                </div>
                <form method="POST" action="<?php echo url( '/check-login' ); ?>">
                    <div class="uk-form-row">
                        <label for="atl_login_acc">Email</label>
                        <input class="md-input" type="email" name="atl_login_acc" />
                    </div>
                    <div class="uk-form-row">
                        <label for="atl_login_pass">Password</label>
                        <input class="md-input" type="password" name="atl_login_pass" />
                    </div>
                    <div class="uk-margin-medium-top">
                        <button type="submit" class="md-btn md-btn-primary md-btn-block md-btn-large">Sign In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php  
        enqueueScripts( [
            'common'  => assets( 'backend/assets/js/common.min.js' ),
            'altair_admin_common' => assets( 'backend/assets/js/altair_admin_common.min.js' ),
            'login'  => assets( 'backend/assets/js/pages/login.min.js' ),
        ] );
    ?>
</body>
</html>
