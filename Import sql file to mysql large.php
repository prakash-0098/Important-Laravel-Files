<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    protected $ImportSqlFileToDB = [
        // 'sql\world.sql',
        'sql\countries.sql',
        'sql\states.sql',
        'sql\cities.sql'
    ];
    public function run()
    {
        $this->command->info('Database seeding has been started ...');
        $this->command->getOutput()->progressStart(count($this->ImportSqlFileToDB));
        foreach($this->ImportSqlFileToDB as $filePath){

            $this->command->info('Importing '.$filePath.' ...');
            exec("mysql -u ".config('app.db_username')." -p".config('app.db_password')." ".config('app.database')." < ".public_path($filePath));
            $this->command->getOutput()->progressAdvance();
        }
        $this->command->getOutput()->progressFinish();
    }
}
