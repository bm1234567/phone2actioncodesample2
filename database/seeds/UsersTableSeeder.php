<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class)->create([
            'name' => env('DB_ADMIN_NAME'),
            'email' => env('DB_ADMIN_EMAIL'),
            'password' => password_hash(env('DB_ADMIN_PASSWORD'), PASSWORD_DEFAULT),
        ])->create([
            'name' => env('DB_TEST_USER_NAME'),
            'email' => env('DB_TEST_USER_EMAIL'),
            'password' => password_hash(env('DB_TEST_USER_PASSWORD'), PASSWORD_DEFAULT),
        ])->each(function($u){
            $blogs = factory(\App\Blog::class, 50)->create([ 'user_id' => $u->id]);
            $u->blogs()->saveMany($blogs);
        });
    }
}
