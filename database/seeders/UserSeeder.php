<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\City;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Department;
use App\Models\ExchangeRate;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Ahmed S. Abduljabbar',
                'email' => config('app.env') == 'local' ? 'ahmedsalar66@yahoo.com' : 'ahmed.salar@pixel.krd',
                'password' =>  Hash::make('Ah1416Ah'),
            ],
            [
                'name' => 'Muhammed Salar',
                'email' => 'muhamedsalar55@gmail.com',
                'password' => Hash::make('muhammedmuhammed'),
            ],
        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
