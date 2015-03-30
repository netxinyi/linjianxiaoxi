<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration {

//    色系
//    品种
//    价格
//    伸长
//    父系品种
//    母系品种
//    显性基因
//    隐性基因
//    出生日期
//    年龄
//    是否已售
//    描述


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        //创建品种表
        Schema::create('varietie', function ($table) {
            $table->increments('id');
            $table->string('name'    ,50      )->comment('品种名');
            $table->string('features',255     )->comment('品种特征');
            $table->timestamps();
            $table->softDeletes();

            $table->comment = '品种表';
            $table->engine  = 'MyISAM';
            $table->unique('name');
        });
        //填充默认品种
        $this->seedVarieties();


        //创建鹦鹉表
        Schema::create('product', function($table){
            $table->increments('id');
            $table->string('code', 20)->unique();
            $table->string('title', 255);
            $table->decimal('price', 10,2)->unsigned();
            $table->tinyInteger('varietieId');
            $table->tinyInteger('faVarietie');
            $table->tinyInteger('maVarietie');
            $table->date('birthday');
            $table->string('dominantGene',255);
            $table->string('implicitGene',255);
            $table->text('description');


            $table->timestamps();
            $table->softDeletes();
//
//            $table->foreign('varietie')
//                ->foreign('faVarietie')
//                ->foreign('maVarietie')
//                ->references('id')->on('varieties')
//                ->onDelete('cascade');
            $table->comment = '鹦鹉';
            $table->engine = 'InnoDB';
        });


        //创建鹦鹉相册表
        Schema::create('gallery', function($table){
            $table->increments('id');
            $table->integer('productId');
            $table->string('title', 100);
            $table->string('path', 255);
            $table->string('description');
            $table->timestamps();

            $table->index('productId');

//            $table->foreign('productId')
//                ->references('id')->on('products')
//                ->onDelete('cascade');
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('varietie');
        Schema::dropIfExists('product');
        Schema::dropIfExists('gallery');
    }


    public function seedVarieties(){
        Varietie::create(array(
            'name'  =>  '灰翅',
            'features' =>'灰翅的特征'
        ));
    }
}
