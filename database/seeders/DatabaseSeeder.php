<?php
namespace Database\Seeders;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        $admin=User::updateOrCreate(['email'=>'admin@campuscoin.test'],[
            'name'=>'Campus Coin Admin','email_verified_at'=>now(),'password'=>Hash::make('Admin@12345'),
            'academic_year'=>'Administrator','monthly_allowance'=>0,'saving_goal'=>0,'is_admin'=>true,
        ]);
        $student=User::updateOrCreate(['email'=>'student@campuscoin.test'],[
            'name'=>'Demo Student','email_verified_at'=>now(),'password'=>Hash::make('Student@12345'),
            'academic_year'=>'2026','monthly_allowance'=>25000,'saving_goal'=>5000,'is_admin'=>false,
        ]);
        foreach(['Allowance','Part-time Job','Scholarship','Gift','Other Income'] as $n) Category::firstOrCreate(['name'=>$n,'type'=>'income','user_id'=>null],['is_default'=>true]);
        foreach(['Food','Transport','Hostel/Rent','Academics','Subscriptions','Entertainment','Miscellaneous'] as $n) Category::firstOrCreate(['name'=>$n,'type'=>'expense','user_id'=>null],['is_default'=>true]);
        if ($student->transactions()->count() === 0) {
            $food=Category::where('name','Food')->whereNull('user_id')->first();
            $transport=Category::where('name','Transport')->whereNull('user_id')->first();
            $allowance=Category::where('name','Allowance')->whereNull('user_id')->first();
            $student->transactions()->createMany([
                ['category_id'=>$allowance->id,'amount'=>25000,'type'=>'income','description'=>'Monthly allowance','date'=>now()->startOfMonth()],
                ['category_id'=>$food->id,'amount'=>1800,'type'=>'expense','description'=>'Campus cafe and lunch','date'=>now()->subDays(4)],
                ['category_id'=>$transport->id,'amount'=>900,'type'=>'expense','description'=>'Bus and ride fare','date'=>now()->subDays(2)],
            ]);
        }
    }
}