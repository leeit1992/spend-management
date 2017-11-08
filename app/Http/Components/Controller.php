<?php
namespace app\Http\Components;

use App\Http\Components\Backend\AdminDataMenu;
use App\Model\UserModel;
use Atl\Routing\Controller as baseController;

class Controller extends baseController
{
    public function __construct() {
        parent::__construct();
        $this->addButton = 'backend/template/addButton.tpl';
        $this->manageAction = 'backend/template/manageAction.tpl';
    }

    /**
     * Load template default.
     * 
     * @param string $path       Template file name.
     * @param array  $parameters Parameters for template.
     *
     * @return string
     */
    public function loadTemplate( $path, $parameters = [], $options = [] ) {
        $mdUser = new UserModel();
        $output = View(
            'backend/layout/header.tpl',
            [
                'userId' => Session()->get('atl_user_id'),
                'userInfo' => Session()->get('atl_user_meta'),
                'mdUser' => $mdUser,
                'editor' => !empty($options['editor']) ? $options : false
            ]
        );

        $output .= View(
            'backend/layout/sidebar.tpl',
            [
                'menuAdmin' => AdminDataMenu::getInstance( $this->getRoute() ),
            ]
        );
        $output .= View( $path, $parameters );
        $output .= View(
                    'backend/layout/footer.tpl',
                    [
                        'media' => !empty( $options['media'] ) ? $options : false,
                    ]
                );

        return $output;
    }

    /**
     * Check curent access. login or not login.
     */
    public function userAccess() {
        if ( true !== Session()->has( 'atl_user_id' ) ) {
            redirect( url( '/atl-login' ) );
        }
    }

    /**
     * Handle render input form.
     * 
     * @param array $args Attr input
     *
     * @return string
     */
    public function renderInput( $args = [] ) {
        $atts = parametersExtra( [
                'type'  => '',
                'name'  => '',
                'class' => '',
                'value' => '',
                'attr'  => []
            ],
            $args
        );

        $attrInput = '';
        foreach ( $atts['attr'] as $key => $value ) {
            if ( empty( $value ) ) {
                $attrInput .= ' '.$key.' ';
            } else {
                $attrInput .= ' '.$key.'="'.$value.'" ';
            }
        }

        return '<input class="'.$atts['class'].'" type="'.$atts['type'].'" name="'.$atts['name'].'"  value="'.$atts['value'].'" '.$attrInput.'>';
    }

    /**
     * Handle chek is md5.
     * 
     * @param string $md5 String md5
     *
     * @return bool
     */
    public function isValidMd5( $md5 = '' ) {
        return preg_match( '/^[a-f0-9]{32}$/', $md5 );
    }

    /**
     * Handle redirect to page 404.
     * 
     * @param string $route Link or router project
     */
    public function redirect404( $route ) {
        redirect( url( '/atl-admin/error-404?url='. $route ) );
    }

    /**
     * Setting config pagination
     * 
     * @return void
     */
    public function configPagination( $page='', $ofset='', $totalRow='', $baseUrl='' ) {
        $config['pageStart']  = $page;
        $config['ofset']      = $ofset;
        $config['totalRow']   =  $totalRow;
        $config['baseUrl']    = $baseUrl;
        $config['classes']    = 'uk-pagination uk-margin-medium-top';
        $config['nextLink']   = '<i class="uk-icon-angle-double-right"></i>';
        $config['prevLink']   = '<i class="uk-icon-angle-double-left"></i>';
        $config['tagOpenPageCurrent']   = '<li class="uk-active"><span>';
        $config['tagClosePageCurrent']  = '<span></li>';
        $config['tagOpen']    = '';
        $config['tagClose']   = '';
        
        return $config;
    }

    /**
     * convertDateToYmd 
     * Handle format date.
     * 
     * @param string $dateString Date string.
     *
     * @return string
     */
    public function convertDateToYmd( $dateString ) {
        return date( 'Y-m-d', strtotime( $dateString ) );
    }

    /**
     * convertTimeToHis 
     * Handle format time.
     * 
     * @param string $timeString Time string.
     *
     * @return string
     */
    public function convertTimeToHis( $timeString ) {
        return date( 'H:i:s', strtotime( $timeString ) );
    }
}
