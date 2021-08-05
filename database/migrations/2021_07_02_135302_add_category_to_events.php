<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryToEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->enum('category', [

                'Clubs & soirées',
                'Concerts & spectacles',
                'Festivals',
                'Loisirs & lieux culturels',
                'Salons grand public',
                'Salons professionnels',
                'Conférences',
                'Lotos en ligne',
                
            ])->default(NULL);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->enum('category', [

                'Clubs & soirées',
                'Concerts & spectacles',
                'Festivals',
                'Loisirs & lieux culturels',
                'Salons grand public',
                'Salons professionnels',
                'Conférences',
                'Lotos en ligne',
                
            ])->default('NULL');
        });
    }
}
