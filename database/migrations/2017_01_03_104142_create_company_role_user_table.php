<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_role_users', function (Blueprint $table) {
            $table->unsignedInteger('company_id');
            $table->unsignedInteger('role_user_id');

            $table->foreign('role_user_id', 'fk_company_role_user_2')->references('id')->on('role_users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('company_id', 'fk_company_role_user_id')->references('id')->on('companies')->onDelete('CASCADE')->onUpdate('CASCADE');
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
        Schema::dropIfExists('company_role_users');
    }
}
