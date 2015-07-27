<?php

class PagesController extends ControllerBase
{
    public function createAction()
    {
        $_page = Pages::find();

        $form = new Pages_CreateForm();

        $this->view->setVar('createForm', $form);

        $this->tag->setTitle('Create Page');

        parent::initialize();
    }
}