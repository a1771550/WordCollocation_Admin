<?php

namespace api\controllers;

use api\models\Collocation;
use api\models\Word;
use Yii;
use yii\helpers\Json;

class WordController extends BaseController {

    public function actionGetCollocatedWords() {
        $callback = Yii::$app->request->get('callback', null);
        $jsonlist = [];
        $sql = "Select distinct w.Id, w.Entry, w.EntryZht, w.EntryZhs, w.EntryJap from word w
inner join collocation c on w.Id = c.wordId where w.CanDel=0";
        $conn = Yii::$app->getDb();
        $command = $conn->createCommand($sql);
        $words = $command->queryAll();
        if (empty($words)) {
            $this->setHeader(200);
            echo '';
        } else {
            foreach ($words as $word) {
                array_push($jsonlist, array('Id' => $word['Id'], 'Entry' => $word['Entry'],
                    'EntryZht' => $word['EntryZht'], 'EntryZhs' => $word['EntryZhs'], 'EntryJap' => $word['EntryJap']));
            }
            $this->setHeader(200);
            echo $callback != null ? "$callback(" . Json::htmlEncode($jsonlist) . ")" : Json::htmlEncode($jsonlist);
        }
    }

}
