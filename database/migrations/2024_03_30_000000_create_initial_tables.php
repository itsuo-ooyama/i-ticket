<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // ====================
        // テーブル作成
        // ====================
        // アイドル情報
        Schema::create('idols', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('idol_status')->unsigned()->default(0)->comment('アイドルステータス');
            $table->string('idol_name', 191)->comment('アイドル名');
            $table->string('idol_production', 191)->nullable()->comment('所属事務所');
            $table->string('search_word', 191)->comment('検索ワード');
            $table->string('search_word_sub')->nullable()->comment('検索ワード(サブ)');
            $table->dateTime('scheduling_datetime')->nullable()->comment('スケジューリング日時');
            $table->timestamp('created_at')->useCurrent()->comment('作成日時');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate()->comment('更新日時');
            $table->timestamp('deleted_at')->nullable()->comment('削除日時');
        });
        // サイト情報
        Schema::create('sites', function (Blueprint $table) {
            $table->increments('id');
            $table->string('site_name', 191)->comment('チケットサイト名');
            $table->string('site_url', 255)->comment('チケットサイトURL');
            $table->string('site_search_url', 255)->comment('チケットサイト検索URL');
            $table->timestamp('created_at')->useCurrent()->comment('作成日時');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate()->comment('更新日時');
            $table->timestamp('deleted_at')->nullable()->comment('削除日時');
        });
        // イベント情報
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('site_id')->unsigned()->comment('サイトID');
            $table->string('event_code', 191)->comment('イベントコード');
            $table->tinyInteger('event_status')->unsigned()->default(0)->comment('イベントステータス');
            $table->string('event_name', 191)->comment('イベント名');
            $table->string('event_url', 255)->comment('イベントURL');
            $table->date('event_date')->comment('イベント日');
            $table->date('open')->nullable()->comment('開場時間');
            $table->date('close')->nullable()->comment('終了時間');
            $table->dateTime('sales_start')->nullable()->comment('販売開始日時');
            $table->dateTime('sales_end')->nullable()->comment('販売終了日時');
            $table->string('pref', 191)->nullable()->comment('都道府県');
            $table->string('place', 191)->nullable()->comment('会場');
            $table->string('distributor', 191)->nullable()->comment('主催者');
            $table->timestamp('created_at')->useCurrent()->comment('作成日時');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate()->comment('更新日時');
            $table->timestamp('deleted_at')->nullable()->comment('削除日時');
        });
        // イベントアイドル情報
        Schema::create('event_idols', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id')->unsigned()->comment('イベントID');
            $table->integer('idol_id')->unsigned()->comment('アイドルID');
            $table->timestamp('created_at')->useCurrent()->comment('作成日時');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate()->comment('更新日時');
            $table->timestamp('deleted_at')->nullable()->comment('削除日時');
        });
        // サインアップ情報
        Schema::create('signups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 255)->comment('認証メールアドレス');
            $table->string('auth_code', 40)->comment('認証コード');
            $table->dateTime('issued_at')->comment('発行日時');
            $table->timestamp('created_at')->useCurrent()->comment('作成日時');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate()->comment('更新日時');
            $table->timestamp('deleted_at')->nullable()->comment('削除日時');
        });
        // ユーザー情報
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('user_status')->unsigned()->default(0)->comment('ユーザーステータス');
            $table->string('user_name', 191)->comment('ユーザー名');
            $table->string('email', 255)->comment('メールアドレス');
            $table->string('password', 40)->comment('パスワード');
            $table->dateTime('last_login_at')->nullable()->comment('最終ログイン日時');
            $table->tinyInteger('login_failed_count')->unsigned()->default(0)->comment('ログイン失敗回数');
            $table->timestamp('created_at')->useCurrent()->comment('作成日時');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate()->comment('更新日時');
            $table->timestamp('deleted_at')->nullable()->comment('削除日時');
        });
        // ユーザーお気に入り情報
        Schema::create('user_favorites', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->comment('ユーザーID');
            $table->integer('idol_id')->unsigned()->comment('アイドルID');
            $table->timestamp('created_at')->useCurrent()->comment('作成日時');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate()->comment('更新日時');
            $table->timestamp('deleted_at')->nullable()->comment('削除日時');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // ====================
        // テーブル削除
        // ====================
        Schema::dropIfExists('idols');
        Schema::dropIfExists('sites');
        Schema::dropIfExists('events');
        Schema::dropIfExists('event_idols');
        Schema::dropIfExists('signups');
        Schema::dropIfExists('users');
        Schema::dropIfExists('user_favorites');
    }
};
