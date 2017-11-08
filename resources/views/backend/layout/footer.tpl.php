<?php
	enqueueScripts( [
		'common'  	   => assets( 'backend/assets/js/common.min.js' ),
		'uikit_custom' => assets( 'backend/assets/js/uikit_custom.min.js' ),
		'altair_admin_common'  => assets( 'backend/assets/js/altair_admin_common.min.js' ),
		'jquery-ui'  => assets( 'backend/bower_components/jquery-ui/jquery-ui.js' ),
	    'underscore' => assets( 'backend/bower_components/backbone/underscore.js' ),
	    'backbone'   => assets( 'backend/bower_components/backbone/backbone-min.js' ), 
	    'moxman'     => ( $media ) ? assets( 'backend/bower_components/moxiemanager/js/moxman.loader.min.js' ) : false,
	    'atl-backend' => assets( 'backend/js/backend-scripts.min.js'),
		'rangeSlider' => assets( 'backend/bower_components/ion.rangeslider/js/ion.rangeSlider.min.js' ),
	    'inputmask' => assets( 'backend/bower_components/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js' ),
	    'forms_advanced' => assets( 'backend/assets/js/pages/forms_advanced.min.js' )
	] );
?>
	</div>
</div>
<!-- end page content -->
</body>
</html>