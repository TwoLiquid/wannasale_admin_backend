<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins_vendors', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('admin_id')->index();
            $table->uuid('vendor_id')->index();
            $table->timestamps();

            $table->foreign('admin_id')
                ->references('id')->on('admins')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins_vendors');
    }
}
