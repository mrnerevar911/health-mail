<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use GuzzleHttp\Client;
use yii\console\Controller;
use yii\console\ExitCode;

class ParsingController extends Controller {

    public static $host = "https://health.mail.ru/";

    private $url = "https://health.mail.ru/disease/";

    public function actionIndex() {

        $client = new Client();

        $res = $client->request('GET', $this->url);

        $body = $res->getBody();

        $document = \phpQuery::newDocumentHTML($body);

        $disiease0Wrapper = $document->find("div.catalog__rubric");

        foreach ($disiease0Wrapper as $elem) {

            $pq = pq($elem);
            $disease0 = $pq->find("a.catalog__rubric__title");
            echo "disiase0 is " . $disease0->contents() . "\n";
            $disiase1 = $pq->find("span.catalog__item__title");
            foreach ($disiase1 as $el) {
                $content = pq($el);
                echo "disiase1 is " . $content->contents() . "\n";
            }
            die();

        }

        return ExitCode::OK;
    }
}
