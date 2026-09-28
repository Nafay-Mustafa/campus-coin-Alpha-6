<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
 public function up(): void {
  Schema::create('insights',function(Blueprint $t){$t->id();$t->foreignId('user_id')->constrained()->cascadeOnDelete();$t->date('month');$t->text('summary_text');$t->text('tip_text')->nullable();$t->timestamps();$t->unique(['user_id','month']);});
  Schema::create('bookmarks',function(Blueprint $t){$t->id();$t->foreignId('user_id')->constrained()->cascadeOnDelete();$t->string('type')->default('tip');$t->string('title');$t->text('content');$t->timestamps();});
 }
 public function down(): void {Schema::dropIfExists('bookmarks');Schema::dropIfExists('insights');}
};