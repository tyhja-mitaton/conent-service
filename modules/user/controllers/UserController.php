<?php

namespace app\modules\user\controllers;

use app\models\user\enums\UserRole;
use app\models\user\User;
use app\models\search\User as UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param string $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->softDelete();

        return $this->redirect(['index']);
    }

    public function actionRestore($id)
    {
        $this->findModel($id)->restore();

        return $this->redirect(['index']);
    }

    public function actionAppointAdmin($id)
    {
        return $this->assignRole($id, UserRole::Administrator);
    }

    public function actionDismissAdmin($id)
    {
        return $this->assignRole($id, UserRole::General);
    }

    private function assignRole($id, UserRole $userRole): bool
    {
        if (Yii::$app->request->isPost && Yii::$app->request->isAjax) {
            $auth = Yii::$app->authManager;
            $exists = $auth->revokeAll($id);
            if($exists) {
                $auth->assign($auth->getRole($userRole->value), $id);
                return true;
            }
            return false;
        }

        return false;
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
