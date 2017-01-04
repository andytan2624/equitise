<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Migration auto-generated by Sequel Pro Laravel Export
 * @see https://github.com/cviebrock/sequel-pro-laravel-export
 */
class CreateSyndicateRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('syndicate_role_users', function (Blueprint $table) {
            $table->unsignedInteger('syndicate_id');
            $table->unsignedInteger('role_user_id');

            $table->foreign('syndicate_id', 'fk_syndicate_role_1')->references('id')->on('syndicates')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('role_user_id', 'fk_syndicate_role_2')->references('id')->on('role_users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('syndicate_role_users');
    }
}