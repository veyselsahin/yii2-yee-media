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
            'filename' => Schema::TYPE_STRING . ' NOT NULL',
            'type' => Schema::TYPE_STRING . ' NOT NULL',
            'url' => Schema::TYPE_TEXT . ' NOT NULL',
            'size' => Schema::TYPE_STRING . ' NOT NULL',
            'thumbs' => Schema::TYPE_TEXT,
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER,
            'created_by' => Schema::TYPE_INTEGER . ' DEFAULT NULL',
            'updated_by' => Schema::TYPE_INTEGER . ' DEFAULT NULL',
        ]);


        $this->createTable('media_lang', [
            'id' => 'pk',
            'media_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'language' => Schema::TYPE_STRING . '(6) NOT NULL',
            'title' => Schema::TYPE_STRING . '(255) NOT NULL',
            'alt' => Schema::TYPE_STRING . '(255) NOT NULL',
            'description' => Schema::TYPE_TEXT,
            'KEY `media_lang_id` (`media_id`)',
            'KEY `media_lang_language` (`language`)',
            'CONSTRAINT `fk_media_lang` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE ON UPDATE CASCADE',
        ]);

        $this->createTable('media_category', [
            'id' => 'pk',
            'slug' => Schema::TYPE_STRING . '(255) DEFAULT NULL',
            'visible' => Schema::TYPE_INTEGER . " NOT NULL DEFAULT '1' COMMENT '0-hidden,1-visible'",
            'KEY `media_category_slug` (`slug`)',
            'KEY `media_category_visible` (`visible`)',
        ]);

        $this->createTable('media_category_lang', [
            'id' => 'pk',
            'media_category_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'language' => Schema::TYPE_STRING . '(6) NOT NULL',
            'title' => Schema::TYPE_STRING . '(255) NOT NULL',
            'description' => Schema::TYPE_TEXT,
            'KEY `media_category_lang_id` (`media_category_id`)',
            'KEY `media_category_lang_language` (`language`)',
            'CONSTRAINT `fk_media_category_lang` FOREIGN KEY (`media_category_id`) REFERENCES `media_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE',
        ]);

        $this->createTable('media_album', [
            'id' => 'pk',
            'category_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'slug' => Schema::TYPE_STRING . '(255) DEFAULT NULL',
            'visible' => Schema::TYPE_INTEGER . " NOT NULL DEFAULT '1' COMMENT '0-hidden,1-visible'",
            'KEY `media_album_slug` (`slug`)',
            'KEY `media_album_category_id` (`category_id`)',
            'KEY `media_album_visible` (`visible`)',
        ]);

        $this->createTable('media_album_lang', [
            'id' => 'pk',
            'media_album_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'language' => Schema::TYPE_STRING . '(6) NOT NULL',
            'title' => Schema::TYPE_STRING . '(255) NOT NULL',
            'description' => Schema::TYPE_TEXT,
            'KEY `media_album_lang_id` (`media_album_id`)',
            'KEY `media_album_lang_language` (`language`)',
            'CONSTRAINT `fk_media_album_lang` FOREIGN KEY (`media_album_id`) REFERENCES `media_album` (`id`) ON DELETE CASCADE ON UPDATE CASCADE',
        ]);

        $this->addForeignKey('media_album_category', 'media_album', 'category_id', 'media_category', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('media_lang', 'fk_media_lang');
        $this->dropForeignKey('media_album_lang', 'fk_media_album_lang');
        $this->dropForeignKey('media_category_lang', 'fk_media_category_lang');
        $this->dropForeignKey('media_album_category', 'media_album');
        $this->dropTable('media_album_lang');
        $this->dropTable('media_album');
        $this->dropTable('media_category_lang');
        $this->dropTable('media_category');
        $this->dropTable('media_lang');
        $this->dropTable('media');
    }
}
