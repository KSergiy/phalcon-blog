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
    
    public function getMenu()
    {
        echo '<ul class="nav navbar-nav">';
        
        foreach ( $this->_main_menu as $key => $page ) 
        {
            $action = $this->view->getActionName();
            
            $class = ( $action == $key ) ? 'active' : '';
            
            echo '<li class="', $class, '"  >' . $this->tag->linkTo( [ ['for' => $page['route'], 'title' => $page['title'] ], $page['title'] ]) . '</li>';
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