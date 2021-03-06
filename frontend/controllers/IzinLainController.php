<?php

namespace frontend\controllers;

use Yii;
use frontend\models\TVendorCompany;
use frontend\models\TVendorLegalIjinlain;
use frontend\models\TVendorLegalIjinlainSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * IzinLainController implements the CRUD actions for TVendorLegalIjinlain model.
 */
class IzinLainController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['frontend'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TVendorLegalIjinlain models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TVendorLegalIjinlainSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TVendorLegalIjinlain model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TVendorLegalIjinlain model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TVendorLegalIjinlain();
        $user = Yii::$app->user->identity->id;
        $vendor = TVendorCompany::find()->where(['=','user_id', $user])->one();
        //Set the path that the file will be uploaded to
        $path = Yii::getAlias('@frontend') .'/web/uploads/';

        if ($model->load(Yii::$app->request->post())) {
            $model->t_vendor_company_id = $vendor->t_vendor_company_id;
            $model->penerbit = $_POST['TVendorLegalIjinlain']['penerbit'];
            $model->nomor = $_POST['TVendorLegalIjinlain']['nomor'];
            $model->jenis = $_POST['TVendorLegalIjinlain']['jenis'];
            $model->tanggal = $_POST['TVendorLegalIjinlain']['tanggal'];
            $model->kadaluarsa = $_POST['TVendorLegalIjinlain']['kadaluarsa'];
            $model->uploadFile = UploadedFile::getInstance($model, 'uploadFile');
            $model->lampiran = preg_replace('/[^A-Za-z0-9\-]/', '_', Yii::$app->user->identity->id.'_ijin_lain_'.date('d m y h:i:s')) . '.' . $model->uploadFile->extension;
            $model->create_user = Yii::$app->user->identity->id;
            $model->update_user = Yii::$app->user->identity->id;
            $model->save();
            $model->uploadFile->saveAs($path . preg_replace('/[^A-Za-z0-9\-]/', '_',  Yii::$app->user->identity->id.'_ijin_lain_'.date('d m y h:i:s')) . '.' . $model->uploadFile->extension);

            return $this->redirect(['view', 'id' => $model->t_vendor_legal_ijinlain_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TVendorLegalIjinlain model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $user = Yii::$app->user->identity->id;
        $vendor = TVendorCompany::find()->where(['=','user_id', $user])->one();
        //Set the path that the file will be uploaded to
        $path = Yii::getAlias('@frontend') .'/web/uploads/';

        if ($model->load(Yii::$app->request->post())) {
            $model->t_vendor_company_id = $vendor->t_vendor_company_id;
            $model->penerbit = $_POST['TVendorLegalIjinlain']['penerbit'];
            $model->nomor = $_POST['TVendorLegalIjinlain']['nomor'];
            $model->jenis = $_POST['TVendorLegalIjinlain']['jenis'];
            $model->tanggal = $_POST['TVendorLegalIjinlain']['tanggal'];
            $model->kadaluarsa = $_POST['TVendorLegalIjinlain']['kadaluarsa'];
            $model->uploadFile = UploadedFile::getInstance($model, 'uploadFile');
            $model->lampiran = preg_replace('/[^A-Za-z0-9\-]/', '_', Yii::$app->user->identity->id.'_ijin_lain_'.date('d m y h:i:s')) . '.' . $model->uploadFile->extension;
            $model->update_user = Yii::$app->user->identity->id;
            $model->update_date = date("Y-m-d H:i:s");
            $model->update();
            $model->uploadFile->saveAs($path . preg_replace('/[^A-Za-z0-9\-]/', '_',  Yii::$app->user->identity->id.'_ijin_lain_'.date('d m y h:i:s')) . '.' . $model->uploadFile->extension);

            return $this->redirect(['view', 'id' => $model->t_vendor_legal_ijinlain_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TVendorLegalIjinlain model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TVendorLegalIjinlain model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TVendorLegalIjinlain the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TVendorLegalIjinlain::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
