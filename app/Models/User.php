<?php
namespace App\Models;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable {
    use HasApiTokens, HasFactory, HasProfilePhoto, Notifiable, TwoFactorAuthenticatable;
    protected $fillable = ['name','email','password','academic_year','monthly_allowance','saving_goal','is_admin'];
    protected $hidden = ['password','remember_token','two_factor_recovery_codes','two_factor_secret'];
    protected $appends = ['profile_photo_url'];
    protected function casts(): array {
        return ['email_verified_at'=>'datetime','password'=>'hashed','monthly_allowance'=>'decimal:2','saving_goal'=>'decimal:2','is_admin'=>'boolean'];
    }
    public function transactions(){ return $this->hasMany(Transaction::class); }
    public function categories(){ return $this->hasMany(Category::class); }
    public function budgets(){ return $this->hasMany(Budget::class); }
}