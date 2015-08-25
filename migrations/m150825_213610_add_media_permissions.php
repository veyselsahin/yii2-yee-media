<?php

use yii\db\Migration;
use yii\db\Schema;

class m150825_213610_add_media_permissions extends Migration
{

    public function up()
    {

        $this->insert('auth_item_group', ['code' => 'mediaManagement', 'name' => 'Media Management', 'created_at' => '1440180000', 'updated_at' => '1440180000']);

        $this->insert('auth_item', ['name' => '/admin/#mediafile', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/media/*', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/media/default/*', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/media/default/index', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/media/default/settings', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/media/manage/delete', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/media/manage/index', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/media/manage/info', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/media/manage/resize', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/media/manage/update', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/media/manage/upload', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/media/manage/uploader', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);

        $this->insert('auth_item', ['name' => 'deleteMedia', 'type' => '2', 'description' => 'Delete media', 'group_code' => 'mediaManagement', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => 'editMedia', 'type' => '2', 'description' => 'Edit media', 'group_code' => 'mediaManagement', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => 'editMediaSettings', 'type' => '2', 'description' => 'Edit media settings', 'group_code' => 'mediaManagement', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => 'uploadMedia', 'type' => '2', 'description' => 'Upload media', 'group_code' => 'mediaManagement', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => 'viewMedia', 'type' => '2', 'description' => 'View media', 'group_code' => 'mediaManagement', 'created_at' => '1440180000', 'updated_at' => '1440180000']);

        $this->insert('auth_item_child', ['parent' => 'viewMedia', 'child' => '/admin/#mediafile']);
        $this->insert('auth_item_child', ['parent' => 'viewMedia', 'child' => '/admin/media/default/index']);
        $this->insert('auth_item_child', ['parent' => 'editMediaSettings', 'child' => '/admin/media/default/settings']);
        $this->insert('auth_item_child', ['parent' => 'deleteMedia', 'child' => '/admin/media/manage/delete']);
        $this->insert('auth_item_child', ['parent' => 'viewMedia', 'child' => '/admin/media/manage/index']);
        $this->insert('auth_item_child', ['parent' => 'viewMedia', 'child' => '/admin/media/manage/info']);
        $this->insert('auth_item_child', ['parent' => 'editMediaSettings', 'child' => '/admin/media/manage/resize']);
        $this->insert('auth_item_child', ['parent' => 'editMedia', 'child' => '/admin/media/manage/update']);
        $this->insert('auth_item_child', ['parent' => 'uploadMedia', 'child' => '/admin/media/manage/upload']);
        $this->insert('auth_item_child', ['parent' => 'uploadMedia', 'child' => '/admin/media/manage/uploader']);

        $this->insert('auth_item_child', ['parent' => 'uploadMedia', 'child' => 'editMedia']);
        $this->insert('auth_item_child', ['parent' => 'deleteMedia', 'child' => 'viewMedia']);
        $this->insert('auth_item_child', ['parent' => 'editMedia', 'child' => 'viewMedia']);
        $this->insert('auth_item_child', ['parent' => 'editMediaSettings', 'child' => 'viewMedia']);
        $this->insert('auth_item_child', ['parent' => 'uploadMedia', 'child' => 'viewMedia']);

        $this->insert('auth_item_child', ['parent' => 'author', 'child' => 'uploadMedia']);
        $this->insert('auth_item_child', ['parent' => 'author', 'child' => 'viewMedia']);
        $this->insert('auth_item_child', ['parent' => 'administrator', 'child' => 'deleteMedia']);
        $this->insert('auth_item_child', ['parent' => 'administrator', 'child' => 'deleteMenuLinks']);
    }

    public function down()
    {
        $this->delete('auth_item_child', ['parent' => 'author', 'child' => 'uploadMedia']);
        $this->delete('auth_item_child', ['parent' => 'author', 'child' => 'viewMedia']);
        $this->delete('auth_item_child', ['parent' => 'administrator', 'child' => 'deleteMedia']);
        $this->delete('auth_item_child', ['parent' => 'administrator', 'child' => 'deleteMenuLinks']);

        $this->delete('auth_item_child', ['parent' => 'uploadMedia', 'child' => 'editMedia']);
        $this->delete('auth_item_child', ['parent' => 'deleteMedia', 'child' => 'viewMedia']);
        $this->delete('auth_item_child', ['parent' => 'editMedia', 'child' => 'viewMedia']);
        $this->delete('auth_item_child', ['parent' => 'editMediaSettings', 'child' => 'viewMedia']);
        $this->delete('auth_item_child', ['parent' => 'uploadMedia', 'child' => 'viewMedia']);

        $this->delete('auth_item_child', ['parent' => 'viewMedia', 'child' => '/admin/#mediafile']);
        $this->delete('auth_item_child', ['parent' => 'viewMedia', 'child' => '/admin/media/default/index']);
        $this->delete('auth_item_child', ['parent' => 'editMediaSettings', 'child' => '/admin/media/default/settings']);
        $this->delete('auth_item_child', ['parent' => 'deleteMedia', 'child' => '/admin/media/manage/delete']);
        $this->delete('auth_item_child', ['parent' => 'viewMedia', 'child' => '/admin/media/manage/index']);
        $this->delete('auth_item_child', ['parent' => 'viewMedia', 'child' => '/admin/media/manage/info']);
        $this->delete('auth_item_child', ['parent' => 'editMediaSettings', 'child' => '/admin/media/manage/resize']);
        $this->delete('auth_item_child', ['parent' => 'editMedia', 'child' => '/admin/media/manage/update']);
        $this->delete('auth_item_child', ['parent' => 'uploadMedia', 'child' => '/admin/media/manage/upload']);
        $this->delete('auth_item_child', ['parent' => 'uploadMedia', 'child' => '/admin/media/manage/uploader']);

        $this->delete('auth_item', ['name' => '/admin/#mediafile']);
        $this->delete('auth_item', ['name' => '/admin/media/*']);
        $this->delete('auth_item', ['name' => '/admin/media/default/*']);
        $this->delete('auth_item', ['name' => '/admin/media/default/index']);
        $this->delete('auth_item', ['name' => '/admin/media/default/settings']);
        $this->delete('auth_item', ['name' => '/admin/media/manage/delete']);
        $this->delete('auth_item', ['name' => '/admin/media/manage/index']);
        $this->delete('auth_item', ['name' => '/admin/media/manage/info']);
        $this->delete('auth_item', ['name' => '/admin/media/manage/resize']);
        $this->delete('auth_item', ['name' => '/admin/media/manage/update']);
        $this->delete('auth_item', ['name' => '/admin/media/manage/upload']);
        $this->delete('auth_item', ['name' => '/admin/media/manage/uploader']);

        $this->delete('auth_item', ['name' => 'deleteMedia']);
        $this->delete('auth_item', ['name' => 'editMedia']);
        $this->delete('auth_item', ['name' => 'editMediaSettings']);
        $this->delete('auth_item', ['name' => 'uploadMedia']);
        $this->delete('auth_item', ['name' => 'viewMedia']);

        $this->delete('auth_item_group', ['code' => 'mediaManagement']);
    }
}