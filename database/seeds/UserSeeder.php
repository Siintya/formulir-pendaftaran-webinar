<?php

use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'         => 'admin123',
            'user_role_id' => '1',
            'email'        => 'admin@gmail.com',
            'password'     => bcrypt('password123'),
            'company'      => 'NULL',
            'phone'        => '0812345678',
            'photo'        => 'NULL',
            'created_at'   => Carbon::now()
        ]);
    }
}
