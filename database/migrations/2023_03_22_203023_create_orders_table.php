<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->nullable();
            $table->foreignId('user_id')->nullable()->onDelete('cascade');
            $table->string('phone')->nullable();
            $table->string('first_name')->nullable();
            $table->string('sur_name')->nullable();
            $table->string('district')->nullable();
            $table->string('address')->nullable();
            $table->string('post')->nullable();
            $table->string('email')->nullable();
            $table->string('diff_district')->nullable();
            $table->string('diff_address')->nullable();

            $table->enum('payment', ['paid', 'pending'])->nullable()->default('pending');
            $table->enum('payment_method', ['bkash', 'cod', 'nagad'])->nullable();
            $table->float('total')->nullable();
            $table->integer('qty_total')->nullable();
            $table->float('sub_total')->nullable();
            $table->float('dl_total')->nullable();
            $table->float('wt_total')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
