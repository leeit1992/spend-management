<?php
namespace App\Http\Controllers\Backend;

use Atl\Foundation\Request;
use Atl\Validation\Validation;
use App\Http\Components\Controller as baseController;
use App\Model\UserModel;

class UserController extends baseController
{
	public function __construct() {
		parent::__construct();
		$this->userAccess();

		// Model data system.
		$this->mdUser = new UserModel;
	}

	/**
	 * Handle display add | edit user.
	 * 
	 * @param  int $id ID of user edit.
	 * @return string
	 */
	public function handleUser( $id ) {
		$infoUser   = $this->mdUser->getUserBy( 'id', $id );
		$metaData   = $this->mdUser->getAllMetaData( $id );
		$userSocial = ( array ) json_decode( $metaData['user_social'] );

		if( empty( $infoUser ) ) {
			redirect( url( '/atl-admin/error-404?url=' . $_SERVER['REDIRECT_URL'] ) );
		}

		// Load template
		return $this->loadTemplate(
			'backend/user/addUser.tpl',
			[
				'user'   => $infoUser[0],
				'meta'   => $metaData,
				'social' => $userSocial,
				'mdUser' => $this->mdUser,
				'notify' => Session()->getFlashBag()->get( 'userFormNotice' ),
				'self'   => $this
			]
		);
	}

	/**
	 * Handle validate form user.
	 * 
	 * @param  Request $request Request POST | GET method
	 * @return void.
	 */
	public function validateUser( Request $request ) {
		if( !empty( $request->get( 'formData' ) ) ) {
			parse_str ($request->get('formData'), $formData );

			$notice    = [];
			$validator = new Validation;
			// Check validate user.
			$validator->add( [
				'atl_user_email:Email'     => 'required | minlength(6)',
				'atl_user_pass:Password'   => 'required | minlength(6)',
				'atl_user_cf_pass:Confirm' => 'required | minlength(6) | match(item=atl_user_pass)'
			] );
			if ( $validator->validate( $formData ) ) {
				// Save user.
				$emailExists = $this->mdUser->getUserBy( 'user_email', $formData['atl_user_email'] );
				$emailExists = isset( $formData['atl_user_id'] ) ? [] : $emailExists;

				if( empty( $emailExists ) ) {
					/**
					 * Insert | Update user.
					 */
					$lastID = $this->mdUser->save( [
							'user_name'         => empty( $formData['atl_user_name'] ) ? $formData['atl_user_email'] : $formData['atl_user_name'],
							'user_password'     => $this->isValidMd5( $formData['atl_user_pass'] ) ? $formData['atl_user_pass'] : md5( $formData['atl_user_pass'] ),
							'user_email'        => $formData['atl_user_email'],
							'user_registered'   => date( "Y-m-d H:i:s" ),
							'user_status'       => !empty( $formData['atl_user_status'] ) ? $formData['atl_user_status'] : 0,
							'user_display_name' => empty( $formData['atl_user_name'] ) ? $formData['atl_user_email'] : $formData['atl_user_name'],
						],
						$formData['atl_user_id']
					);
					/**
					 * Upload avatar
					 */
					$linkAvatar = isset( $formData['atl_user_avatar'] ) ? $formData['atl_user_avatar'] : null;
					if( !empty( $request->files->get('avatar') ) ) {
						$dir = FOLDER_UPLOAD . '/avatar_user';
						// Check if dir.
						if( !is_dir( $dir ) ) {
							mkdir( $dir );
						}
						// Custom link avatar.
						$linkAvatar =  '/uploads/avatar_user/avatar-user-' . $lastID . '.png';
						
						// Move to folder upload.
						$request->files->get('avatar')->move( $dir, 'avatar-user-' . $lastID . '.png' );
					}
					/**
					 * Add meta data for user.
					 */
					$userMeta = [
						'user_birthday' => $formData['atl_user_birthday'],
						'user_address'  => $formData['atl_user_address'],
						'user_moreinfo' => $formData['atl_user_moreinfo'],
						'user_phone'    => $formData['atl_user_phone'],
						'user_social'   => $formData['atl_user_social'],
						'user_role'     => $formData['atl_user_role'],
						'user_office'   => $formData['atl_user_office'],
						'user_avatar'   => $linkAvatar
					];
					// Loop add add | update meta data.
					foreach ( $userMeta as $mtaKey => $metaValue) {
						$this->mdUser->setMetaData( $lastID, $mtaKey, $metaValue );
					}

					// Set notice success
					Session()->getFlashBag()->set( 'userFormNotice', 'Update account successfully' );

					// Set notice success
					$notice['id']     = $lastID;
					$notice['status'] = true;
				} else {
					// Set notice error
					$notice['status']    = false;
					$notice['message'][] = 'This account already exists.';
				}
			} else {
				$notice['status']  = false;
				foreach ( $validator->getAllErrors() as $value ) {
					$notice['message'][] = $value;
				}
			}
			echo json_encode( $notice );
		}	
	}
}
