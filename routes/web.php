<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\DesignerController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/privacy', function () {
    return view('privacy');
});


Route::get('auth/{provider}', [SocialController::class,'redirectToProvider'])->name('social.login');
Route::get('auth/{provider}/callback', [SocialController::class,'handleProviderCallback']);

Route::get('user/signup', [SocialController::class, 'completeSignup'])->name('user.signup');
Route::post('user/signup/store', [SocialController::class, 'SignupStore'])->name('user.signup.store');

Route::any('user/checkphoneunique', [SocialController::class, 'checkphoneunique'])->name('users.checkphoneunique');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::get('client/projects', [ClientController::class, 'index'])->name('client.projects');
Route::get('client/projects/create', [ClientController::class, 'create'])->name('client.projects.add');
Route::post('client/projects/store', [ClientController::class, 'store'])->name('client.projects.store');
Route::post('client/projects/changestatus', [ClientController::class, 'changestatus'])->name('client.projects.changestatus');
Route::get('client/projects/viewhistory/{id?}', [ClientController::class, 'viewhistory'])->name('client.projects.viewhistory');
Route::post('client/projects/addnotes/{id?}', [ClientController::class, 'addnotes'])->name('client.projects.addnotes');


Route::get('designer/projects', [DesignerController::class, 'index'])->name('designer.projects');
Route::get('designer/projects/viewhistory/{id?}', [DesignerController::class, 'viewhistory'])->name('designer.projects.viewhistory');
Route::post('designer/projects/addnotes/{id?}', [DesignerController::class, 'addnotes'])->name('designer.projects.addnotes');

