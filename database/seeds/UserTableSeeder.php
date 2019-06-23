<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = bcrypt('12345');
        // List user
        $users = [
            [
                'name' => 'Ayu Amalia Arifiani', 
                'email' => 'test@test.com', 
                'password' => $password, 
                'api_token' => 'PAtW9muV1FbR8GdR6sarHqgJB0FqxXS7pvNYFSVN6OkXZ3wuhlEkVBSnuJqW',
                'role_id' => 2
            ],
            [
                'name' => 'Penjual 1', 
                'email' => 'seller@seller.com', 
                'password' => $password, 
                'api_token' => 'eb7xK88rSISDOfm8v9thsbfFkVlSjBSbLJnSpbtZhlxlLApRIrpeRcZ0rccZ',
                'role_id' => 3
            ],
            [
                'name' => 'Administrator', 
                'email' => 'admin@admin.com', 
                'password' => $password, 
                'api_token' => 'eb7xK88rSISDOfm8v9thsbfFkVlSjBSbLJnSpbtZhlxlLApRIrpeRcZ0rccZ',
                'role_id' => 1
            ],
        ];
        
        User::insert($users);
    }
}
