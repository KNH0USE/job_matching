<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorporationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corporations', function (Blueprint $table) {
            $table->increments('id')->unsigned()->comment("ID");
            $table->string('name', 100)->unique()->comment("企業名");
            $table->string('email', 50)->unique()->comment("メールアドレス");
            $table->string('password', 100)->comment("パスワード");
            $table->string('tel', 20)->nullable()->comment("電話番号");
            $table->string('mobile_tel', 20)->comment("携帯電話番号");
            $table->text('image_path')->nullable()->comment("ロゴのパス");
            $table->string('hp_url', 150)->nullable()->comment("HPのURL");
            $table->string('business_location', 50)->comment("事業所の所在地");
            $table->string('representative', 30)->comment("代表者");
            $table->date('establishment_date')->nullable()->comment("設立年月日");
            $table->integer('capital')->comment("資本金");
            $table->integer('amount_sales')->comment("売上高");
            $table->integer('employees_number')->comment("従業員数");
            $table->text('business_content')->comment("事業内容");
            $table->text('main_customer')->nullable()->comment("主要取引先");
            $table->string('department_name', 50)->nullable()->comment("部署名");
            $table->string('manager_name', 20)->nullable()->comment("担当者名");
            $table->integer('industry_id')->index()->comment("業種ID");
            $table->tinyInteger('status')->comment("会員ステータス（0: 退会済み　1:入会）");
            $table->timestamp('created_at')->useCurrent()->comment("作成日");
            $table->timestamp('updated_at')->useCurrent()->comment("更新日");
            $table->softDeletes();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('corporations');
    }
}
