<?php

namespace Database\Seeders;

use App\Aggregates\Users\UserAggregate;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;
use Symfony\Component\VarDumper\VarDumper;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(is_null(User::whereEmail('developers@capeandbay.com')->first()))
        {
            $uuid = Uuid::uuid4()->toString();
            $payload = [
                'email' => 'developers@capeandbay.com',
                'first_name' => 'Developer',
                'last_name' => 'User',
                'name' => 'developer',
                'email_verified_at' => date('Y-m-d H:i:s'),
                'password' => bcrypt('Hello123!')
            ];
            UserAggregate::retrieve($uuid)
                ->createNewUser('developers@capeandbay.com', $payload)->persist();
            VarDumper::dump('Added Developer User.');
        }
        else
        {
            VarDumper::dump('Skipping User Seeder.');
        }
    }
}
