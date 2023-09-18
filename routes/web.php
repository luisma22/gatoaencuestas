<?php

use App\Http\Livewire\Auth\ForgotPassword;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\ResetPassword;
use App\Http\Livewire\Billing;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Principal;
use App\Http\Livewire\ExampleLaravel\UserManagement;
use App\Http\Livewire\ExampleLaravel\UserProfile;
use App\Http\Livewire\Notifications;
use App\Http\Livewire\Profile;
use App\Http\Livewire\RTL;
use App\Http\Livewire\Encuestas;
use App\Http\Livewire\Preguntas;
use App\Http\Livewire\Encuestados;
use App\Http\Livewire\Encuestar;
use App\Http\Livewire\Estadisticas;
use App\Http\Livewire\Encuestapdf;
use App\Http\Livewire\Gracias;
use App\Http\Livewire\StaticSignIn;
use App\Http\Livewire\StaticSignUp;
use App\Http\Livewire\Tables;
use App\Http\Livewire\VirtualReality;
use GuzzleHttp\Middleware;

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

Route::get('/', function(){
    return redirect('sign-in');
});

Route::get('forgot-password', ForgotPassword::class)->middleware('guest')->name('password.forgot');
Route::get('reset-password/{id}', ResetPassword::class)->middleware('signed')->name('reset-password');



Route::get('sign-up', Register::class)->middleware('guest')->name('register');
Route::get('sign-in', Login::class)->middleware('guest')->name('login');
Route::get('encuestarinfo/{id}', Encuestar::class)->middleware('guest')->name('encuestar');
Route::get('encuestapdfinfo/{id}/{id2}/{position}/{indice}', [Encuestapdf::class, 'pdf'])->middleware('guest')->name('encuestapdfinfo.pdf');
Route::get('user-profile', UserProfile::class)->middleware('auth')->name('user-profile');
Route::get('gracias', Gracias::class)->name('gracias');
Route::get('user-management', UserManagement::class)->middleware('auth')->name('user-management');

Route::group(['middleware' => 'auth'], function () {
Route::get('principal', Principal::class)->name('principal');
Route::get('billing', Billing::class)->name('billing');
Route::get('profile', Profile::class)->name('profile');
Route::get('tables', Tables::class)->name('tables');
Route::get('notifications', Notifications::class)->name("notifications");
Route::get('virtual-reality', VirtualReality::class)->name('virtual-reality');
Route::get('static-sign-in', StaticSignIn::class)->name('static-sign-in');
Route::get('static-sign-up', StaticSignUp::class)->name('static-sign-up');
Route::get('encuestas', Encuestas::class)->name('encuestas');
Route::get('preguntas', Preguntas::class)->name('preguntas');
Route::get('encuestar/{id}', Encuestar::class)->name('encuestar');
Route::get('encuestados/{id}', Encuestados::class)->name('encuestados');
Route::get('estadisticas/{id}', Estadisticas::class)->name('estadisticas');
Route::get('encuestapdf/{id}/{id2}/{position}/{indice}', [Encuestapdf::class, 'pdf'])->name('encuestapdf.pdf');
});