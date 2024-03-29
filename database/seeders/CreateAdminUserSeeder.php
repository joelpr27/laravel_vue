<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'David Herrera',
            'email' => 'admin@demo.com',
            'password' => bcrypt('12345678'),
            'puntos' => 99999,
            'nivel_id' => 4,
            'experience' => 3300

        ]);

        $role = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'user']);
        $permissions = [
            'post-list',
            'post-create',
            'post-edit',
            'post-delete',
            'post-list',
            'exercise-create',
            'exercise-edit',
            'exercise-all',
            'exercise-delete',
            'recompensa-list',
            'recompensa-create',
            'recompensa-edit',
            'recompensa-all',
            'recompensa-delete'
        ];
        $role2->syncPermissions($permissions);
        Category::create(['name' => 'Vue.js']);
        Category::create(['name' => 'Cat 2']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
