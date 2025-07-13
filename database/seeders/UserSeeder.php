<?php
// UserSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->createMany([
            ['name' => 'Admin Bandung','cabang_id' => 1,'username' => 'adminbdg','password' => bcrypt('12345678'),'role' => 'admin'],
            ['name' => 'Admin Purwakarta','cabang_id' => 2,'username' => 'adminpwk','password' => bcrypt('12345678'),'role' => 'admin'],
            ['name' => 'Super Admin','cabang_id' => null,'username' => 'admin','password' => bcrypt('12345678'),'role' => 'super_admin'],
            ['name' => 'Super Admin 2','cabang_id' => null,'username' => 'super_admin','password' => bcrypt('12345678'),'role' => 'super_admin']
        ]);
    }
}
