<?php


use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentLikeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Auth::routes(['verify' => true]);


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/profile', [App\Http\Controllers\UserController::class, 'index'])->name('profile');


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
        return response()->json(Tag::all());
    });
});

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
