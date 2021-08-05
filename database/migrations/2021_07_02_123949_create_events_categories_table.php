<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateEventsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 25)->nullable();
            $table->timestamps();
        });

        $values = [

            'Clubs & soirées',
            'Concerts & spectacles',
            'Festivals',
            'Loisirs & lieux culturels',
            'Salons grand public',
            'Salons professionnels',
            'Conférences',
            'Lotos en ligne',
            
        ];
        
        for ($i=0; $i < 8 ; $i++) { 

            DB::table('events_categories')->insert( 
                ['name'           => $values[$i],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ]
            );
        }
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events_categories');
    }
}
