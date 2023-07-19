<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Backend\MenusController;
use App\Http\Controllers\Backend\CategoriesController;
use App\Http\Controllers\CustomerController;

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
Route::get('/about', function() {return Inertia::render('About');})->name('about.index');
Route::get('/', [LandingPageController::class, 'index'])->name('landing-page.index');
Route::post('/', [LandingPageController::class, 'store'])->name('landing-page.store');
Route::get('/menus', [MenuController::class, 'index'])->name('menus.index');
Route::get('/menu/{menu}', [MenuController::class, 'show'])->name('menu.show');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'initiate'])->name('checkout.initiate');
Route::get('/verify', [CheckoutController::class, 'paymentCallBack'])->name('checkout.callback');
Route::get('/contact', function() {return Inertia::render('Contact');})->name('contact.index');

// Dashboard layout pages
Route::get('/categories-favorites', [CategoriesController::class, 'index'])->name('categories-favorites.index');
Route::get('/categories-favorites/create', [CategoriesController::class, 'create'])->name('categories-favorites.create');
Route::post('/categories-favorites', [CategoriesController::class, 'store'])->name('categories-favorites.store');
Route::get('/categories-favorites/{category}/edit', [CategoriesController::class, 'edit'])
    ->name('categories-favorites.edit');
Route::put('/categories-favorites/{category}', [CategoriesController::class, 'update'])
    ->name('categories-favorites.update');
Route::delete('/categories-favorites/{category}', [MenusController::class, 'destroy'])
    ->name('categories-favorites.destroy');

Route::get('/users', [UsersController::class, 'index'])->name('users.index');
Route::get('/users/create', [UsersController::class, 'create'])->name('users.create');
Route::post('/users', [UsersController::class, 'store'])->name('users.store');

Route::get('/customer/login', [CustomerController::class, 'index'])->name('customer-login.index');
Route::get('/customer/register', [CustomerController::class, 'create'])->name('customer-register.create');
Route::post('/customer/register', [CustomerController::class, 'store'])->name('customer-register.store');

Route::get('/menus-list', [MenusController::class, 'index'])->name('menus-list.index');
Route::get('/menus-list/create', [MenusController::class, 'create'])->name('menus-list.create');
Route::post('/menus-list', [MenusController::class, 'store'])->name('menus-list.store');
Route::get('/menus-list/{menu}/edit', [MenusController::class, 'edit'])
    ->name('menus-list.edit');
Route::put('/menus-list/{menu}', [MenusController::class, 'update'])
    ->name('menus-list.update');

Route::delete('/menus-list/{menu}', [MenusController::class, 'destroy'])
    ->name('menus-list.destroy');
    // Route address
Route::get('/add-address', [AddressController::class, 'create'])
    ->name('address.create');
Route::post('/add-address', [AddressController::class, 'store'])
    ->name('address.store');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
