<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\isUser;
use App\Http\Middleware\isEditor;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', isUser::class])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::get('/contact', function () {
    return view('partials.contact');
});
Route::get('/about', function () {
    return view('partials.about');
});

Route::get('/admin', function () {
    return view('admin.index');
})->middleware(['auth', 'verified', isUser::class])->name('admin.index');


Route::get('/', [ProductController::class, "index"])->name('home');
Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');

Route::get('/product/{product_id}', [ProductController::class, "show"])->name('product.show');
Route::get('/contact', [ProductController::class, "contact"])->name('contact');
Route::get('/about', [ProductController::class, "about"])->name('about');


Route::middleware(['auth', isUser::class])->group(function () {
    
    Route::prefix('admin/products')->name('admin.products.')->group(function () {
        Route::get('/', [ProductController::class, 'list'])->name('list');
        Route::get('/create', action: [ProductController::class, 'create'])->name('create')->middleware(['auth', 'verified', isEditor::class]);;
        Route::post('/insert', [ProductController::class, 'insert'])->name('insert')->middleware(['auth', 'verified', isEditor::class]);;
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [ProductController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [ProductController::class, 'delete'])->name('delete')->middleware(['auth', 'verified', isEditor::class]);;
    });
});


Route::middleware(['auth', isUser::class])->group(function () {
    Route::prefix('admin/orders')->name('admin.orders.')->group(function () {
        Route::get('/', [OrdersController::class, 'list'])->name('list');
        Route::get('/create', action: [OrdersController::class, 'create'])->name('create')->middleware(['auth', 'verified', isEditor::class]);
        Route::post('/insert', [OrdersController::class, 'insert'])->name('insert')->middleware(['auth', 'verified', isEditor::class]);;
        Route::get('/edit/{id}', [OrdersController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [OrdersController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [OrdersController::class, 'delete'])->name('delete')->middleware(['auth', 'verified', isEditor::class]);
    });
    
});


Route::middleware(['auth', isUser::class])->prefix('admin/comments')->name('admin.comments.')->group(function () {
    Route::get('/', [CommentController::class, 'list'])->name('list');
    Route::get('/create', [CommentController::class, 'create'])->name('create')->middleware(['auth', 'verified', isEditor::class]);;
    Route::post('/insert', [CommentController::class, 'insert'])->name('insert')->middleware(['auth', 'verified', isEditor::class]);;
    Route::get('/edit/{id}', [CommentController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [CommentController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [CommentController::class, 'delete'])->name('delete')->middleware(['auth', 'verified', isEditor::class]);;
});



Route::post('/comments/{product}', [CommentController::class, 'store'])->name('comments.store');


Route::post('/orders/{product}', [OrdersController::class, 'store'])->name('orders.store');

Route::get('/admin', [OrdersController::class, 'ordersChart'])
    ->middleware(['auth', 'verified', isUser::class])
    ->name('admin.index');



