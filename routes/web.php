<?php

use App\Http\Controllers\AuthController;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/main', function () {
    $posts = Post::with('user')->latest()->get();
    return view('main', compact('posts'));
})->middleware('auth')->name('main');

Route::post('/main', function (Request $request) {
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'content' => ['required', 'string'],
    ]);

    $request->user()->posts()->create($validated);

    return redirect()->route('main')->with('success', 'Post created!');
})->middleware('auth')->name('post.store');

Route::get('/post/{post}', function (Post $post) {
    return view('blog/post', compact('post'));
})->middleware('auth')->name('post.show');

Route::get('/account', function () {
    return view('account');
})->middleware('auth')->name('account');

Route::post('/account/avatar', function (Request $request) {
    $request->validate(['avatar' => ['required', 'image', 'max:2048']]);

    $path = $request->file('avatar')->store('avatars', 'public');
    $request->user()->update(['avatar' => $path]);

    return back()->with('success', 'Avatar updated!');
})->middleware('auth')->name('account.avatar');

Route::get('/shop', function () {
    return view('shop/shop');
})->name('shop');

Route::get('/shop', function () {
    $products = \App\Models\Product::with(['category', 'images'])
        ->where('is_active', true)
        ->get();
    return view('shop/shop', compact('products'));
})->name('shop');

Route::get('/product/{product:slug}', function (\App\Models\Product $product) {
    $product->load(['category', 'images', 'variants']);
    return view('shop/product', compact('product'));
})->name('product');

Route::get('/cart', function () {
    return view('shop/cart');
})->name('cart');

// Auth
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
