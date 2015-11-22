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

        $this->insert('auth_item', ['name' => '/admin/media/album/*', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/media/album/bulk-delete', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/media/album/create', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/media/album/delete', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/media/album/grid-page-size', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/media/album/grid-sort', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/media/album/index', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/media/album/toggle-attribute', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/media/album/update', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);

        $this->insert('auth_item', ['name' => '/admin/media/category/*', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/media/category/bulk-delete', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/media/category/create', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/media/category/delete', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/media/category/grid-page-size', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/media/category/grid-sort', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/media/category/index', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/media/category/toggle-attribute', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/media/category/update', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);


        $this->insert('auth_item', ['name' => 'deleteMedia', 'type' => '2', 'description' => 'Delete media', 'group_code' => 'mediaManagement', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => 'editMedia', 'type' => '2', 'description' => 'Edit media', 'group_code' => 'mediaManagement', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => 'editMediaSettings', 'type' => '2', 'description' => 'Edit media settings', 'group_code' => 'mediaManagement', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => 'uploadMedia', 'type' => '2', 'description' => 'Upload media', 'group_code' => 'mediaManagement', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => 'viewMedia', 'type' => '2', 'description' => 'View media', 'group_code' => 'mediaManagement', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => 'fullMediaAccess', 'type' => '2', 'description' => 'Manage other users\' media', 'group_code' => 'mediaManagement', 'created_at' => '1440180000', 'updated_at' => '1440180000']);

        $this->insert('auth_item', ['name' => 'viewMediaAlbums', 'type' => '2', 'description' => 'View media albums', 'group_code' => 'mediaManagement', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => 'editMediaAlbums', 'type' => '2', 'description' => 'Edit media albums', 'group_code' => 'mediaManagement', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => 'deleteMediaAlbums', 'type' => '2', 'description' => 'Delete media albums', 'group_code' => 'mediaManagement', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => 'createMediaAlbums', 'type' => '2', 'description' => 'Create media albums', 'group_code' => 'mediaManagement', 'created_at' => '1440180000', 'updated_at' => '1440180000']);

        $this->insert('auth_item', ['name' => 'viewMediaCategories', 'type' => '2', 'description' => 'View media categories', 'group_code' => 'mediaManagement', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => 'editMediaCategories', 'type' => '2', 'description' => 'Edit media categories', 'group_code' => 'mediaManagement', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => 'deleteMediaCategories', 'type' => '2', 'description' => 'Delete media categories', 'group_code' => 'mediaManagement', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => 'createMediaCategories', 'type' => '2', 'description' => 'Create media categories', 'group_code' => 'mediaManagement', 'created_at' => '1440180000', 'updated_at' => '1440180000']);


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

        $this->insert('auth_item_child', ['parent' => 'deleteMediaAlbums', 'child' => '/admin/media/album/bulk-delete']);
        $this->insert('auth_item_child', ['parent' => 'createMediaAlbums', 'child' => '/admin/media/album/create']);
        $this->insert('auth_item_child', ['parent' => 'deleteMediaAlbums', 'child' => '/admin/media/album/delete']);
        $this->insert('auth_item_child', ['parent' => 'viewMediaAlbums', 'child' => '/admin/media/album/grid-page-size']);
        $this->insert('auth_item_child', ['parent' => 'viewMediaAlbums', 'child' => '/admin/media/album/grid-sort']);
        $this->insert('auth_item_child', ['parent' => 'viewMediaAlbums', 'child' => '/admin/media/album/index']);
        $this->insert('auth_item_child', ['parent' => 'editMediaAlbums', 'child' => '/admin/media/album/toggle-attribute']);
        $this->insert('auth_item_child', ['parent' => 'editMediaAlbums', 'child' => '/admin/media/album/update']);

        $this->insert('auth_item_child', ['parent' => 'deleteMediaCategories', 'child' => '/admin/media/category/bulk-delete']);
        $this->insert('auth_item_child', ['parent' => 'createMediaCategories', 'child' => '/admin/media/category/create']);
        $this->insert('auth_item_child', ['parent' => 'deleteMediaCategories', 'child' => '/admin/media/category/delete']);
        $this->insert('auth_item_child', ['parent' => 'viewMediaCategories', 'child' => '/admin/media/category/grid-page-size']);
        $this->insert('auth_item_child', ['parent' => 'viewMediaCategories', 'child' => '/admin/media/category/grid-sort']);
        $this->insert('auth_item_child', ['parent' => 'viewMediaCategories', 'child' => '/admin/media/category/index']);
        $this->insert('auth_item_child', ['parent' => 'editMediaCategories', 'child' => '/admin/media/category/toggle-attribute']);
        $this->insert('auth_item_child', ['parent' => 'editMediaCategories', 'child' => '/admin/media/category/update']);


        $this->insert('auth_item_child', ['parent' => 'uploadMedia', 'child' => 'editMedia']);
        $this->insert('auth_item_child', ['parent' => 'deleteMedia', 'child' => 'viewMedia']);
        $this->insert('auth_item_child', ['parent' => 'editMedia', 'child' => 'viewMedia']);
        $this->insert('auth_item_child', ['parent' => 'editMediaSettings', 'child' => 'viewMedia']);
        $this->insert('auth_item_child', ['parent' => 'uploadMedia', 'child' => 'viewMedia']);

        $this->insert('auth_item_child', ['parent' => 'createMediaAlbums', 'child' => 'viewMediaAlbums']);
        $this->insert('auth_item_child', ['parent' => 'deleteMediaAlbums', 'child' => 'viewMediaAlbums']);
        $this->insert('auth_item_child', ['parent' => 'editMediaAlbums', 'child' => 'viewMediaAlbums']);

        $this->insert('auth_item_child', ['parent' => 'createMediaCategories', 'child' => 'viewMediaCategories']);
        $this->insert('auth_item_child', ['parent' => 'deleteMediaCategories', 'child' => 'viewMediaCategories']);
        $this->insert('auth_item_child', ['parent' => 'editMediaCategories', 'child' => 'viewMediaCategories']);


        $this->insert('auth_item_child', ['parent' => 'author', 'child' => 'uploadMedia']);
        $this->insert('auth_item_child', ['parent' => 'author', 'child' => 'viewMedia']);
        $this->insert('auth_item_child', ['parent' => 'administrator', 'child' => 'deleteMedia']);
        $this->insert('auth_item_child', ['parent' => 'administrator', 'child' => 'deleteMenuLinks']);
        $this->insert('auth_item_child', ['parent' => 'moderator', 'child' => 'fullMediaAccess']);

        $this->insert('auth_item_child', ['parent' => 'author', 'child' => 'viewMediaAlbums']);
        $this->insert('auth_item_child', ['parent' => 'moderator', 'child' => 'createMediaAlbums']);
        $this->insert('auth_item_child', ['parent' => 'moderator', 'child' => 'editMediaAlbums']);
        $this->insert('auth_item_child', ['parent' => 'administrator', 'child' => 'deleteMediaAlbums']);

        $this->insert('auth_item_child', ['parent' => 'author', 'child' => 'viewMediaCategories']);
        $this->insert('auth_item_child', ['parent' => 'moderator', 'child' => 'createMediaCategories']);
        $this->insert('auth_item_child', ['parent' => 'moderator', 'child' => 'editMediaCategories']);
        $this->insert('auth_item_child', ['parent' => 'administrator', 'child' => 'deleteMediaCategories']);

    }

    public function down()
    {
        $this->delete('auth_item_child', ['parent' => 'author', 'child' => 'uploadMedia']);
        $this->delete('auth_item_child', ['parent' => 'author', 'child' => 'viewMedia']);
        $this->delete('auth_item_child', ['parent' => 'administrator', 'child' => 'deleteMedia']);
        $this->delete('auth_item_child', ['parent' => 'administrator', 'child' => 'deleteMenuLinks']);
        $this->delete('auth_item_child', ['parent' => 'moderator', 'child' => 'fullMediaAccess']);

        $this->delete('auth_item_child', ['parent' => 'author', 'child' => 'viewMediaAlbums']);
        $this->delete('auth_item_child', ['parent' => 'moderator', 'child' => 'createMediaAlbums']);
        $this->delete('auth_item_child', ['parent' => 'moderator', 'child' => 'editMediaAlbums']);
        $this->delete('auth_item_child', ['parent' => 'administrator', 'child' => 'deleteMediaAlbums']);

        $this->delete('auth_item_child', ['parent' => 'author', 'child' => 'viewMediaCategories']);
        $this->delete('auth_item_child', ['parent' => 'moderator', 'child' => 'createMediaCategories']);
        $this->delete('auth_item_child', ['parent' => 'moderator', 'child' => 'editMediaCategories']);
        $this->delete('auth_item_child', ['parent' => 'administrator', 'child' => 'deleteMediaCategories']);


        $this->delete('auth_item_child', ['parent' => 'uploadMedia', 'child' => 'editMedia']);
        $this->delete('auth_item_child', ['parent' => 'deleteMedia', 'child' => 'viewMedia']);
        $this->delete('auth_item_child', ['parent' => 'editMedia', 'child' => 'viewMedia']);
        $this->delete('auth_item_child', ['parent' => 'editMediaSettings', 'child' => 'viewMedia']);
        $this->delete('auth_item_child', ['parent' => 'uploadMedia', 'child' => 'viewMedia']);

        $this->delete('auth_item_child', ['parent' => 'createMediaAlbums', 'child' => 'viewMediaAlbums']);
        $this->delete('auth_item_child', ['parent' => 'deleteMediaAlbums', 'child' => 'viewMediaAlbums']);
        $this->delete('auth_item_child', ['parent' => 'editMediaAlbums', 'child' => 'viewMediaAlbums']);

        $this->delete('auth_item_child', ['parent' => 'createMediaCategories', 'child' => 'viewMediaCategories']);
        $this->delete('auth_item_child', ['parent' => 'deleteMediaCategories', 'child' => 'viewMediaCategories']);
        $this->delete('auth_item_child', ['parent' => 'editMediaCategories', 'child' => 'viewMediaCategories']);


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

        $this->delete('auth_item_child', ['parent' => 'deleteMediaAlbums', 'child' => '/admin/media/album/bulk-delete']);
        $this->delete('auth_item_child', ['parent' => 'createMediaAlbums', 'child' => '/admin/media/album/create']);
        $this->delete('auth_item_child', ['parent' => 'deleteMediaAlbums', 'child' => '/admin/media/album/delete']);
        $this->delete('auth_item_child', ['parent' => 'viewMediaAlbums', 'child' => '/admin/media/album/grid-page-size']);
        $this->delete('auth_item_child', ['parent' => 'viewMediaAlbums', 'child' => '/admin/media/album/grid-sort']);
        $this->delete('auth_item_child', ['parent' => 'viewMediaAlbums', 'child' => '/admin/media/album/index']);
        $this->delete('auth_item_child', ['parent' => 'editMediaAlbums', 'child' => '/admin/media/album/toggle-attribute']);
        $this->delete('auth_item_child', ['parent' => 'editMediaAlbums', 'child' => '/admin/media/album/update']);

        $this->delete('auth_item_child', ['parent' => 'deleteMediaCategories', 'child' => '/admin/media/category/bulk-delete']);
        $this->delete('auth_item_child', ['parent' => 'createMediaCategories', 'child' => '/admin/media/category/create']);
        $this->delete('auth_item_child', ['parent' => 'deleteMediaCategories', 'child' => '/admin/media/category/delete']);
        $this->delete('auth_item_child', ['parent' => 'viewMediaCategories', 'child' => '/admin/media/category/grid-page-size']);
        $this->delete('auth_item_child', ['parent' => 'viewMediaCategories', 'child' => '/admin/media/category/grid-sort']);
        $this->delete('auth_item_child', ['parent' => 'viewMediaCategories', 'child' => '/admin/media/category/index']);
        $this->delete('auth_item_child', ['parent' => 'editMediaCategories', 'child' => '/admin/media/category/toggle-attribute']);
        $this->delete('auth_item_child', ['parent' => 'editMediaCategories', 'child' => '/admin/media/category/update']);


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

        $this->delete('auth_item', ['name' => '/admin/media/album/*']);
        $this->delete('auth_item', ['name' => '/admin/media/album/bulk-delete']);
        $this->delete('auth_item', ['name' => '/admin/media/album/create']);
        $this->delete('auth_item', ['name' => '/admin/media/album/delete']);
        $this->delete('auth_item', ['name' => '/admin/media/album/grid-page-size']);
        $this->delete('auth_item', ['name' => '/admin/media/album/grid-sort']);
        $this->delete('auth_item', ['name' => '/admin/media/album/index']);
        $this->delete('auth_item', ['name' => '/admin/media/album/toggle-attribute']);
        $this->delete('auth_item', ['name' => '/admin/media/album/update']);

        $this->delete('auth_item', ['name' => '/admin/media/category/*']);
        $this->delete('auth_item', ['name' => '/admin/media/category/bulk-delete']);
        $this->delete('auth_item', ['name' => '/admin/media/category/create']);
        $this->delete('auth_item', ['name' => '/admin/media/category/delete']);
        $this->delete('auth_item', ['name' => '/admin/media/category/grid-page-size']);
        $this->delete('auth_item', ['name' => '/admin/media/category/grid-sort']);
        $this->delete('auth_item', ['name' => '/admin/media/category/index']);
        $this->delete('auth_item', ['name' => '/admin/media/category/toggle-attribute']);
        $this->delete('auth_item', ['name' => '/admin/media/category/update']);


        $this->delete('auth_item', ['name' => 'deleteMedia']);
        $this->delete('auth_item', ['name' => 'editMedia']);
        $this->delete('auth_item', ['name' => 'editMediaSettings']);
        $this->delete('auth_item', ['name' => 'uploadMedia']);
        $this->delete('auth_item', ['name' => 'viewMedia']);
        $this->delete('auth_item', ['name' => 'fullMediaAccess']);

        $this->delete('auth_item', ['name' => 'viewMediaAlbums']);
        $this->delete('auth_item', ['name' => 'editMediaAlbums']);
        $this->delete('auth_item', ['name' => 'deleteMediaAlbums']);
        $this->delete('auth_item', ['name' => 'createMediaAlbums']);

        $this->delete('auth_item', ['name' => 'viewMediaCategories']);
        $this->delete('auth_item', ['name' => 'editMediaCategories']);
        $this->delete('auth_item', ['name' => 'deleteMediaCategories']);
        $this->delete('auth_item', ['name' => 'createMediaCategories']);


        $this->delete('auth_item_group', ['code' => 'mediaManagement']);
    }
}