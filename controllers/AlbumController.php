<?php

namespace app\controllers;

use app\models\album\Album;
use Vimeo\Exceptions\VimeoRequestException;
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
                        'actions' => ['videos', 'video'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }

    public function actionVideos($id)
    {
        $model = $this->findModel($id);
        $dataProvider = new ArrayDataProvider();
        $params['page'] = $dataProvider->pagination->page + 1;
        $params['per_page'] = $dataProvider->pagination->pageSize;
        try {
            $response = Album::requestVimeo("/albums/{$model->showcase_id}/videos", $params);
        } catch (VimeoRequestException $exception) {
            Yii::$app->session->setFlash('alert', [
                'title' => Yii::t('app', 'Error'),
                'body' => $exception->getMessage()
            ]);
        }

        if($response['status'] == Album::STATUS_OK) {
            $body = $response['body'];
            $dataProvider->setModels($body['data']);

            return $this->render('videos', [
                'dataProvider' => $dataProvider,
                'album' => $model,
            ]);
        }
    }

    public function actionVideo($id, $albumId)
    {
        $album = $this->findModel($albumId);
        if($album->for_registered_users && Yii::$app->user->isGuest) {
            $this->redirect(['/site/login']);
        }
        try {
            $response = Album::requestVimeo("/videos/$id");
        } catch (VimeoRequestException $exception) {
            Yii::$app->session->setFlash('alert', [
                'title' => Yii::t('app', 'Error'),
                'body' => $exception->getMessage()
            ]);
        }
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