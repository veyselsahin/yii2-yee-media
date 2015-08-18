<?php

namespace yeesoft\media\controllers;

use yeesoft\controllers\admin\BaseController;

class DefaultController extends BaseController
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSettings()
    {
        return $this->render('settings');
    }
}