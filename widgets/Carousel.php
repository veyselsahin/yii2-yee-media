<?php

namespace yeesoft\media\widgets;

use yeesoft\media\models\Album;

/**
 * Widget to render Bootstrap Carousel with images from media album.
 *
 * Basic usage:
 * ~~~
 * use yeesoft\media\widgets\Carousel;
 *
 * echo Carousel::widget(['album' => 'carousel'])
 *
 * //with custom views
 * echo Carousel::widget([
 *     'album' => 'carousel',
 *     'contentView' => '@frontend/views/carousel/content',
 *     'captionView' => '@frontend/views/carousel/caption',
 *     'itemsOptions' => ['class' => 'some-class']
 * ]);
 * ~~~
 */
class Carousel extends \yii\bootstrap\Carousel
{
    /**
     * Media album id or slug to display in Carousel
     *
     * @var string
     */
    public $album;

    /**
     * View file to render carousel content
     *
     * @var string
     */
    public $contentView = 'carousel-content';

    /**
     * View file to render carousel caption
     *
     * @var string
     */
    public $captionView = 'carousel-caption';

    /**
     * Options that will be applied to items
     *
     * @var array
     */
    public $itemsOptions = [];

    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();

        if (ctype_digit($this->album)) {
            $condition = $this->album;
        } elseif (is_string($this->album)) {
            $condition = ['slug' => $this->album];
        } else {
            throw new \yii\base\InvalidParamException('Invalid album parameter passed to a method.');
        }

        $album = Album::findOne($condition);

        if (!$album) {
            throw new \yii\web\NotFoundHttpException('Album was not found.');
        }

        $media = $album->getMedia()->all();

        foreach ($media as $image) {
            $this->items[] = [
                'content' => $this->render($this->contentView, ['image' => $image]),
                'caption' => $this->render($this->captionView, ['image' => $image]),
                'options' => $this->itemsOptions,
            ];
        }
    }
}