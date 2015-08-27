<?php

class AdminController extends ControllerAdmin
{
    public function adminAction()
    {
        $this->tag->setTitle('Admin Page');

        parent::initialize();
    }
}