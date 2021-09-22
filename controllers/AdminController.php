<?php

namespace app\controllers;

use app\models\Log;
use yii\rest\ActiveController;

class AdminController extends ActiveController
{
    public $modelClass = 'app\modules\Log';

    public function actionActivity(int $page = 1): array
    {
        $log = Log::getLogs([
            "limit" => 2,
		        "page" => $page
        ]);
        $data = parseJson($log);
        return [
            "success" => !empty($data),
            "data" => $data['result'] ?? []
        ];
    }
}
