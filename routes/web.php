<?php

use App\Http\Controllers\AuthController;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Welcome
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Blog
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/main', function () {
        $posts = Post::with('user')->latest()->get();
        return view('main', compact('posts'));
    })->name('main');

    Route::post('/main', function (Request $request) {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
        ]);

        $request->user()->posts()->create($validated);

        return redirect()->route('main')->with('success', 'Post created!');
    })->name('post.store');

    Route::get('/post/{post}', function (Post $post) {
        return view('blog/post', compact('post'));
    })->name('post.show');
});

/*
|--------------------------------------------------------------------------
| Account
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/account', function () {
        return view('account');
    })->name('account');

    Route::post('/account/avatar', function (Request $request) {
        $request->validate(['avatar' => ['required', 'image', 'max:2048']]);

        $path = $request->file('avatar')->store('avatars', 'public');
        $request->user()->update(['avatar' => $path]);

        return back()->with('success', 'Avatar updated!');
    })->name('account.avatar');
});

/*
|--------------------------------------------------------------------------
| Shop
|--------------------------------------------------------------------------
*/

Route::get('/shop', function () {
    $products = Product::with(['category', 'images'])
        ->where('is_active', true)
        ->get();
    return view('shop/shop', compact('products'));
})->name('shop');

Route::get('/product/{product:slug}', function (Product $product) {
    $product->load(['category', 'images', 'variants']);
    return view('shop/product', compact('product'));
})->name('product');

/*
|--------------------------------------------------------------------------
| Cart
|--------------------------------------------------------------------------
*/

Route::get('/cart', function () {
    return view('shop/cart');
})->name('cart');

Route::post('/cart/add/{product}', function (Product $product) {
    $cartItem = \App\Models\CartItem::where('user_id', auth()->id())
        ->where('product_id', $product->id)
        ->first();

    if ($cartItem) {
        $cartItem->increment('quantity');
    } else {
        \App\Models\CartItem::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'quantity' => 1,
        ]);
    }
    return back()->with('success', 'Product added to cart!');
})->middleware('auth')->name('cart.add');

Route::get('/cart', function () {
    $cartItems = \App\Models\CartItem::with('product')
        ->where('user_id', auth()->id())
        ->get();
    return view('shop/cart', compact('cartItems'));
})->middleware('auth')->name('cart');

Route::delete('/cart/remove/{cartItem}', function (\App\Models\CartItem $cartItem) {
    if ($cartItem->user_id !== auth()->id()) {
        abort(403);
    }
    $cartItem->delete();
    return back()->with('success', 'Product removed from cart.');
})->middleware('auth')->name('cart.remove');
