<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_category', function (Blueprint $table) {
            $table->id();
            $table->string('name',255)->nullable();
            $table->string('description',255)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        if (Schema::hasTable('product_category')){
            $default = [
                [
                    "name" => "ขบเคี้ยว",
                    "description" => "กินกับอะไรก็อร่อย"
                ],
                [
                    "name" => "นม",
                    "description" => "นมสดแท้ 100%"
                ],
                [
                    "name" => "เครื่องดื่มอัดลมและน้ำหวาน",
                    "description" => "ช่วยดับกระหาย เพิ่มความสดชื่น"
                ],
                [
                    "name" => "อื่นๆ",
                    "description" => "เยอะแยะมากมาย"
                ]
            ];
            DB::table('product_category')->insert($default);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_category');
    }
}
