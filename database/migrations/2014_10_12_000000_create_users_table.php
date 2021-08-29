<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('이름');
            $table->string('user_id')->comment('아이디');
            $table->string('email')->unique()->comment('이메일');
            $table->timestamp('email_verified_at')->nullable('사용자 이메일 인증');
            $table->string('password')->comment('비밀번호');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::statement("ALTER TABLE users COMMENT='회원정보'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
