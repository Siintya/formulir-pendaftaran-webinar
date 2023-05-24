<?php

use Illuminate\Database\Seeder;
use App\UserRole;
use Carbon\Carbon;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserRole::create([
            'name'        => 'admin',
            'description' => 'mengelola dan mengatur acara webinar secara teknis',
            'created_at'  => Carbon::now(),
        ]);

        UserRole::create([
            'name'        => 'participant',
            'description' => 'menghadiri dan berpartisipasi dalam webinar',
            'created_at'  => Carbon::now(),
        ]);
    }
}
