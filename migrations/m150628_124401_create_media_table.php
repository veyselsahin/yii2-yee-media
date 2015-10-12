<?php

use yii\db\Migration;
use yii\db\Schema;

class m150628_124401_create_media_table extends Migration
{
    public function up()
    {
        $this->createTable('media', [
            'id' => 'pk',
            'album_id' => Schema::TYPE_INTEGER . ' DEFAULT NULL',
            'title' => Schema::TYPE_STRING . '(255) DEFAULT NULL',
            'filename' => Schema::TYPE_STRING . ' NOT NULL',
            'type' => Schema::TYPE_STRING . ' NOT NULL',
            'url' => Schema::TYPE_TEXT . ' NOT NULL',
            'alt' => Schema::TYPE_TEXT,
            'size' => Schema::TYPE_STRING . ' NOT NULL',
            'description' => Schema::TYPE_TEXT,
            'thumbs' => Schema::TYPE_TEXT,
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER,
            'created_by' => Schema::TYPE_INTEGER . ' DEFAULT NULL',
            'updated_by' => Schema::TYPE_INTEGER . ' DEFAULT NULL',
        ]);

        $this->createTable('media_category', [
            'id' => 'pk',
            'category_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'slug' => Schema::TYPE_STRING . '(255) DEFAULT NULL',
            'title' => Schema::TYPE_STRING . '(255) NOT NULL',
            'visible' => Schema::TYPE_INTEGER . " NOT NULL DEFAULT '1' COMMENT '0-hidden,1-visible'",
            'description' => Schema::TYPE_TEXT,
            'KEY `media_category_slug` (`slug`)',
            'KEY `media_category_visible` (`visible`)',
        ]);

        $this->createTable('media_album', [
            'id' => 'pk',
            'category_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'slug' => Schema::TYPE_STRING . '(255) DEFAULT NULL',
            'title' => Schema::TYPE_STRING . '(255) NOT NULL',
            'visible' => Schema::TYPE_INTEGER . " NOT NULL DEFAULT '1' COMMENT '0-hidden,1-visible'",
            'description' => Schema::TYPE_TEXT,
            'KEY `media_album_slug` (`slug`)',
            'KEY `media_album_category_id` (`category_id`)',
            'KEY `media_album_visible` (`visible`)',
        ]);

        $this->addForeignKey('media_album_category', 'media_album', 'category_id', 'media_category', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('media_album_category', 'media_album');
        $this->dropTable('media_album');
        $this->dropTable('media_category');
        $this->dropTable('media');
    }
}
