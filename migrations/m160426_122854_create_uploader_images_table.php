<?php

class m160426_122854_create_uploader_images_table extends yii\db\Migration
{

    const TABLE_NAME = '{{%media_upload}}';
    
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'media_id' => $this->integer()->notNull(),
            'owner_class' => $this->string(255)->notNull(),
            'owner_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('media_upload_owner_class', self::TABLE_NAME, ['owner_class']);
        $this->createIndex('media_upload_owner_id', self::TABLE_NAME, ['owner_id']);
        $this->addForeignKey('fk_media_upload_media_id', self::TABLE_NAME, 'media_id', '{{%media}}', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_media_upload_media_id', self::TABLE_NAME);
        $this->dropTable(self::TABLE_NAME);
    }

}
