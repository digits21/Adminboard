<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Projects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('projects',function(Blueprint $table){
               $table->increments('id');
               $table->string('code')->unique();
               $table->string('type');
                $table->string('project_name')->unique();
                $table->integer('manager');
               $table->longtext('content');
               $table->integer('creator');
                $table->string('status');
               $table->integer('editions');
              $table->rememberToken();
              $table->timestamps();
            
            
        });
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::dropIfExists('projetcs');
        //
    }
}
