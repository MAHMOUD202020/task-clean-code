<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\PreferredCommunicationChannel;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Artisan::call('migrate');

        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.test',
            'phone' => '01112295544',
            'is_admin' => true,
            'communication_channel' => PreferredCommunicationChannel::email,
            'password' => bcrypt('123456@#')
        ]);

        dd('admin account',
            [
                'phone' => '01112295544' ,
                'password' => '123456@#'
            ]
        );
    }
}
