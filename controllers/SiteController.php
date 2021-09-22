<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Log;

class SiteController extends Controller
{
    public function actionIndex(): string
    {
        $log = Log::setLog('site/index');
        return $this->render('index');
    }

    public function actionContact(): string
    {
        $log = Log::setLog('site/contact');
        return $this->render('contact');
    }

    public function actionAbout(): string
    {
        $log = Log::setLog('site/about');
        return $this->render('about');
    }

    public function actionService(): string
    {
        $log = Log::setLog('site/service');
        return $this->render('service');
    }

    public function actionPortfolio(): string
    {
        $log = Log::setLog('site/portfolio');
        return $this->render('portfolio');
    }
}
