<?php

use yeesoft\db\PermissionsMigration;

class m150825_213610_add_media_permissions extends PermissionsMigration
{

    public function beforeUp()
    {
        $this->addPermissionsGroup('mediaManagement', 'Media Management');
    }

    public function afterDown()
    {
        $this->deletePermissionsGroup('mediaManagement');
    }

    public function getPermissions()
    {
        return [
            'mediaManagement' => [
                'links' => [
                    '/admin/media/*',
                    '/admin/media/default/*',
                    '/admin/media/album/*',
                    '/admin/media/category/*',
                ],
                'viewMedia' => [
                    'title' => 'View Media',
                    'links' => [
                        '/admin/#mediafile',
                        '/admin/media/default/index',
                        '/admin/media/manage/index',
                        '/admin/media/manage/info',
                    ],
                ],
                'editMedia' => [
                    'title' => 'Edit Media',
                    'links' => [
                        '/admin/media/manage/update',
                    ],
                    'childs' => [
                        'viewMedia',
                    ],
                ],
                'deleteMedia' => [
                    'title' => 'Delete Media',
                    'links' => [
                        '/admin/media/manage/delete',
                    ],
                    'roles' => [
                        self::ROLE_ADMIN,
                    ],
                    'childs' => [
                        'viewMedia',
                    ],
                ],
                'editMediaSettings' => [
                    'title' => 'Edit Media Settings',
                    'links' => [
                        '/admin/media/default/settings',
                        '/admin/media/manage/resize',
                    ],
                    'childs' => [
                        'viewMedia',
                    ],
                ],
                'uploadMedia' => [
                    'title' => 'Upload Media',
                    'links' => [
                        '/admin/media/manage/upload',
                        '/admin/media/manage/uploader',
                    ],
                    'roles' => [
                        self::ROLE_AUTHOR,
                    ],
                    'childs' => [
                        'viewMedia',
                        'editMedia',
                    ],
                ],
                'fullMediaAccess' => [
                    'title' => 'Full Media Access',
                    'roles' => [
                        self::ROLE_MODERATOR,
                    ],
                    'childs' => [
                        'viewMedia',
                    ],
                ],
                'viewMediaAlbums' => [
                    'title' => 'View Media Albums',
                    'links' => [
                        '/admin/media/album/grid-page-size',
                        '/admin/media/album/grid-sort',
                        '/admin/media/album/index',
                    ],
                ],
                'editMediaAlbums' => [
                    'title' => 'Edit Media Albums',
                    'links' => [
                        '/admin/media/album/toggle-attribute',
                        '/admin/media/album/update',
                    ],
                    'roles' => [
                        self::ROLE_MODERATOR,
                    ],
                    'childs' => [
                        'viewMediaAlbums',
                    ],
                ],
                'deleteMediaAlbums' => [
                    'title' => 'Delete Media Albums',
                    'links' => [
                        '/admin/media/album/bulk-delete',
                        '/admin/media/album/delete',
                    ],
                    'roles' => [
                        self::ROLE_ADMIN,
                    ],
                    'childs' => [
                        'viewMediaAlbums',
                    ],
                ],
                'createMediaAlbums' => [
                    'title' => 'Create Media Albums',
                    'links' => [
                        '/admin/media/album/create',
                    ],
                    'roles' => [
                        self::ROLE_AUTHOR,
                    ],
                    'childs' => [
                        'viewMediaAlbums',
                    ],
                ],
                'fullMediaAlbumAccess' => [
                    'title' => 'Full Media Albums Access',
                    'roles' => [
                        self::ROLE_MODERATOR,
                    ],
                ],
                'viewMediaCategories' => [
                    'title' => 'View Media Categories',
                    'links' => [
                        '/admin/media/category/grid-page-size',
                        '/admin/media/category/grid-sort',
                        '/admin/media/category/index',
                    ],
                ],
                'editMediaCategories' => [
                    'title' => 'Edit Media Categories',
                    'links' => [
                        '/admin/media/category/toggle-attribute',
                        '/admin/media/category/update',
                    ],
                    'roles' => [
                        self::ROLE_MODERATOR,
                    ],
                    'childs' => [
                        'viewMediaCategories',
                    ],
                ],
                'deleteMediaCategories' => [
                    'title' => 'Delete Media Categories',
                    'links' => [
                        '/admin/media/category/bulk-delete',
                        '/admin/media/category/delete',
                    ],
                    'roles' => [
                        self::ROLE_ADMIN,
                    ],
                    'childs' => [
                        'viewMediaCategories',
                    ],
                ],
                'createMediaCategories' => [
                    'title' => 'Create Media Categories',
                    'links' => [
                        '/admin/media/category/create',
                    ],
                    'roles' => [
                        self::ROLE_MODERATOR,
                    ],
                    'childs' => [
                        'viewMediaCategories',
                    ],
                ],
                'fullMediaCategoryAccess' => [
                    'title' => 'Full Media Categories Access',
                    'roles' => [
                        self::ROLE_MODERATOR,
                    ],
                ],
            ],
        ];
    }

}
