<?php

class m150628_124401_create_media_table extends yii\db\Migration
{
    const MEDIA_TABLE = '{{%media}}';
    const MEDIA_LANG_TABLE = '{{%media_lang}}';
    const CATEGORY_TABLE = '{{%media_category}}';
    const CATEGORY_LANG_TABLE = '{{%media_category_lang}}';
    const ALBUM_TABLE = '{{%media_album}}';
    const ALBUM_LANG_TABLE = '{{%media_album_lang}}';
    
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(self::CATEGORY_TABLE, [
            'id' => $this->primaryKey(),
            'slug' => $this->string(255)->notNull(),
            'title' => $this->string(255)->notNull(),
            'description' => $this->text(),
            'visible' => $this->integer()->notNull()->defaultValue(1)->comment('0-hidden,1-visible'),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $tableOptions);
        
        $this->createIndex('media_category_visible', self::CATEGORY_TABLE, 'visible');
        $this->createIndex('media_category_slug', self::CATEGORY_TABLE, 'slug', true);
        $this->addForeignKey('fk_media_category_created_by', self::CATEGORY_TABLE, 'created_by', '{{%user}}', 'id', 'SET NULL', 'CASCADE');
        $this->addForeignKey('fk_media_category_updated_by', self::CATEGORY_TABLE, 'updated_by', '{{%user}}', 'id', 'SET NULL', 'CASCADE');
        
        $this->createTable(self::CATEGORY_LANG_TABLE, [
            'id' => $this->primaryKey(),
            'media_category_id' => $this->integer()->notNull(),
            'language' => $this->string(6)->notNull(),
            'title' => $this->string(255)->notNull(),
            'description' => $this->text(),
        ], $tableOptions);
        
        $this->createIndex('media_category_lang_language', self::CATEGORY_LANG_TABLE, 'language');
        $this->addForeignKey('fk_media_category_lang', self::CATEGORY_LANG_TABLE, 'media_category_id', self::CATEGORY_TABLE, 'id', 'CASCADE', 'CASCADE');
        
        $this->createTable(self::ALBUM_TABLE, [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(),
            'title' => $this->string(255)->notNull(),
            'slug' => $this->string(255)->notNull(),
            'description' => $this->text(),
            'visible' => $this->integer()->notNull()->defaultValue(1)->comment('0-hidden,1-visible'),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $tableOptions);
        
        $this->createIndex('media_album_visible', self::ALBUM_TABLE, 'visible');
        $this->createIndex('media_album_slug', self::ALBUM_TABLE, 'slug', true);
        $this->addForeignKey('fk_album_category', self::ALBUM_TABLE, 'category_id', self::CATEGORY_TABLE, 'id', 'SET NULL', 'CASCADE');
        $this->addForeignKey('fk_media_album_created_by', self::ALBUM_TABLE, 'created_by', '{{%user}}', 'id', 'SET NULL', 'CASCADE');
        $this->addForeignKey('fk_media_album_updated_by', self::ALBUM_TABLE, 'updated_by', '{{%user}}', 'id', 'SET NULL', 'CASCADE');

        $this->createTable(self::ALBUM_LANG_TABLE, [
            'id' => $this->primaryKey(),
            'media_album_id' => $this->integer()->notNull(),
            'language' => $this->string(6)->notNull(),
            'title' => $this->string(255)->notNull(),
            'description' => $this->text(),
        ], $tableOptions);
        
        $this->createIndex('media_album_lang_language', self::ALBUM_LANG_TABLE, 'language');
        $this->addForeignKey('fk_media_album_lang', self::ALBUM_LANG_TABLE, 'media_album_id', self::ALBUM_TABLE, 'id', 'CASCADE', 'CASCADE');

        $this->createTable(self::MEDIA_TABLE, [
            'id' => $this->primaryKey(),
            'album_id' => $this->integer(),
            'filename' => $this->string(255)->notNull(),
            'type' => $this->string(127),
            'url' => $this->text(),
            'size' => $this->string(127),
            'thumbs' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $tableOptions);
        
        $this->addForeignKey('fk_media_album', self::MEDIA_TABLE, 'album_id', self::ALBUM_TABLE, 'id', 'SET NULL', 'CASCADE');
        $this->addForeignKey('fk_media_created_by', self::MEDIA_TABLE, 'created_by', '{{%user}}', 'id', 'SET NULL', 'CASCADE');
        $this->addForeignKey('fk_media_updated_by', self::MEDIA_TABLE, 'updated_by', '{{%user}}', 'id', 'SET NULL', 'CASCADE');

        $this->createTable(self::MEDIA_LANG_TABLE, [
            'id' => $this->primaryKey(),
            'media_id' => $this->integer(),
            'language' => $this->string(6)->notNull(),
            'title' => $this->string(255)->notNull(),
            'alt' => $this->string(255),
            'description' => $this->text(),
        ], $tableOptions);
        $this->createIndex('media_lang_language', self::MEDIA_LANG_TABLE, 'language');
        $this->addForeignKey('fk_media_lang', self::MEDIA_LANG_TABLE, 'media_id', self::MEDIA_TABLE, 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_media_created_by', self::MEDIA_TABLE);
        $this->dropForeignKey('fk_media_updated_by', self::MEDIA_TABLE);
        $this->dropForeignKey('fk_media_category_created_by', self::CATEGORY_TABLE);
        $this->dropForeignKey('fk_media_category_updated_by', self::CATEGORY_TABLE);
        $this->dropForeignKey('fk_media_album_created_by', self::ALBUM_TABLE);
        $this->dropForeignKey('fk_media_album_updated_by', self::ALBUM_TABLE);

        $this->dropForeignKey('fk_media_lang', self::MEDIA_LANG_TABLE);
        $this->dropForeignKey('fk_media_album_lang', self::ALBUM_LANG_TABLE);
        $this->dropForeignKey('fk_media_category_lang', self::CATEGORY_LANG_TABLE);

        $this->dropForeignKey('fk_album_category', self::ALBUM_TABLE);

        $this->dropTable(self::MEDIA_LANG_TABLE);
        $this->dropTable(self::MEDIA_TABLE);
        $this->dropTable(self::ALBUM_LANG_TABLE);
        $this->dropTable(self::ALBUM_TABLE);
        $this->dropTable(self::CATEGORY_LANG_TABLE);
        $this->dropTable(self::CATEGORY_TABLE);
    }
}
