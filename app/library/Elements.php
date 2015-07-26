<?php

use Phalcon\Mvc\User\Component;

/**
 * Elements
 */
class Elements extends Component 
{
    private $_main_menu = [
        'index' => [
            'route' => 'home',
            'title' => 'Home'
        ],
//        'pages' => [
//            'route' => 'pages',
//            'title' => 'Blocks'
//        ],
        'info' => [
            'route' => 'info',
            'title' => 'Info'
        ],
        'contacts' => [
            'route' => 'contacts',
            'title' => 'About me'
        ],
    ];

    private $_admin_menu = [
        'pages' => [
            'route' => 'pages',
            'title' => 'Pages',
            'sub' => [
                'create' => [
                    'route' => 'pages/create/',
                    'title' => 'Create page'
                ],
                'list' => [
                    'route' => 'pages/list/',
                    'title' => 'List pages'
                ]
            ]
        ],
        'publications' => [
            'route' => 'pages',
            'title' => 'Publications',
            'sub' => [
                'create' => [
                    'route' => 'publications/create/',
                    'title' => 'Create publication'
                ],
                'list' => [
                    'route' => 'publications/list/',
                    'title' => 'List publications'
                ]
            ]
        ],
        'logout' => [
            'route' => 'login/logout/',
            'title' => 'Logout',
        ]
    ];
    
    public function getMenu()
    {
        echo '<ul class="nav navbar-nav pull-right">';
        
        foreach ( $this->_main_menu as $key => $page ) 
        {
            $action = $this->view->getActionName();
            
            $class = ( $action == $key ) ? 'active' : '';
            
            echo '<li class="', $class, '"  >' . $this->tag->linkTo( [ ['for' => $page['route'], 'title' => $page['title'] ], $page['title'] ]) . '</li>';
        }

        $auth = $this->session->get('auth-identity');

        if ( $auth )
        {
            foreach ( $this->_admin_menu as $key => $page )
            {
                $action = $this->view->getActionName();

                $class = ( $action == $key ) ? 'active' : '';

                if ( isset( $page['sub'] ) )
                {
                    echo '<li class="',$class,' dropdown" >';
                    echo $this->tag->linkTo(
                            [
                                '#',
                                $page['title'],
                                'class' => 'dropdown-toggle',
                                'data-toggle' => 'dropdown'
                            ]
                        );

                    echo "<ul class='dropdown-menu'>";

                    foreach ( $page['sub'] as $sub_page )
                    {
                        echo '<li>' . $this->tag->linkTo( $sub_page['route'], $sub_page['title']) . '</li>';
                    }

                    echo "</ul>";

                    echo '</li>';
                }
                else
                {
                    echo '<li class="', $class, '"  >' . $this->tag->linkTo( $page['route'], $page['title']) . '</li>';
                }
            }
        }

        echo '</ul>';
    }
    
    public function getSubMenu( $id )
    {
        $_subCatalog = Pages::find(array(
                    "conditions" => "location = ?1 AND status = 1",
                    'order'      => 'position',
                    "bind"       => array(1 => $id)
                ));
        
        echo '<ul class="dropdown-menu" role="menu">';

        foreach( $_subCatalog as $item )
        {
            echo '<li>';

            echo $this->tag->linkTo( '/catalog/' . $item->url . '/', $item->PagesInfo->title );

            echo '</li>';
        }

        echo '</ul>';
    }
}