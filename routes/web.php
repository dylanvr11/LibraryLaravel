<?php

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ConfirmPasswordController;


Route::get('/test', function (){
    // return Role::all()->pluck('name');
    // $users = User::get();
    // foreach ($users as $user){
    //     if($user->number_id == 1093221111) $user->assignRole('admin');
    //     else $user->assignRole('user');
    // }
    //Role::create(['name' => 'user']);
});


Route::view('/', 'home');

Route::get('/',[BookController::class, 'showHomeWithBooks'])->name('home');

// Users
/*
sin los roles
Route::group(['prefix' => 'Users', 'controller' => UserController::class], function(){
    Route::get('/','showAllUsers')->name('users');
    Route::get('/CreateUser','showCreateUser')->name('user.create');
    Route::get('/EditUser/{user}','showEditUser')->name('user.edit');

    Route::post('/CreateUser','createUser')->name('user.create.post');
    Route::put('/EditUser/{user}','updateUser')->name('user.edit.put');
    Route::delete('/DeleteUser/{user}','deleteUser')->name('user.delete');
});
*/

Route::group(['prefix' => 'Users', 'middleware' => ['auth','role:admin',],
    'controller' => UserController::class], function(){
    Route::get('/','showAllUsers')->name('users');
    Route::get('/CreateUser','showCreateUser')->name('user.create');
    Route::get('/EditUser/{user}','showEditUser')->name('user.edit');

    Route::post('/CreateUser','createUser')->name('user.create.post');
    Route::put('/EditUser/{user}','updateUser')->name('user.edit.put');
    Route::delete('/DeleteUser/{user}','deleteUser')->name('user.delete');
});

// Books
Route::group(['prefix' => 'Books', 'middleware' => ['auth','role:admin'], 'controller' => BookController::class], function(){
    Route::get('/','showBooks')->name('books');
    //viene de la api
    Route::get('/GetAllBooks', 'getAllBooks');
    Route::get('/GetAllBooksDataTable', 'getAllBooksForDataTable'); //renderizado del datatable
    Route::get('/GetABook/{book}', 'getABook');
    Route::post('/SaveBook', 'saveBook');
    Route::post('/UpdateBook/{book}', 'updateBook');
    Route::delete('/DeleteABook/{book}', 'deleteBook');

});

Route::group(['prefix' => 'Categories', 'controller' => CategoryController::class], function(){
    Route::get('/GetAllCategories', 'getAllCategories');
});

Route::group(['prefix' => 'Authors', 'controller' => AuthorController::class], function(){
    Route::get('/GetAllAuthors', 'getAllAuthors');
});

// Auth -------------------

Route::group(['controller' => LoginController::class], function(){
    // Login Routes ...
    Route::get('login', 'showLoginForm')->name('login');
    Route::post('login', 'login');

    // Logout Routes ...
    Route::post('logout', 'logout')->name('logout');
});

// Regiter Routes ...

// Password reset Routes ...
Route::group(['controller' => ForgotPasswordController::class], function(){
    // Password Forgot Routes ...
    Route::get('password/reset', 'showLinkRequestForm')
    ->name('password.request');
    Route::post('password/email', 'sendResetLinkEmail')
        ->name('password.email');
});

Route::group(['controller' => ResetPasswordController::class], function(){
    // Password reset Routes ...
    Route::get('password/reset/{token}', 'showResetForm')
        ->name('password.reset');
    Route::post('password/reset', 'reset')
        ->name('password.update');
});

Route::group(['controller' => ConfirmPasswordController::class], function(){
    // Password Confirmation Routes ...
    Route::get('password/confirm', 'showConfirmForm')
        ->name('password.confirm');
    Route::post('password/confirm', 'confirm');
});

Route::group(['controller' => VerificationController::class], function(){
    // Email Verification Routes ...
    Route::get('email/verify', 'show')
        ->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', 'verify')
        ->name('verification.verify');
    Route::post('email/resend', 'resend')
        ->name('verification.resend');
});

