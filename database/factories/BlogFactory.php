<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Blog;
use Faker\Generator as Faker;
use App\Models\Category;
use Illuminate\Support\Str;

$factory->define(Blog::class, function (Faker $faker) {
    return [
        'blog_title' => ucfirst($faker->text(50)),
        'category_id' => Category::all()->random(),
        'slug' => Str::slug($faker->text(10)),
        'blog_description' => $faker->text(100),
        'image'         =>  str_replace("storage/uploads/blog\\", "", ltrim(strstr($faker->image('public/storage/uploads/blog',  640, 480, null, true), "/"),  "/"))
    ];
});
