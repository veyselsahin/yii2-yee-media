<?php

use yii\db\Migration;

class m160426_122854_create_uploader_images_table extends Migration
{

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('media_upload', [
            'id' => $this->primaryKey(),
            'media_id' => $this->integer()->notNull(),
            'owner_class' => $this->string(255)->notNull(),
            'owner_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('media_upload_owner_class', 'media_upload', ['owner_class']);
        $this->createIndex('media_upload_owner_id', 'media_upload', ['owner_id']);

        $this->addForeignKey('fk_media_upload_media_id', 'media_upload', 'media_id', 'media', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_media_upload_media_id', 'media_upload');
        $this->dropTable('media_upload');
    }

}
