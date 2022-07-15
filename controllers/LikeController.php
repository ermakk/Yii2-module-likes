<?php

namespace ermakk\likes\controllers;

use ermakk\likes\models\Likes;
use phpDocumentor\Reflection\Types\This;
use Yii;
use yii\db\Expression;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * Default controller for the `modues` module
 */
class LikeController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionToggle($id, $class)
    {
        $class = Yii::$app->getSecurity()->decryptByPassword($class, Yii::$app->getModule('votes')->token);
        $likes = (new Likes())::find()->where(['user_id' => \Yii::$app->user->getId(), 'row_id' => $id, 'model' => $class])->one();
        if ($likes == null) {
            $likes = new Likes();
            $likes->model = $class;
            $likes->user_id = Yii::$app->user->getId();
            $likes->row_id = $id;

            if ($likes->save() ) {
                return json_encode([
                    'message' => [
                        'type' => 'success',
                        'content' => [
                            'count' => (new Likes())::find()->where(['row_id' => $id, 'model' => $class])->count(),
                            'toggleState' => true
                        ]
                    ]
                ]);
            } else {
                $textErrore = 'Не удалось поставить лайк. Произошла ошибка, обратитесь к администратору, код ошибки: #4c3f3x0';
                Yii::$app->session->setFlash('error', $textErrore);
                return json_encode([
                    'message' => [
                        'type' => 'error',
                        'content' => $textErrore
                    ]
                ]);
            }
        } else {
            $likes->delete();

            return json_encode([
                'message' => [
                    'type' => 'success',
                    'content' => [
                        'count' => (new Likes())::find()->where(['row_id' => $id, 'model' => $class])->count(),
                        'toggleState' => false
                    ]
                ]
            ]);
        }

    }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionDrop($id, $class)
    {
        return $this->render('index');
    }
}
