<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class Log extends Model
{
    public string $url;

    /**
     * @return array the validation rules.
     */
    public function rules(): array
    {
        return [
            [['url'], 'required'],
            [['url'], 'string'],
        ];
    }

    public static function setLog($url){
        $model = new self();
        $model->url = $url;
        if ($model->validate()) {
            $message = json_encode([
                "jsonrpc" => "2.0",
                "id" => 1,
                "method" => "set",
                "params" => [
                    "url" => $url
                ]
            ]);

            $ch = curl_init('http://'.$_ENV['ACTIVITY_CONTAINER_NAME'].'/log');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $message);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
              'Content-type: application/json'
            ]);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POST, true);

            try{
                $res = curl_exec($ch);
                curl_close($ch);
                if ($res !== false) {
                    return $res;
                }
            }catch(\Exception $e){
                debug($e);
            }
            return false;
        } else {
            return $model->getErrors();
        }
    }

    public static function getLogs($params = []){
        $message = json_encode([
          "jsonrpc" => "2.0",
          "id" => 1,
          "method" => "list",
          "params" => $params
        ]);

        $ch = curl_init('http://'.$_ENV['ACTIVITY_CONTAINER_NAME'].'/log');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $message);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
          'Content-type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POST, true);

        try{
            $res = curl_exec($ch);
            curl_close($ch);
            if ($res !== false) {
                return $res;
            }
        }catch(\Exception $e){
            debug($e);
        }
        return [];
    }
}
