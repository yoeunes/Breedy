<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->string('street1', 255)->after('photo_url');
            $table->string('street2', 255)->after('street1')->nullable();
            $table->string('city', 255)->after('street2');
            $table->string('state', 255)->after('city')->nullable();
            $table->string('zip', 255)->after('state');
            $table->string('country', 255)->after('zip');
            $table->string('companyName', 255)->after('country')->nullable();
            $table->string('companyNumber', 255)->after('companyName')->nullable();
            $table->string('vat', 255)->after('companyNumber')->nullable();
            $table->string('bankAccount', 255)->after('vat')->nullable();
            $table->string('bicSwift', 255)->after('bankAccount')->nullable();
            $table->text('addInfos')->after('bicSwift')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teams', function (Blueprint $table) {
            //
        });
    }
}
