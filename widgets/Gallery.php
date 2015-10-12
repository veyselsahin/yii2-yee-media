<?php

namespace yeesoft\media\widgets;

use yeesoft\helpers\YeeHelper;
use Yii;
use yii\grid\GridViewAsset;
use yii\helpers\StringHelper;

class Gallery extends \yii\base\Widget
{
    /**
     * @var ActiveRecord
     */
    public $modelClass = 'yeesoft\media\models\Media';

    /**
     * @var ActiveRecord
     */
    public $modelSearchClass = 'yeesoft\media\models\MediaSearch';
    public $pageSize = 15;
    public $mode = 'normal';

    public function run()
    {
        $view = $this->getView();
        $modelClass = $this->modelClass;
        $searchModel = $this->modelSearchClass ? new $this->modelSearchClass : null;

        //Init AJAX filter submit
        GridViewAsset::register($view);
        $options = '{"filterUrl":"' . \yii\helpers\Url::to(['default/index']) . '","filterSelector":"#gallery-grid-filters input, #gallery-grid-filters select"}';
        $view->registerJs("jQuery('#gallery').yiiGridView($options);");


        $restrictAccess = (YeeHelper::isImplemented($modelClass, OwnerAccess::class)
            && !User::hasPermission($modelClass::getOwnerAccessPermission()));

        $searchName = StringHelper::basename($searchModel::className());
        $params = Yii::$app->request->getQueryParams();

        if ($restrictAccess) {
            $params[$searchName][$modelClass::getOwnerField()] = Yii::$app->user->identity->id;
        }

        $dataProvider = $searchModel->search($params);
        $dataProvider->pagination->defaultPageSize = $this->pageSize;

        return $this->render('gallery', [
                'searchModel' => $searchModel,
                'mode' => $this->mode,
                'dataProvider' => $dataProvider,
            ]
        );
    }
}