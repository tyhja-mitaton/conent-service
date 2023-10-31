<?php

namespace app\controllers;

use app\models\album\Album;
use yii\data\ArrayDataProvider;
use yii\filters\AccessControl;
use Yii;
use yii\web\NotFoundHttpException;

class AlbumController extends \yii\web\Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['create', 'update', 'videos'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionCreate()
    {
        $model = new Album();
        if($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['site/index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionVideos($id)
    {
        $model = $this->findModel($id);
        $dataProvider = new ArrayDataProvider();
        $params['page'] = $dataProvider->pagination->page + 1;
        $params['per_page'] = $dataProvider->pagination->pageSize;
        $response = Album::requestVimeo("/albums/{$model->showcase_id}/videos", $params);

        if($response['status'] == Album::STATUS_OK) {
            $body = $response['body'];
            $dataProvider->setModels($body['data']);

            return $this->render('videos', [
                'dataProvider' => $dataProvider,
                'albumName' => $model->name,
            ]);
        }
    }

    public function actionVideo($id)
    {
        if(empty($id)) {throw new NotFoundHttpException('The requested page does not exist.');}
        $response = Album::requestVimeo("/videos/$id");
        if($response['status'] == Album::STATUS_OK) {
            $body = $response['body'];

            return $this->render('video', [
                'model' => $body,
            ]);
        }
    }

    protected function findModel($id)
    {
        if (($model = Album::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}