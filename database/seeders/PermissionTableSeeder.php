<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',
            'user-list',
            'student-list',
            'user-create',
            'user-edit',
            'user-delete',
            'user-all',
            'post-list',
            'post-create',
            'post-edit',
            'post-all',
            'post-delete',
            'exercise-list',
            'exercise-create',
            'exercise-edit',
            'exercise-all',
            'exercise-delete',
            'category-list',
            'category-create',
            'category-edit',
            'category-delete',
            'recompensa-list',
            'recompensa-create',
            'recompensa-edit',
            'recompensa-all',
            'recompensa-delete'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
