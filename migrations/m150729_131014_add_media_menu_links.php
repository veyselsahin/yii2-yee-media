<?php

use yii\db\Migration;
use yii\db\Schema;

class m150729_131014_add_media_menu_links extends Migration
{

    public function up()
    {
        $this->insert('menu_link', ['id' => 'media', 'menu_id' => 'admin-main-menu', 'image' => 'picture', 'order' => 5]);
        $this->insert('menu_link', ['id' => 'media-media', 'menu_id' => 'admin-main-menu', 'link' => '/media/default/index', 'parent_id' => 'media', 'order' => 1]);
        $this->insert('menu_link', ['id' => 'media-album', 'menu_id' => 'admin-main-menu', 'link' => '/media/album/index', 'parent_id' => 'media', 'order' => 2]);
        $this->insert('menu_link', ['id' => 'media-category', 'menu_id' => 'admin-main-menu', 'link' => '/media/category/index', 'parent_id' => 'media', 'order' => 3]);
        $this->insert('menu_link', ['id' => 'image-settings', 'menu_id' => 'admin-main-menu', 'link' => '/media/default/settings', 'parent_id' => 'settings', 'order' => 5]);

        $this->insert('menu_link_lang', ['link_id' => 'media', 'label' => 'Media', 'language' => 'en' ]);
        $this->insert('menu_link_lang', ['link_id' => 'media-media', 'label' => 'Media', 'language' => 'en' ]);
        $this->insert('menu_link_lang', ['link_id' => 'media-album', 'label' => 'Albums', 'language' => 'en' ]);
        $this->insert('menu_link_lang', ['link_id' => 'media-category', 'label' => 'Categories', 'language' => 'en' ]);
        $this->insert('menu_link_lang', ['link_id' => 'image-settings', 'label' => 'Image Settings', 'language' => 'en' ]);

    }

    public function down()
    {
        $this->delete('menu_link', ['like', 'id', 'image-settings']);
        $this->delete('menu_link', ['like', 'id', 'media-category']);
        $this->delete('menu_link', ['like', 'id', 'media-album']);
        $this->delete('menu_link', ['like', 'id', 'media-media']);
        $this->delete('menu_link', ['like', 'id', 'media']);
    }
}