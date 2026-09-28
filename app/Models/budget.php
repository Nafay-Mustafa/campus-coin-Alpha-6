<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Budget extends Model {
    protected $table='budgets';
    protected $fillable=['user_id','category_id','month','limit_amount'];
    protected $casts=['month'=>'date','limit_amount'=>'decimal:2'];
    public function user(){return $this->belongsTo(User::class);}
    public function category(){return $this->belongsTo(Category::class);}
}