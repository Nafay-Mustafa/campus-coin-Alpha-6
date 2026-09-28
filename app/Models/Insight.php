<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Insight extends Model {protected $fillable=['user_id','month','summary_text','tip_text'];protected $casts=['month'=>'date'];public function user(){return $this->belongsTo(User::class);}}
