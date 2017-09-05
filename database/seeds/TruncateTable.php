<?php

use Illuminate\Database\Seeder;

class TruncateTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tableNames = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();	
        
        foreach ($tableNames as $name) {
		    //if you don't want to truncate migrations
		    if ($name == 'migrations') {
		        continue;
		    }
		    DB::table($name)->truncate();
		}
    }
}
