<?php

use Phalcon\Mvc\View;

class FilterController extends ControllerBase
{
    public function catalogAction()
    {
        $result['code'] = 'empty';

        if ($this->request->isAjax() != true) 
        {
            return NULL;
        }

        $this->response->setContentType('application/json', 'UTF-8');
                
        $filter = $this->request->getPost( 'url' );

        $pageId = $this->request->getPost( 'page_id' );

        $options = Options::find(array(
                'conditions' => "option_filter = 1",
                'order'      => 'option_sort ASC'
            ));

        if ( !empty( $filter ) ) {
        
            $params = explode(';', $filter);

            $sql = '';

            foreach ( $params as $param )
            {
                $step = explode( '-', $param );

                $vals = explode(',', $step[1] );

                if ( count( $vals ) > 1 )
                {
                    $sql .= "OR ( ( value >= {$vals[0]} AND value <= {$vals[1]} ) AND option_id = '{$step[0]}' ) ";  
                }
                else
                {
                    $sql .= "OR ( ( value = '{$vals[0]}' ) AND option_id = '{$step[0]}' ) ";  
                }
            }

            $catalogOptions = OptionsCatalog::find(array(
                    'columns'       => 'catalog_token',
                    'conditions'    => substr( $sql, 3 ),
                    'group'         => 'catalog_token'
                ));

            $tokens = [];

            foreach ( $catalogOptions as $opt )
            {
                $tokens[] = $opt->catalog_token;
            }

            $query = "'".implode("','", $tokens)."'";

            $items = Items::find(array(
                    'conditions' => "token IN( {$query} ) AND owner_id = ?1",
                    'bind'       => array(1 => $pageId)
                ));
        } 
        else
        {
            $items = Items::find(array(
                'conditions' => "owner_id = ?1",
                'bind'       => array(1 => $pageId)
            ));
        }

        $this->view->setVars(array(
                'options'       => $options,
                'items'         => $items,
            ));

        $this->view->setRenderLevel( View::LEVEL_LAYOUT );

        $this->view->render('catalog', 'table');

        $result['view'] = $this->view->getContent();

        $result['code'] = 'success';

        $this->response->setContent( json_encode( $result ) );

        return $this->response;
    }
    
    public function mainAction()
    {
        $this->tag->setTitle('Фильтр');
        
        $this->view->setVars(array(
            'keywords'      => 'Фильтр',
            'description'   => 'Фильтр',
            'active'        => ''
        ));
    
        $querys = $this->request->getQuery();
        
        $sql = '';
        
        foreach ( $querys as $key => $query )
        {
            if ( !empty( $query ) )
            {
                $sql .= "OR ( ( value = '{$query}' ) AND option_id = '{$key}' ) ";
            }
            
        }
        
        $options = Options::find(array(
                'conditions' => "option_filter = 1",
                'order'      => 'option_sort ASC'
            ));

        $catalogOptions = OptionsCatalog::find(array(
                'columns'       => 'catalog_token',
                'conditions'    => substr( $sql, 3 ),
                'group'         => 'catalog_token'
            ));

        $tokens = [];

        foreach ( $catalogOptions as $opt )
        {
            $tokens[] = $opt->catalog_token;
        }

        $query = "'".implode("','", $tokens)."'";

        $items = Items::find(array(
                'conditions' => "token IN( {$query} )",
            ));
        
        foreach ( $options as $option )
        {
            if ( $option->option_type == 'int' )
            {
                $values[$option->option_id] = [];
                
                foreach ( $items as $item )
                {
                    foreach ( $item->options as $value ) 
                    {
                        $values[$value->option_id][] = $value->value;
                    }
                }
                
                $min[$option->option_id] = min( $values[$option->option_id] );
        
                $max[$option->option_id] = max( $values[$option->option_id] );
            }
        }
                
        $this->view->setVars(array(
            'options'       => $options,
            'items'         => $items,
            'max'           => $max,
            'min'           => $min
        ));
        
        $this->view->pick(array('catalog/filter'));
        
        parent::initialize();
    }
}