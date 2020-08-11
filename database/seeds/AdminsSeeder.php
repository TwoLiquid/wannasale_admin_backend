<?php

use Illuminate\Database\Seeder;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->command->confirm('Do you want to seed admins table?')) {
            \Illuminate\Database\Eloquent\Model::unguard();

            if ($this->command->confirm('Do you want to clear admins table first?')) {
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                DB::table('admins')->truncate();
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            }

            \App\Models\Admin::create([
                'name'      => 'Администратор',
                'email'     => 'vendors@jufy.ru',
                'password'  => Hash::make('bananawanna'),
                'approved'  => true,
                'is_super'  => true
            ]);

            $this->command->info('Admins table seeded!');

            \Illuminate\Database\Eloquent\Model::reguard();
        }
    }
}
