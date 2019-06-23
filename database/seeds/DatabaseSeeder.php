<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GuardTableSeeder::class);

        DB::table('transaction_type')->delete();
        
        $user = array(
            array(
                'type' => 'Top Up',
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ),
            array(
                'type' => 'Transfer',
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ),
            array(
                'type' => 'Withdraw',
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            )
        );
        
        DB::table('transaction_type')->insert($user);
    }
}
