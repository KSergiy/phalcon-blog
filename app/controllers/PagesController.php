<?php

class PagesController extends ControllerAdmin
{
    public function createAction()
    {
        $this->tag->setTitle('Create Page');

        $form = new Pages_PagesForm();

        $this->view->setVar('pageForm', $form);

        parent::initialize();
    }

    public function addlocalizationAction( $id = null )
    {
        if ($this->request->isPost() == true)
        {
            $form = new Pages_LocalizationForm;

            // Validate the form
            $data = $this->request->getPost();

            if ( !$form->isValid( $this->request->getPost() ) )
            {
                foreach ( $form->getMessages() as $key => $message )
                {
                    $this->flash->error( $message );
                }

                return $this->response->redirect("pages/addlocalization/" . $data['page_id']);
            }

            $info = new PagesInfo();

            $info->title = $data['title'];
            $info->page_id = $data['page_id'];
            $info->content = $data['content'];
            $info->meta_title = $data['title'];
            $info->meta_keywords = $data['metaKeywords'];
            $info->meta_description = $data['metaDescription'];

            if ( $info->save() != false )
            {
                $pLang = new PagesLangs();

                $pLang->page_id = $data['page_id'];
                $pLang->info_id = $info->id;
                $pLang->lang_id = $data['lang'];

                $pLang->save();

                return $this->response->redirect( 'pages/edit/' . $data['page_id'] . '/' . $data['lang'] );
            }
        }

        $langDB = PagesLangs::find(array(
            'conditions' => 'page_id = ?1',
            'bind'  => array( 1 => $id)
        ));

        $this->tag->setTitle('Add localization');

        $this->view->setVars(
            array(
                'id' => $id,
                'pageForm' => new Pages_LocalizationForm( $langDB )
            )
        );

        parent::initialize();
    }

    public function listAction()
    {
        $this->tag->setTitle('List of all pages' . $this->authStatus);

        $pages = Pages::find();

        $this->view->setVars(array('pages' => $pages));

        parent::initialize();
    }

    public function editAction( $idGet, $langGet )
    {
        $this->tag->setTitle('Edit page');

        $lang = Langs::findFirst(array(
            "conditions" => "lang_name = ?1",
            "bind"       => array(1 => $langGet),
            //"cache"      => array( "key" => 'catalog'.$url, "lifetime" => 172800 )
        ));
/*
        $info = PagesInfo::findFirst (array(
                'conditions' => 'PagesLangs.lang_id = ?1 AND PagesLangs.page_id = ?2',
                'bind'  => array( 1 => $lang->id, 2 => $idGet )
            ));
        /*
        $info = PagesLangs::findFirst(array(
            "conditions" => "Langs.lang_name = ?1 AND page_id = ?2",
            "bind"       => array(1 => $lang->id, 2 => $idGet)
        ));
        */
        $pageDB = Pages::findFirst( 'id = ' . $idGet );

//        $pageDB = Pages::getPage( $idGet, '2' );

        echo '<pre>';

        //print_r( $pageDB );

        $langs = $pageDB->getRelated( 'PagesLangs', [
            'conditions' => 'lang_id = ' . $lang->id . ''
        ] )->getFirst;

        print_r( $langs->id );

        //print_r( $pageDB->Langs->id );

        //print_r( $pageDB->Info->title );
        echo '</pre>';
        exit();

        if ( $pageDB != false )
        {
            $this->view->setVars(
                array(
                    'page' => $pageDB,
                    'pageForm' => new Pages_PagesForm( $pageDB, true )
                )
            );
        }

        parent::initialize();
    }

    public function deleteAction( $id )
    {
        $page = Pages::findFirst( $id );

        if ( $page != false )
        {
            $page->PagesInfo->delete();

            $page->PagesLangs->delete();

            $page->delete();
        }

        return $this->responce->redirect('/pages/list/');
    }

    public function addAction()
    {
        if ($this->request->isPost() != true)
        {
            return $this->response->redirect( 'pages/create/' );
        }

        $form = new Pages_PagesForm;

        // Validate the form
        $data = $this->request->getPost();

        if ( !$form->isValid( $this->request->getPost() ) )
        {
            foreach ( $form->getMessages() as $key => $message )
            {
                $this->flash->error( $message );
            }

            return $this->dispatcher->forward(["action" => "create", 'params' => array('pages') ]);
        }

        $page = new Pages();

        $page->location = $data['location'];
        $page->type = $data['type'];
        $page->status = 0;
        $page->position = 0;
        $page->name = $data['name'];

        if ( $page->save() != false )
        {
            $info = new PagesInfo();

            $info->title = $data['title'];
            $info->page_id = $page->id;
            $info->content = $data['content'];
            $info->meta_title = $data['title'];
            $info->meta_keywords = $data['metaKeywords'];
            $info->meta_description = $data['metaDescription'];

            if ( $info->save() != false )
            {
                $pLang = new PagesLangs();

                $pLang->page_id = $page->id;
                $pLang->info_id = $info->id;
                $pLang->lang_id = $data['lang'];

                $pLang->save();

                return $this->response->redirect( 'pages/edit/' . $page->id . '/' . $data['lang'] );
            }
            else
            {
                echo "Error, can't store page info right now: \n";
                foreach ( $page->getMessages() as $message ) {
                    echo $message, "\n";
                }
            }
        }
        else
        {
            echo "Error, can't store page right now: \n";
            foreach ( $page->getMessages() as $message ) {
                echo $message, "\n";
            }
        }
    }

    public function saveAction()
    {
        if ($this->request->isPost() != true)
        {
            return $this->response->redirect( 'pages/list/' );
        }

        $form = new Pages_PagesForm;

        // Validate the form
        $data = $this->request->getPost();

        if ( !$form->isValid( $this->request->getPost() ) )
        {
            foreach ( $form->getMessages() as $key => $message )
            {
                $this->flash->error( $message );
            }
            return $this->forward( '/pages/create/' );
        }

        $page = Pages::findFirst( $data['id'] );

        $page->location = $data['location'];
        $page->type = $data['type'];
        $page->name = $data['name'];

        $langDB = PagesLangs::findFirst(array(
            'conditions' => 'page_id = ?1 AND lang_id = ?2',
            'bind'  => array( 1 => $data['id'], 2 => $data['lang'] )
        ));

        $info = PagesInfo::findFirst(array(
            "conditions" => "id = ?1",
            "bind"       => array( 1 => $langDB->info_id ),
            //"cache"      => array( "key" => 'catalog'.$url, "lifetime" => 172800 )
        ));

        $info->title = $data['title'];
        $info->content = $data['content'];
        $info->meta_title = $data['title'];
        $info->meta_keywords = $data['metaKeywords'];
        $info->meta_description = $data['metaDescription'];
        $info->save();

        return $this->response->redirect( 'pages/edit/' . $page->id . '/' . $data['lang'] );
    }
}