<?php

namespace yeesoft\media\widgets\uploader;

use yii\helpers\Html;
use yii\widgets\InputWidget;

class UploaderInput extends InputWidget
{

    public $items = [];
    public $inline = false;

    /**
     * Runs the widget.
     */
    public function run()
    {
        if (!$this->hasModel()) {
            throw new \yii\base\InvalidConfigException();
        }

        $value = Html::getAttributeValue($this->model, $this->attribute);
        $name = Html::getInputName($this->model, $this->attribute);

        $content = Html::beginTag('div', $this->options);
        foreach ($value as $media_id) {
            $content .= Html::hiddenInput($name . '[]', $media_id);
        }
        $content .= Html::endTag('div');

        return $content;
    }

}
