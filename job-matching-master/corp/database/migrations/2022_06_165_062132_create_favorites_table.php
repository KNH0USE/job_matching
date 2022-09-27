
<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->increments('id')->unsigned()->comment("ID");
            $table->integer('student_id')->index()->comment("生徒ID");
            $table->integer('corporation_id')->index()->comment("企業ID");
            $table->tinyInteger('type')->index()->comment("区分（企業:1 生徒:2）");
            $table->tinyInteger('status')->index()->comment("お気に入りステータス（0:取り消し 1:お気に入り）");
            $table->timestamp('created_at')->useCurrent()->comment("作成日");
            $table->timestamp('updated_at')->useCurrent()->comment("更新日");
            $table->softDeletes();
            $table->unique(['corporation_id', 'student_id', 'type']);

        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorites');
    }
}
