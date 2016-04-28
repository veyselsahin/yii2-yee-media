<?php

use yii\db\Migration;
use yii\db\Schema;

class m150628_124401_create_media_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('media_category', [
            'id' => 'pk',
            'slug' => Schema::TYPE_STRING . '(255) DEFAULT NULL',
            'title' => Schema::TYPE_STRING . '(255) NOT NULL',
            'description' => Schema::TYPE_TEXT,
            'visible' => Schema::TYPE_INTEGER . " NOT NULL DEFAULT '1' COMMENT '0-hidden,1-visible'",
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' DEFAULT NULL',
            'created_by' => Schema::TYPE_INTEGER . ' DEFAULT NULL',
            'updated_by' => Schema::TYPE_INTEGER . ' DEFAULT NULL',
            'KEY `media_category_slug` (`slug`)',
            'KEY `media_category_visible` (`visible`)',
            'CONSTRAINT `fk_media_category_created_by` FOREIGN KEY (created_by) REFERENCES user (id) ON DELETE SET NULL ON UPDATE CASCADE',
            'CONSTRAINT `fk_media_category_updated_by` FOREIGN KEY (updated_by) REFERENCES user (id) ON DELETE SET NULL ON UPDATE CASCADE',
        ], $tableOptions);

        $this->createTable('media_category_lang', [
            'id' => 'pk',
            'media_category_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'language' => Schema::TYPE_STRING . '(6) NOT NULL',
            'title' => Schema::TYPE_STRING . '(255) NOT NULL',
            'description' => Schema::TYPE_TEXT,
            'KEY `media_category_lang_id` (`media_category_id`)',
            'KEY `media_category_lang_language` (`language`)',
            'CONSTRAINT `fk_media_category_lang` FOREIGN KEY (`media_category_id`) REFERENCES `media_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);

        $this->createTable('media_album', [
            'id' => 'pk',
            'category_id' => Schema::TYPE_INTEGER . '(11) DEFAULT NULL',
            'title' => Schema::TYPE_STRING . '(255) NOT NULL',
            'slug' => Schema::TYPE_STRING . '(255) DEFAULT NULL',
            'description' => Schema::TYPE_TEXT,
            'visible' => Schema::TYPE_INTEGER . " NOT NULL DEFAULT '1' COMMENT '0-hidden,1-visible'",
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' DEFAULT NULL',
            'created_by' => Schema::TYPE_INTEGER . ' DEFAULT NULL',
            'updated_by' => Schema::TYPE_INTEGER . ' DEFAULT NULL',
            'KEY `media_album_slug` (`slug`)',
            'KEY `media_album_category_id` (`category_id`)',
            'KEY `media_album_visible` (`visible`)',
            'CONSTRAINT `fk_album_category` FOREIGN KEY (`category_id`) REFERENCES `media_category` (`id`) ON DELETE SET NULL ON UPDATE CASCADE',
            'CONSTRAINT `fk_media_album_created_by` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE',
            'CONSTRAINT `fk_media_album_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE',
        ], $tableOptions);

        $this->createTable('media_album_lang', [
            'id' => 'pk',
            'media_album_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'language' => Schema::TYPE_STRING . '(6) NOT NULL',
            'title' => Schema::TYPE_STRING . '(255) NOT NULL',
            'description' => Schema::TYPE_TEXT,
            'KEY `media_album_lang_id` (`media_album_id`)',
            'KEY `media_album_lang_language` (`language`)',
            'CONSTRAINT `fk_media_album_lang` FOREIGN KEY (`media_album_id`) REFERENCES `media_album` (`id`) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);

        $this->createTable('media', [
            'id' => 'pk',
            'album_id' => Schema::TYPE_INTEGER . ' DEFAULT NULL',
            'filename' => Schema::TYPE_STRING . ' NOT NULL',
            'type' => Schema::TYPE_STRING . ' NOT NULL',
            'url' => Schema::TYPE_TEXT . ' NOT NULL',
            'size' => Schema::TYPE_STRING . ' NOT NULL',
            'thumbs' => Schema::TYPE_TEXT,
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' DEFAULT NULL',
            'created_by' => Schema::TYPE_INTEGER . '(11) DEFAULT NULL',
            'updated_by' => Schema::TYPE_INTEGER . '(11) DEFAULT NULL',
            'KEY `media_album_id` (`album_id`)',
            'CONSTRAINT `fk_media_album` FOREIGN KEY (album_id) REFERENCES media_album (id) ON DELETE SET NULL ON UPDATE CASCADE',
            'CONSTRAINT `fk_media_created_by` FOREIGN KEY (created_by) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE',
            'CONSTRAINT `fk_media_updated_by` FOREIGN KEY (updated_by) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE',
        ], $tableOptions);

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
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropForeignKey('fk_media_created_by', 'media');
        $this->dropForeignKey('fk_media_updated_by', 'media');
        $this->dropForeignKey('fk_media_category_created_by', 'media_category');
        $this->dropForeignKey('fk_media_category_updated_by', 'media_category');
        $this->dropForeignKey('fk_media_album_created_by', 'media_album');
        $this->dropForeignKey('fk_media_album_updated_by', 'media_album');

        $this->dropForeignKey('fk_media_lang', 'media_lang');
        $this->dropForeignKey('fk_media_album_lang', 'media_album_lang');
        $this->dropForeignKey('fk_media_category_lang', 'media_category_lang');

        $this->dropForeignKey('fk_album_category', 'media_album');

        $this->dropTable('media_lang');
        $this->dropTable('media');
        $this->dropTable('media_album_lang');
        $this->dropTable('media_album');
        $this->dropTable('media_category_lang');
        $this->dropTable('media_category');
    }
}
