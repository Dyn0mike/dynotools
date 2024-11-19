<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Controllers\MoonsController;
use App\Http\Controllers\MoonReqController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ProviderController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BuyController;
use App\Http\Controllers\EscalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::post('/admin', [AdminController::class, 'reprice'])->name('admin.reprice');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
 
    $status = Password::sendResetLink(
        $request->only('email')
    );
 
    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);
 
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
 
            $user->save();
 
            event(new PasswordReset($user));
        }
    );
 
    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');

/*Route::get('/auth/redirect', function () {
    return Socialite::driver('eveonline')->redirect();
});

Route::get('/auth/callback', function () {
    $user = Socialite::driver('eveonline')->user();
 
    // $user->token
});*/

Route::get('/auth/redirect', [ProviderController::class, 'redirect']);

Route::get('/auth/callback', [ProviderController::class, 'callback']);

Route::get('/moons', [MoonsController::class, 'index'])->name('moons');
Route::post('/moons', [MoonsController::class, 'filterMoons'])->name('moons.filterMoons');

Route::get('/escal', [EscalController::class, 'index'])->name('escal');

Route::get('/buy', [BuyController::class, 'index'])->name('buy');
Route::post('/buy', [BuyController::class, 'store']);
Route::delete('/buy/{id}', [BuyController::class, 'delete'])->name('buy.destroy');
Route::put('/buy/', [BuyController::class, 'edit'])->name('buy.edit');

Route::get('/mReq/{id}', [MoonReqController::class, 'show']);
Route::post('/mReq/{id}', [MoonReqController::class, 'store'])->name('mReq');

