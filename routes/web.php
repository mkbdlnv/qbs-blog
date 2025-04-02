<?php


use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentLikeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


Auth::routes(['verify' => true]);


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/profile', [UserController::class, 'index'])->name('profile');


    Route::get('/posts', [PostController::class, 'getPosts'])->name('posts');
    Route::post('/posts/{post}/like', [LikeController::class, 'like'])->name('posts.like');
    Route::post('/posts/{post}/unlike', [LikeController::class, 'unlike'])->name('posts.unlike');
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/posts/{post}/comments', [CommentController::class, 'getComments'])->name('comments.get');

    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::post('/comments/{id}/like', [CommentLikeController::class, 'toggleLike'])->name('comments.toggleLike');

    Route::put('/users', [UserController::class, 'update'])->name('user.update');
    Route::get('/users/confirm-old-email/{token}', [UserController::class, 'confirmOldEmail'])->name('verify.old.email');
    Route::get('/users/confirm-new-email/{token}', [UserController::class, 'confirmNewEmail'])->name('verify.new.email');

    Route::post('/toggle-subscription', [SubscriptionController::class, 'toggleSubscription'])->name('toggle.subscription');

    Route::get('/tags', function () {
        return Tag::all()->map(function ($tag) {
            return [
                'id' => $tag->id,
                'name' => $tag->name,
                'translated_name' => match (app()->getLocale()) {
                    'kz' => $tag->name_kz ?: $tag->name,
                    'en' => $tag->name_en ?: $tag->name,
                    default => $tag->name, // по умолчанию — русский
                },
            ];
        });
    });
});

Route::get('/set-locale/{locale}', function ($locale) {
    App::setLocale($locale);
    Session::put('locale', $locale);
    return redirect()->back();
})->name('set-locale');


//Route::middleware('auth')->group(function () {
//    Route::post('/posts/{post}/like', [LikeController::class, 'like'])->name('posts.like');
//    Route::post('/posts/{post}/unlike', [LikeController::class, 'unlike'])->name('posts.unlike');
//    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
//    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
//    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
//    Route::post('/comments/{id}/like', [CommentLikeController::class, 'toggleLike'])->name('comments.toggleLike');
//
//    Route::put('/users', [UserController::class, 'update'])->name('user.update');
//    Route::get('/users/confirm-old-email/{token}', [UserController::class, 'confirmOldEmail'])->name('verify.old.email');
//    Route::get('/users/confirm-new-email/{token}', [UserController::class, 'confirmNewEmail'])->name('verify.new.email');
//
//    Route::post('/toggle-subscription', [SubscriptionController::class, 'toggleSubscription'])->name('toggle.subscription');
//});
