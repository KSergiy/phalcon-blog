<?php

class SearchController extends ControllerBase
{

    public function searchAction()
    {
        $q = $this->request->getQuery('q');
        
        $this->tag->setTitle('Резульаты поиска:' . $q);
        
        $this->view->setVars(array(
            'keywords'      => 'Резульаты поиска:' . $q,
            'description'   => 'Резульаты поиска:' . $q,
            'active'        => ''
        ));
        
        $options = Options::find(array(
            'conditions' => "option_filter = 1",
            'order'      => 'option_sort ASC'
            ));
        
        $items = Items::find(array(
                'conditions' => "artikul LIKE ?1",
                'bind'       => array(1 => $q)
            ));
        
        $this->view->setVars(array(
            'options'       => $options,
            'items'         => $items,
        ));
        
        parent::initialize();
    }
}