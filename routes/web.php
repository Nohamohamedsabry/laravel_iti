<?php
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\User\UserController;

Route::resource('posts', PostController::class)->middleware(['auth']);
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [PostController::class, 'index'])->name('posts.index')->middleware(['auth']);
Route::get('deleted/allOldPosts', [PostController::class,'deleteAllOldPosts'])->name('posts.deleteOldPosts')->middleware(['auth']);
Route::get('deleted/posts', [PostController::class,'deletedPosts'])->name('posts.deleted')->middleware(['auth']);
Route::delete('deleted/posts/{id}', [PostController::class,'deleteForEver'])->name('posts.deletePermently')->middleware(['auth']);
Route::post('restore/posts/{id}', [PostController::class,'restorePost'])->name('posts.restore')->middleware(['auth']);
Route::resource('users', UserController::class)->middleware('auth');

Route::get('/auth/github/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('auth.github');

Route::get('/auth/github/callback', function () {
    $githubUser = Socialite::driver('github')->user();
    $user = User::updateOrCreate([
        'email' => $githubUser->email,
    ], [
        'name' => $githubUser->nickname,
        'email' => $githubUser->email,
    ]);
    Auth::login($user);
    return redirect('/');
});


Route::get('/auth/google/redirect', function () {
    return Socialite::driver('google')->redirect();
})->name('auth.google');

Route::get('/auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->user();
    $user = User::updateOrCreate([
        'email' => $googleUser->email,
    ], [
        'name' => $googleUser->name,
        'email' => $googleUser->email,
    ]);
    Auth::login($user);
    return redirect('/');
});
