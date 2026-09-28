<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Transaction extends Model {
    protected $fillable=['user_id','category_id','amount','type','description','ai_suggested_category','date','is_recurring','recurring_frequency'];
    protected $casts=['amount'=>'decimal:2','date'=>'date','is_recurring'=>'boolean'];
    public function user(){return $this->belongsTo(User::class);}
    public function category(){return $this->belongsTo(Category::class);}
    public function suggestedCategory(){return $this->belongsTo(Category::class,'ai_suggested_category');}
}