<?php

use Phalcon\Mvc\User\Component;

/**
 * Elements
 *
 * @author Пользователь
 */
class Elements extends Component 
{
    
    public function getMenu()
    {
        $_pages = new Pages();
        
        echo '<ul class="nav nav-justified">';
        
        echo '<li></li>';
        
        foreach ( $_pages->getCatalogPages() as $page ) 
        {
            $page_url = $this->dispatcher->getParam("page");
            
            $class = ( $page_url == $page->name ) ? 'active' : '';
            
            echo '<li class="', $class, '"  >' . $this->tag->linkTo( '/' . $page->name. '/', $page->PagesInfo->title) . '</li>';
        
            echo '<li></li>';
        }
        
        echo '<li class="visible-xs-block">' . $this->tag->linkTo( '/shipment-payment/', 'Доставка и оплата') . '</li>';
        
        echo '<li class="visible-xs-block">' . $this->tag->linkTo( '/contacts/', 'Контакты') . '</li>';
        
        echo '</ul>';
    }
    
    public function getFooterMenu()
    {
        $_pages = Pages::find(array(
                    "conditions" => "footer = 1",
                    'order'      => 'sort',
                ));

        echo '<ul class="nav navbar-nav pull-right">';
        
        foreach ($_pages as $page) 
        {
            echo '<li>' . $this->tag->linkTo( '/' . $page->name. '/', $page->PagesInfo->title) . '</li>';
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
    
    public function getCatlog( $page, $name = NULL )
    {
        echo '<div class="nav-collapse sub-menu col-md-12">'
            . '<ul class="nav navbar-nav">';
          
        foreach ($page->SubPages as $menu) 
        {
            $class = ( $name == $menu->url ) ? 'active' : '';
            
            echo "<li class='{$class}'>"
                ."<a href = '/catalog/list/#{$menu->url}' >{$menu->PagesInfo->title}</a>"
                ."</li>";
        }
        
        echo '</ul>'
            . '</div>';
    }
    
}
