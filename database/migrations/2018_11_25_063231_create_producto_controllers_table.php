<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductoControllersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);

        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("id_producto");
            $table->string("nombre");
            $table->longText("descripcion");
            $table->string("img");
            $table->integer("id_categoria");
            $table->integer("stock");
            $table->integer("precio");
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
        Schema::dropIfExists('productos');
    }
}
