<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LendController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => 'Users', 'controller' => UserController::class], function(){
    Route::get('/GetAllUsers', 'getAllUsers'); //GET -> traer data
    Route::get('/GetAnUser/{user}', 'getAnUser'); //GET -> traer data
    Route::get('/GetAllLendsByUser/{user}', 'getAllLendsByUser');
    Route::get('/GetAllLendsByUser/{user}', 'getAllLendsByUser');
    Route::get('/GetAllUsersWithLends', 'getAllUsersWithLends');

    Route::post('/CreateUser', 'createUser');  //POST -> Cread data
    Route::put('/UpdateUser/{user}', 'updateUser'); //PUT -> Actualiza data
    Route::delete('/DeleteUser/{user}', 'deleteUser'); //DELETE -> Elimina data
});

Route::group(['prefix' => 'Lends', 'controller' => LendController::class], function(){
    Route::post('/CreateLend', 'createLend');
});


Route::group(['prefix' => 'Books', 'controller' => BookController::class], function(){
    Route::get('/GetAllBooks', 'getAllBooks');
    Route::post('/SaveBook', 'saveBook');
    //Route::get('/GetABook/{book}', 'getABook');

    //Route::post('/UpdateBook/{book}', 'updateBook');
});

Route::group(['prefix' => 'Categories', 'controller' => CategoryController::class], function(){
    Route::get('/GetAllCategories', 'getAllCategories');
});

Route::group(['prefix' => 'Authors', 'controller' => AuthorController::class], function(){
    Route::get('/GetAllAuthors', 'getAllAuthors');
});
/*
Route::get('/user', function(){
    return response()->json(['hola' => "hola"],200);
});
*/
