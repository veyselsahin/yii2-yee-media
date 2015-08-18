<?php

namespace yeesoft\media\widgets\dashboard;

use yeesoft\media\models\Media as MediaModel;

class Media extends \yii\base\Widget
{
    /**
     * Widget Height
     */
    public $height = 'auto';

    /**
     * Widget Width
     */
    public $width = '4';

    /**
     *
     * @var type
     */
    public $position = 'left';

    /**
     * Most recent post limit
     */
    public $recentLimit = 5;

    /**
     * Post index action
     */
    public $indexAction = 'media/default/index';

    public function run()
    {
        $recent = MediaModel::find()->orderBy(['id' => SORT_DESC])->limit($this->recentLimit)->all();

        return $this->render('media',
            [
                'height' => $this->height,
                'width' => $this->width,
                'position' => $this->position,
                'recent' => $recent,
            ]);
    }
}