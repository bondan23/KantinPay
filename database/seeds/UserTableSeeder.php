<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Balance;

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
                'email' => 'test@gmail.com', 
                'password' => $password, 
                'api_token' => 'PAtW9muV1FbR8GdR6sarHqgJB0FqxXS7pvNYFSVN6OkXZ3wuhlEkVBSnuJqW',
                'role_id' => 2,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ],
            [
                'name' => 'User Tester', 
                'email' => 'test@test.com', 
                'password' => $password, 
                'api_token' => 'PAtW9muV1FbR8GdR6sarHqgJB0FqxXS7pvNYFSVN6OkXZ3wuhlEkVBSnuJasd',
                'role_id' => 2,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Warung Tegal', 
                'email' => 'warteg@gmail.com', 
                'password' => $password, 
                'api_token' => 'eb7xK88rSISDOfm8v9thsbfFkVlSjBSbLJnSpbtZhlxlLApRIrpeRcZ0rccZ',
                'role_id' => 3,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Pembeli Satu', 
                'email' => 'buyer@buyer.com', 
                'password' => $password, 
                'api_token' => 'eb7xK88rSISDOfm8v9thsbfFskVlSjBSbLJnSpbtZhlxlLApRIrpeRcZ0rccS',
                'role_id' => 2,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Penjual Satu', 
                'email' => 'seller@seller.com', 
                'password' => $password, 
                'api_token' => 'eb7xK88rSISDOfm8v9thsbfFkVlSjBSbLJnSpbtZhlxlLApRIrpeRcZ0rccS',
                'role_id' => 3,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Administrator', 
                'email' => 'admin@admin.com', 
                'password' => $password, 
                'api_token' => 'oosL62MB00LlA12Cl8IMBA3Hls2gVlxXYeuucStIHp4yEE7tEKSoKRvw5v12',
                'role_id' => 1,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ],
        ];
        
        User::insert($users);

        foreach($users as $key => $val) {
            $balance = [
                'user_id' => $key + 1,
                'balance' => 0,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ];
            Balance::create($balance);
        }
    }
}
