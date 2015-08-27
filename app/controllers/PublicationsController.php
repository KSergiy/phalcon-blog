<?php

class PublicationsController extends ControllerAdmin
{
    public function createAction()
    {
        $this->tag->setTitle('Create Publication');

        $form = new Publications_PublicationsForm();

        $this->view->setVar('pageForm', $form);

        parent::initialize();
    }

    public function addlocalizationAction( $id = null )
    {
        if ($this->request->isPost() == true)
        {
            $form = new Publications_LocalizationForm;

            // Validate the form
            $data = $this->request->getPost();

            if ( !$form->isValid( $this->request->getPost() ) )
            {
                foreach ( $form->getMessages() as $key => $message )
                {
                    $this->flash->error( $message );
                }

                return $this->response->redirect("publications/addlocalization/" . $data['page_id']);
            }

            $info = new PublicationsInfo();

            $info->title = $data['title'];
            $info->publication_id = $data['page_id'];
            $info->content = $data['content'];
            $info->meta_title = $data['title'];
            $info->meta_keywords = $data['metaKeywords'];
            $info->meta_description = $data['metaDescription'];

            if ( $info->save() != false )
            {
                $pLang = new PublicationsLangs();

                $pLang->publication_id = $data['page_id'];
                $pLang->info_id = $info->id;
                $pLang->lang_id = $data['lang'];

                $pLang->save();

                return $this->response->redirect( 'publications/edit/' . $data['page_id'] . '/' . $data['lang'] );
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
                'pageForm' => new Publications_LocalizationForm( $langDB )
            )
        );

        parent::initialize();
    }

    public function listAction()
    {
        $this->tag->setTitle('List of all publications');

        $publications = Publications::find();

        $this->view->setVars(array('pages' => $publications));

        parent::initialize();
    }

    public function editAction( $idGet, $langGet )
    {
        $this->tag->setTitle('Edit page');

        $pageDB = Publications::getPublication( $idGet, $langGet );

        if ( $pageDB != false )
        {
            $this->view->setVars(
                array(
                    'page' => $pageDB,
                    'pageForm' => new Publications_PublicationsForm( $pageDB, true )
                )
            );
        }

        parent::initialize();
    }

    public function deleteAction( $id )
    {
        $publication = Publications::findFirst( $id );

        if ( $publication != false )
        {
            $publication->PublicationsInfo->delete();

            $publication->PublicationsLangs->delete();

            $publication->delete();
        }

        return $this->responce->redirect('publications/list/');
    }

    public function addAction()
    {
        if ($this->request->isPost() != true)
        {
            return $this->response->redirect( 'publications/create/' );
        }

        $form = new Publications_PublicationsForm;

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

        $publication = new Publications();

        $publication->location = $data['location'];
        $publication->status = 0;
        $publication->sort = 0;
        $publication->name = $data['name'];
        $publication->url  = $data['name'];

        if ( $publication->save() != false )
        {
            $info = new PublicationsInfo();

            $info->publication_id = $publication->id;

            $info->title    = $data['title'];
            $info->content  = $data['content'];
            $info->meta_title       = $data['title'];
            $info->meta_keywords    = $data['metaKeywords'];
            $info->meta_description = $data['metaDescription'];

            if ( $info->save() != false )
            {
                $pLang = new PublicationsLangs();

                $pLang->publication_id = $publication->id;
                $pLang->info_id = $info->id;
                $pLang->lang_id = $data['lang'];

                $pLang->save();

                return $this->response->redirect( 'publications/edit/' . $publication->id . '/' . $data['lang'] );
            }
            else
            {
                echo "Error, can't store page info right now: \n";
                foreach ( $info->getMessages() as $message ) {
                    echo $message, "\n";
                }
            }
        }
        else
        {
            echo "Error, can't store page right now: \n";
            foreach ( $publication->getMessages() as $message ) {
                echo $message, "\n";
            }
        }
    }

    public function saveAction()
    {
        if ($this->request->isPost() != true)
        {
            return $this->response->redirect( 'publications/list/' );
        }

        $form = new Publications_PublicationsForm;

        // Validate the form
        $data = $this->request->getPost();

        if ( !$form->isValid( $this->request->getPost() ) )
        {
            foreach ( $form->getMessages() as $key => $message )
            {
                $this->flash->error( $message );
            }
            return $this->forward( 'publications/create/' );
        }

        $publication = Publications::findFirst( $data['id'] );

        $publication->location = $data['location'];
        $publication->name = $data['name'];

        $langDB = PublicationsLangs::findFirst(array(
            'conditions' => 'page_id = ?1 AND lang_id = ?2',
            'bind'  => array( 1 => $data['id'], 2 => $data['lang'] )
        ));

        $info = PublicationsInfo::findFirst(array(
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

        return $this->response->redirect( 'publications/edit/' . $publication->id . '/' . $data['lang'] );
    }
}