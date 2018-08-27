<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {
    
    public function up()
    {
        Schema::table('animals', function(Blueprint $table) {
            $table->foreign('team_id')->references('id')->on('teams')
                  ->onDelete('cascade')
                  ->onUpdate('restrict');
        });
        Schema::table('animals', function(Blueprint $table) {
            $table->foreign('type_id')->references('id')->on('types')
                  ->onDelete('set null')
                  ->onUpdate('restrict');
        });
        Schema::table('animals', function(Blueprint $table) {
            $table->foreign('race_id')->references('id')->on('races')
                  ->onDelete('set null')
                  ->onUpdate('restrict');
        });
        Schema::table('animals', function(Blueprint $table) {
            $table->foreign('reservation_id')->references('id')->on('reservations')
                  ->onDelete('set null')
                  ->onUpdate('set null');
        });
        Schema::table('animals', function(Blueprint $table) {
            $table->foreign('color_id')->references('id')->on('colors')
                  ->onDelete('set null')
                  ->onUpdate('set null');
        });
        Schema::table('animals', function(Blueprint $table) {
            $table->foreign('foster_home_id')->references('id')->on('customers')
                  ->onDelete('set null')
                  ->onUpdate('set null');
        });
        Schema::table('types', function(Blueprint $table) {
            $table->foreign('team_id')->references('id')->on('teams')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
        Schema::table('races', function(Blueprint $table) {
            $table->foreign('team_id')->references('id')->on('teams')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
        Schema::table('contacts', function(Blueprint $table) {
            $table->foreign('team_id')->references('id')->on('teams')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
        Schema::table('contact_categories', function(Blueprint $table) {
            $table->foreign('contact_id')->references('id')->on('contacts')
                  ->onDelete('set null')
                  ->onUpdate('set null');
        });
        Schema::table('vaccines', function(Blueprint $table) {
            $table->foreign('vaccine_categories_id')->references('id')->on('vaccine_categories')
                  ->onDelete('set null')
                  ->onUpdate('set null');
        });
        Schema::table('vaccines', function(Blueprint $table) {
            $table->foreign('contact_id')->references('id')->on('contacts')
                  ->onDelete('set null')
                  ->onUpdate('set null');
        });
        Schema::table('vaccines', function(Blueprint $table) {
            $table->foreign('animal_id')->references('id')->on('animals')
                  ->onDelete('set null')
                  ->onUpdate('set null');
        });
        Schema::table('visits', function(Blueprint $table) {
            $table->foreign('contact_id')->references('id')->on('contacts')
                  ->onDelete('set null')
                  ->onUpdate('set null');
        });
        Schema::table('visits', function(Blueprint $table) {
            $table->foreign('animal_id')->references('id')->on('animals')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
        Schema::table('conditions', function(Blueprint $table) {
            $table->foreign('animal_id')->references('id')->on('animals')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
        Schema::table('pairs', function(Blueprint $table) {
            $table->foreign('father_id')->references('id')->on('animals')
                  ->onDelete('set null')
                  ->onUpdate('set null');
        });
        Schema::table('pairs', function(Blueprint $table) {
            $table->foreign('mother_id')->references('id')->on('animals')
                  ->onDelete('set null')
                  ->onUpdate('set null');
        });
        Schema::table('shows', function(Blueprint $table) {
            $table->foreign('animal_id')->references('id')->on('animals')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
        Schema::table('customers', function(Blueprint $table) {
            $table->foreign('team_id')->references('id')->on('teams')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
        Schema::table('reservations', function(Blueprint $table) {
            $table->foreign('team_id')->references('id')->on('teams')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
        Schema::table('reservations', function(Blueprint $table) {
            $table->foreign('animal_id')->references('id')->on('animals')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
        Schema::table('reservations', function(Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('customers')
                  ->onDelete('set null')
                  ->onUpdate('set null');
        });
        Schema::table('colors', function(Blueprint $table) {
            $table->foreign('team_id')->references('id')->on('teams')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }
    
    public function down()
    {
        Schema::table('animals', function(Blueprint $table) {
            $table->dropForeign('animals_team_id_foreign');
        });
        Schema::table('animals', function(Blueprint $table) {
            $table->dropForeign('animals_type_id_foreign');
        });
        Schema::table('animals', function(Blueprint $table) {
            $table->dropForeign('animals_race_id_foreign');
        });
        Schema::table('animals', function(Blueprint $table) {
            $table->dropForeign('animals_reservation_id_foreign');
        });
        Schema::table('animals', function(Blueprint $table) {
            $table->dropForeign('animals_color_id_foreign');
        });
        Schema::table('animals', function(Blueprint $table) {
            $table->dropForeign('animals_foster_home_id_foreign');
        });
        Schema::table('types', function(Blueprint $table) {
            $table->dropForeign('types_team_id_foreign');
        });
        Schema::table('races', function(Blueprint $table) {
            $table->dropForeign('races_team_id_foreign');
        });
        Schema::table('contacts', function(Blueprint $table) {
            $table->dropForeign('contacts_team_id_foreign');
        });
        Schema::table('contact_categories', function(Blueprint $table) {
            $table->dropForeign('contact_categories_contact_id_foreign');
        });
        Schema::table('vaccines', function(Blueprint $table) {
            $table->dropForeign('vaccines_vaccine_categories_id_foreign');
        });
        Schema::table('vaccines', function(Blueprint $table) {
            $table->dropForeign('vaccines_contact_id_foreign');
        });
        Schema::table('vaccines', function(Blueprint $table) {
            $table->dropForeign('vaccines_animal_id_foreign');
        });
        Schema::table('visits', function(Blueprint $table) {
            $table->dropForeign('visits_contact_id_foreign');
        });
        Schema::table('visits', function(Blueprint $table) {
            $table->dropForeign('visits_animal_id_foreign');
        });
        Schema::table('conditions', function(Blueprint $table) {
            $table->dropForeign('conditions_animal_id_foreign');
        });
        Schema::table('pairs', function(Blueprint $table) {
            $table->dropForeign('pairs_father_id_foreign');
        });
        Schema::table('pairs', function(Blueprint $table) {
            $table->dropForeign('pairs_mother_id_foreign');
        });
        Schema::table('shows', function(Blueprint $table) {
            $table->dropForeign('shows_animal_id_foreign');
        });
        Schema::table('customers', function(Blueprint $table) {
            $table->dropForeign('customers_team_id_foreign');
        });
        Schema::table('reservations', function(Blueprint $table) {
            $table->dropForeign('reservations_team_id_foreign');
        });
        Schema::table('reservations', function(Blueprint $table) {
            $table->dropForeign('reservations_animal_id_foreign');
        });
        Schema::table('reservations', function(Blueprint $table) {
            $table->dropForeign('reservations_customer_id_foreign');
        });
        Schema::table('colors', function(Blueprint $table) {
            $table->dropForeign('colors_team_id_foreign');
        });
    }
}
