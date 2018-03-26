<?php

class DatabaseSeeder {
  public function run()
  {
    $this->call(UserTableSeeder::class);
  }
}

class Seeder {
  public function run()
  {
    DB::table('users')->insert([
      'name' => 'shibu',
      'email' => 'polodev10@gmail.com'
    ]);
  }
}