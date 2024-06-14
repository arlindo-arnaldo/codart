<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\Medias\MediaController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Livewire\Modal\UploadFile;


Route::prefix('/admin')->name('admin.')->group(function(){
    Route::middleware('auth:web')->group(function(){
        Route::view('/dashboard', 'admin.pages.home')->name('home');
        Route::post('/logout', [AuthorController::class, 'logout'])->name('logout');
        Route::post('/change-profile-picture', [AuthorController::class, 'changeProfilePicture'])->name('change-profile-picture');

        /*Rota para Administradores*/
        Route::middleware('isAdmin')->group( function(){
            /*Rota para gerir usuarios */
            Route::prefix('users')->name('users.')->group( function(){
                Route::view('/', 'admin.pages.users.users')->name('users');
                Route::view('new-user', 'admin.pages.users.new-user')->name('create-user');
                Route::get('edit-user/{id}', [AuthorController::class, 'editUser'])->name('edit-user');
                
            });
        });

        Route::view('profile', 'admin.pages.users.profile')->name('users.profile');

        /*Rota para gerir posts */
        Route::prefix('/posts')->name('posts.')->group( function(){
            Route::view('/', 'admin.pages.posts.posts')->name('posts');
            Route::view('new-post', 'admin.pages.posts.new-post')->name('new-post');
            Route::get('edit-post/{id}', [PostController::class, 'editPost'])->name('edit-post');
            Route::view('categories', 'admin.pages.posts.categories')->name('categories')->middleware('isAdmin');
            Route::post('save-post', [PostController::class, 'savePost'])->name('save-post');
            Route::post('delete-post/{id}', [PostController::class, 'deletePost'])->name('delete-post');
            Route::post('update-post/{id}', [PostController::class, 'updatePost'])->name('update-post');
            Route::post('restore-post/{id}', [PostController::class, 'restorePost'])->name('restore-post');

        });

        /*Rota para gerir as multimedias */
        Route::prefix('/medias')->name('medias.')->group( function(){
            Route::view('/', 'admin.pages.medias.medias')->name('medias');
            Route::view('new-media', 'admin.pages.medias.new-media')->name('new-media');
            Route::post('upload-media', [MediaController::class, 'uploadMedia'])->name('upload-media');

            Route::post('upload-media-modal', [UploadFile::class, 'upload'])->name('upload-media-modal');
        });

        /*Rota para gerir comentários */
        Route::prefix('/comments')->name('comments.')->group( function(){
            Route::view('/', 'admin.pages.comments.comments')->name('comments');
        });
    });
    
    /** Rotas para usuarios não logados */
    Route::middleware('guest')->group(function(){
        Route::view('/login', 'admin.pages.auth.login')->name('login');
        Route::view('/reset-password', 'admin.pages.auth.reset-password')->name('reset-password');
    });
});

Route::view('/403', 'admin.errors.403')->name('403');
Route::view('/wizard', 'admin.pages.wizard.wizard')->name('wizard');