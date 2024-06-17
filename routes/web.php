<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::controller(BlogController::class)->group(function () {

    Route::get('/','index')->name('home');
    Route::get('/{slug}', 'show')->name('post.show');
    Route::get('/articles', 'showPosts')->name('articles');
    Route::get('/categories/{category_slug}/{subcategory_slug?}', 'showCategory')->name('category.show');
    
});

Route::get('/setup', function () {

    /*Cria os niveis de acesso*/
    $type = new \App\Models\Type();
    $type->name = 'Administrador';
    $type->save();

    $type = new \App\Models\Type();
    $type->name = 'Autor';
    $type->save();

    /* Cria o usuario admin*/

    $user = new \App\Models\User();
    $user->name = "Admin";
    $user->username = "admin";
    $user->email = "admin@gmail.com";
    $user->type = 1;
    $user->password = Hash::make('admin');
    $user->photo = 'default.jpg';
    $user->save();

    /* Cria a categoria padrao*/

    $category = new \App\Models\Category();
    $category->name = 'Sem categoria';
    $category->slug = 'sem-categoria';
    $category->save();

    return "Ambiente Configurado";
});
