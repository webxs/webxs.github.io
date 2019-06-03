<?php
/**
 * Created by PhpStorm.
 * User: Root
 * Date: 03.06.2019
 * Time: 11:00
 */

namespace app\controllers;
use Yii;
use yii\web\Controller;


class PostController extends Controller
{
        public function actionIndex()
        {
            if(Yii::$app->request->isAjax ){

                if(!empty($_POST['EntryForm']['reCaptcha']) and !empty($_POST['g-recaptcha-response'])){

                    $gapi=$this->gApi();

//                    p($gapi);

                    $img="<img src='".$gapi['data']['images']['fixed_height_still']['url']."'>";

                    $ms=['select'=>'entryform-recaptcha-recaptcha-form_c','text'=>$img,'rz'=>true];
                } else {

                    $ms=['select'=>'messag','text'=>'Ошибка','rz'=>false];

                }

                return json_encode($ms);

            }
        }

        public function gApi(){
            $url="https://api.giphy.com/v1/gifs/random?api_key=THPMX09ElXFjtx8B0DmpEOkbSi8necVd&tag=img&rating=G";
            $js=file_get_contents($url);
                return json_decode($js,1);
        }
}