<?php

namespace App\Http\Components\Backend;

/**
 * adminDataMenu
 * Config data menu nav admin.
 *
 * @version  1.0
 * @author  HaLe 
 * @package  ATL
 */
class AdminDataMenu
{   
    /**
     * $getInstance - Support singleton module.
     * @var null
     */
    private static $getInstance = null;

    protected static $route = null;

    protected $menuService = [];

    private function __wakeup() {}

    private function __clone() {}

    private function __construct() {}

    public static function getInstance( $route = null ) {
        if ( !( self::$getInstance instanceof self ) ) {
            self::$getInstance = new self();
        }
        self::$route = $route;

        return self::$getInstance;
    }

    /**
     * dataMenu
     * Data menu action admin.
     */
    public function dataMenu() {   
        $menu['Dashboard'] = [
                'label' => 'Dashboard',
                'icon'  => '<i class="material-icons md-36">&#xE8F0;</i>',
                'conditionOpen' => ['Backend\MainController'],
                'display' => '',
                'link'  => url( '/atl-admin' ),
                'display' => ''
            ];
        $menu['spend'] = [
                'label'   => 'Spends',
                'icon'    => '<i class="material-icons md-36">local_atm</i>',
                'conditionOpen' => ['Backend\SpendController'],
                'display' => '',
                'submenu' => [
                    [
                        'label' => 'Spends Management',
                        'link'  => url('/atl-admin/manage-spend'),
                        'conditionOpen' => ['manageSpends'],
                    ],
                    [
                        'label' => 'Add Spend',
                        'link'  => url('/atl-admin/add-spend'),
                        'conditionOpen' => ['handleSpend'],
                    ]
                ]
            ];
        $menu['collected'] = [
                'label'   => 'Money Collected',
                'icon'    => '<i class="material-icons md-36">attach_money</i>',
                'conditionOpen' => ['Backend\CollectedController'],
                'display' => '',
                'submenu' => [
                    [
                        'label' => 'Collected Management',
                        'link'  => url('/atl-admin/manage-collected'),
                        'conditionOpen' => ['manageCollecteds'],
                    ],
                    [
                        'label' => 'Add Collected',
                        'link'  => url('/atl-admin/add-collected'),
                        'conditionOpen' => ['handleCollected'],
                    ]
                ]
            ];
        $menu['debt'] = [
                'label'   => 'Amount of Debt',
                'icon'    => '<i class="material-icons md-36">money_off</i>',
                'conditionOpen' => ['Backend\DebtController'],
                'display' => '',
                'submenu' => [
                    [
                        'label' => 'Debt Management',
                        'link'  => url('/atl-admin/manage-debt'),
                        'conditionOpen' => ['manageDebts'],
                    ],
                    [
                        'label' => 'Add Debt',
                        'link'  => url('/atl-admin/add-debt'),
                        'conditionOpen' => ['handleDebt'],
                    ]
                ]
            ];
        $menu['user'] = [
                'label'   => 'Users',
                'icon'    => '<i class="material-icons md-36">people</i>',
                'conditionOpen' => ['Backend\UserController'],
                'display' => '',
                'submenu' => [
                    [
                        'label' => 'Users Management',
                        'link'  => url('/atl-admin/manage-user'),
                        'conditionOpen' => ['manageUsers'],
                    ],
                    [
                        'label' => 'Add User',
                        'link'  => url('/atl-admin/add-user'),
                        'conditionOpen' => ['handleUser'],
                    ]
                ]
            ];
        return $menu;
    }


    /**
     * Render menu html.
     * 
     * @return string
     */
    public function menuNav() {   
        $control = self::$route['_controller'];
        $action  = self::$route['_action'];
    ?>
    <div class="menu_section">
        <ul>
            <?php 
            foreach ( $this->dataMenu() as $key => $value ): 
            $ruleDisplay = $this->menuService;
            if( !in_array( $key, $ruleDisplay ) ) :
            ?>

            <?php if( !isset( $value['submenu'] ) && 'none' !== $value['display'] ): ?>
            <li <?php echo ( in_array( $control, $value['conditionOpen'] ) ) ? 'class="current_section"' : '' ?> title="Dashboard">
                <a href="<?php echo $value['link'] ?>">
                    <span class="menu_icon"><?php echo $value['icon'] ?></span>
                    <span class="menu_title"><?php echo $value['label'] ?></span>
                </a>
            </li>
            <?php endif; ?>

            <?php if( isset( $value['submenu'] ) && 'none' !== $value['display'] ): ?>
            <li <?php echo ( in_array( $control, $value['conditionOpen'] ) ) ? 'class="current_section submenu_trigger act_section"' : '' ?>>
                <a href="#">
                    <span class="menu_icon"><?php echo $value['icon'] ?></span>
                    <span class="menu_title"> <?php echo $value['label'] ?></span>
                </a>
                <ul <?php echo ( in_array( $control, $value['conditionOpen'] ) ) ? 'style="display: block;"' : '' ?>>
                    <?php foreach ($value['submenu'] as $submenu): ?>
                    <li <?php echo ( in_array( $action, $submenu['conditionOpen'] ) ) ? 'class="act_item submenu_trigger act_section"' : '' ?>>
                        <a href="<?php echo $submenu['link'] ?>"> 
                            <?php echo $submenu['label'] ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </li>
            <?php endif; ?>
            <?php endif; ?>
            <?php endforeach; ?>  
        </ul>
    </div>
    <?php
    }
    public function serviceMenu(){
    }
}
