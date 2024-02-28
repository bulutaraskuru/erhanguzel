<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $role1 = Role::create([
        //     'name' => 'super_admin',
        //     'display_name' => 'Süper Admin'
        // ]);

        // $role4 = Role::create([
        //     'name' => 'editor',
        //     'display_name' => 'Editör'
        // ]);

        // $role4 = Role::create([
        //     'name' => 'user',
        //     'display_name' => 'Kullanıcı'
        // ]);

        $permissions = [
            // [
            //     'name' => 'user-list',
            //     'display_name' => 'Kullanıcı Listeleme',
            // ],
            // [
            //     'name' => 'user-edit',
            //     'display_name' => 'Kullanıcı Düzenleme',
            // ],
            // [
            //     'name' => 'user-destroy',
            //     'display_name' => 'Kullanıcı Silme',
            // ],
            // [
            //     'name' => 'user-create',
            //     'display_name' => 'Kullanıcı Ekleme',
            // ],
            // [
            //     'name' => 'user-show',
            //     'display_name' => 'Kullanıcı Görüntüleme',
            // ],
            // [
            //     'name' => 'user-export',
            //     'display_name' => 'Kullanıcı Excel Aktarma',
            // ],
            // [
            //     'name' => 'role-create',
            //     'display_name' => 'Yetki Ekleme',
            // ],
            // [
            //     'name' => 'role-list',
            //     'display_name' => 'Yetki Listeleme',
            // ],
            // [
            //     'name' => 'role-edit',
            //     'display_name' => 'Yetki Düzenleme',
            // ],
            // [
            //     'name' => 'role-destroy',
            //     'display_name' => 'Yetki Silme',
            // ],
            // [
            //     'name' => 'role-show',
            //     'display_name' => 'Yetki Görüntüleme',
            // ],

            // [
            //     'name' => 'page-create',
            //     'display_name' => 'Sayfa Ekleme',
            // ],
            // [
            //     'name' => 'page-list',
            //     'display_name' => 'Sayfa Listeleme',
            // ],
            // [
            //     'name' => 'page-edit',
            //     'display_name' => 'Sayfa Düzenleme',
            // ],
            // [
            //     'name' => 'page-destroy',
            //     'display_name' => 'Sayfa Silme',
            // ],
            // [
            //     'name' => 'news-create',
            //     'display_name' => 'Blog Ekleme',
            // ],
            // [
            //     'name' => 'news-list',
            //     'display_name' => 'Blog Listeleme',
            // ],
            // [
            //     'name' => 'news-edit',
            //     'display_name' => 'Blog Düzenleme',
            // ],
            // [
            //     'name' => 'news-destroy',
            //     'display_name' => 'Blog Silme',
            // ],

            // [
            //     'name' => 'sss-create',
            //     'display_name' => 'Sss Ekleme',
            // ],
            // [
            //     'name' => 'sss-list',
            //     'display_name' => 'Sss Listeleme',
            // ],
            // [
            //     'name' => 'sss-edit',
            //     'display_name' => 'Sss Düzenleme',
            // ],
            // [
            //     'name' => 'sss-destroy',
            //     'display_name' => 'Sss Silme',
            // ],

            // [
            //     'name' => 'slider-create',
            //     'display_name' => 'Slider Ekleme',
            // ],
            // [
            //     'name' => 'slider-list',
            //     'display_name' => 'Slider Listeleme',
            // ],
            // [
            //     'name' => 'slider-edit',
            //     'display_name' => 'Slider Düzenleme',
            // ],
            // [
            //     'name' => 'slider-destroy',
            //     'display_name' => 'Slider Silme',
            // ],

            // [
            //     'name' => 'box-create',
            //     'display_name' => 'İcon Ekleme',
            // ],
            // [
            //     'name' => 'box-list',
            //     'display_name' => 'İcon Listeleme',
            // ],
            // [
            //     'name' => 'box-edit',
            //     'display_name' => 'İcon Düzenleme',
            // ],
            // [
            //     'name' => 'box-destroy',
            //     'display_name' => 'İcon Silme',
            // ],

            // [
            //     'name' => 'partner-create',
            //     'display_name' => 'Kurumsal Ortaklar Ekleme',
            // ],
            // [
            //     'name' => 'partner-list',
            //     'display_name' => 'Kurumsal Ortaklar Listeleme',
            // ],
            // [
            //     'name' => 'partner-edit',
            //     'display_name' => 'Kurumsal Ortaklar Düzenleme',
            // ],
            // [
            //     'name' => 'partner-destroy',
            //     'display_name' => 'Kurumsal Ortaklar Silme',
            // ],
            // [
            //     'name' => 'gallery-list',
            //     'display_name' => 'Galeri Listeleme',
            // ],
            [
                'name' => 'project-create',
                'display_name' => 'Proje Ekleme',
            ],
            [
                'name' => 'project-list',
                'display_name' => 'Proje Listeleme',
            ],
            [
                'name' => 'project-edit',
                'display_name' => 'Proje Düzenleme',
            ],
            [
                'name' => 'project-destroy',
                'display_name' => 'Proje Silme',
            ],
            [
                'name' => 'projectcategory-create',
                'display_name' => 'Proje Kategori Ekleme',
            ],
            [
                'name' => 'projectcategory-list',
                'display_name' => 'Proje Kategori Listeleme',
            ],
            [
                'name' => 'projectcategory-edit',
                'display_name' => 'Proje Kategori Düzenleme',
            ],
            [
                'name' => 'projectcategory-destroy',
                'display_name' => 'Proje Kategori Silme',
            ],
            [
                'name' => 'digital-create',
                'display_name' => 'Dijital Ekleme',
            ],
            [
                'name' => 'digital-list',
                'display_name' => 'Dijital Listeleme',
            ],
            [
                'name' => 'digital-edit',
                'display_name' => 'Dijital Düzenleme',
            ],
            [
                'name' => 'digital-destroy',
                'display_name' => 'Dijital Silme',
            ],
            [
                'name' => 'video-create',
                'display_name' => 'Video Ekleme',
            ],
            [
                'name' => 'video-list',
                'display_name' => 'Video Listeleme',
            ],
            [
                'name' => 'video-edit',
                'display_name' => 'Video Düzenleme',
            ],
            [
                'name' => 'video-destroy',
                'display_name' => 'Video Silme',
            ],
        ];

        foreach ($permissions as $key => $permission) {
            Permission::create(['name' => $permission['name'], 'display_name' => $permission['display_name'], 'guard_name' => 'web']);
        }
    }
}
