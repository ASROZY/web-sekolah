<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = 'faisal';
        $user->email = 'faisalasrozy@gmail.com';
        $user->password = bcrypt('12345678');
        $user->type = 2;
        $user->save();

        $user = new User;
        $user->name = 'rima';
        $user->email = 'yunirima0@gmail.com';
        $user->password = bcrypt('12345678');
        $user->type = 2;
        $user->save();

        $user = new User;
        $user->name = 'admin';
        $user->email = 'admin@admin.com';
        $user->password = bcrypt('12345678');
        $user->type = 2;
        $user->save();
    }
}
