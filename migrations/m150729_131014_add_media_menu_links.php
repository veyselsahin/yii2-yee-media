<?php

use yii\db\Migration;
use yii\db\Schema;

class m150729_131014_add_media_menu_links extends Migration
{

    public function up()
    {
        $this->insert('menu_link',
            ['id' => 'media', 'menu_id' => 'admin-main-menu', 'label' => 'Media',
                'image' => 'picture', 'order' => 5]);

        $this->insert('menu_link',
            ['id' => 'media-media', 'menu_id' => 'admin-main-menu', 'link' => '/media/default/index',
                'label' => 'Media', 'parent_id' => 'media', 'order' => 1]);

        $this->insert('menu_link',
            ['id' => 'media-album', 'menu_id' => 'admin-main-menu', 'link' => '/menu/album/index',
                'label' => 'Albums', 'parent_id' => 'media', 'order' => 2]);

        $this->insert('menu_link', ['id' => 'image-settings', 'menu_id' => 'admin-main-menu', 'link' => '/media/default/settings', 'label' => 'Image Settings', 'parent_id' => 'settings', 'order' => 5]);
    }

    public function down()
    {
        $this->delete('menu_link', ['like', 'id', 'image-settings']);
        $this->delete('menu_link', ['like', 'id', 'media-album']);
        $this->delete('menu_link', ['like', 'id', 'media-media']);
        $this->delete('menu_link', ['like', 'id', 'media']);
    }
}