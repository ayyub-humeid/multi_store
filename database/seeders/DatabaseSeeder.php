<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\Admin::factory(5)->create();
        Admin::create([
            'name'=> 'mohamed Humid',
            'username'=>'moh_humeid7',
            'email'=> 'moh@app.com',
            'password'=> Hash::make(123456789),
            'phone_number'=> '0595137707' ,
            'is-super-admin'=>true
        ]);
        Admin::create([
            'name'=> 'Ayyub Humid',
            'username'=>'Ay_humeid7',
            'email'=> 'ayyub@app.com',
            'password'=> Hash::make(123456789),
            'phone_number'=> '0592356462' ,
            'is-super-admin'=>false
        ]);
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // Store::factory(5)->create();
        // Category::factory(10)->create();
        // Product::factory(100)->create();
        // Store::factory(5)->create();
        // Category::factory(10)->create();
        // Product::factory(100)->create();
        // Store::create([
        //     'name'=> 'Store1',
        //     'slug'=> Str::slug('store1')
        // ]);
        // Store::create([
        //     'name'=> 'Store2',
        //     'slug'=> Str::slug('store2')
        // ]);
        // Store::create([
        //     'name'=> 'Store3',
        //     'slug'=> Str::slug('store3')
        // ]);
        // Store::create([
        //     'name'=> 'Store4',
        //     'slug'=> Str::slug('store4')
        // ]);
        // Store::create([
        //     'name'=> 'Store5',
        //     'slug'=> Str::slug('store5')
        // ]);,
        // Category::factory(10)->create();
        // for ($i=0; $i < 100; $i++) {

        //         Product::create([
        //             'name'=> 'product'.$i,
        //             'slug'=>Str::slug("product$i"),
        //             'price'=> rand(1,20),
        //             'compare_price'=>rand(22,400),
        //             'store_id'=> Store::inRandomOrder()->first()->id,
        //             'category_id'=> Category::inRandomOrder()->first()->id
        //         ]);

        // }
        // User::create([
            // 'name'=>'mohammed humeid',
            // 'email'=>'moh@gmail.com',
            // 'password'=>Hash::make(123456789),
            // 'phone_number'=>'05923123213',
        //     'store_id'=>Store::inRandomOrder()->first()->id
        // ]);
        // User::create([
        //     'name'=>'Ahmad Ali',
        //     'email'=>'ahmad@gmail.com',
        //     'password'=>Hash::make(123456789),
        //     'phone_number'=>'05923123224',
        //     'store_id'=>Store::inRandomOrder()->first()->id
        // ]);
        // User::create([
        //     'name'=>'Sami saleh',
        //     'email'=>'sami@gmail.com',
        //     'password'=>Hash::make(123456789),
        //     'phone_number'=>'0592312354',
        //     'store_id'=>Store::inRandomOrder()->first()->id
        // ]);
        // Product::create([
        //      'name'=> 'shawmi8',
        //             'slug'=>Str::slug("shawmi8"),
        //             'price'=> 50,
        //             'compare_price'=>70,
        //             'store_id'=> ,
        //             'category_id'=> Category::inRandomOrder()->first()->id
        // ]);
        //   User::create([
        //     'name'=> 'Ayyub2',
        //     'store_id',2,
        //     'email'=>'ay@app.com',
        //     'password'=>Hash::make(123456789),
        //     'type'=>'admin'
        // ]);

    }
}