<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransfersController;
use App\Http\Controllers\CoredataController;
use App\Models\Account;

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

// Not Logged in Routes
Route::middleware(['guest'])->group(function () {
    // TODO: Admin panel to manage personal info and change password
    // TODO: Implement 2-FA for Users

    // login routes
    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store'])->name('login');

    // Forgot Password option
    Route::get('/forgotpassword', [SessionController::class, 'resetPassword'])->name('forgotpassword'); // not implemented correctly

    // register routes
    Route::get('register', [RegisterController::class, 'create'])
        ->name('register');
    Route::post('register', [RegisterController::class, 'store'])
        ->name('register');
});

/**
 * Routes required to perform crud operations on core data.
 */
Route::group(['middleware' => 'auth'], function () {
    // Coredata management page
    Route::get('/core-data', [CoredataController::class, 'create'])->name('core-data');

    // Todo: Implement a core data management page where each of the core data (categories, accounts and transfertypes) can be managed 


    // Todo: Migrate all the coredata controller into CoredataController

    // Accounts
    Route::get('/accounts', [AccountsController::class, 'create'])->name('accounts');
    Route::get('/account/new', [AccountsController::class, 'edit'])->name('account.edit');
    Route::get('/account/{id}', [AccountsController::class, 'edit'])->name('account.edit');

    Route::post('/account', [AccountsController::class, 'store'])->name('account.store');
    Route::patch('/account/{account}', [AccountsController::class, 'update'])->name('account.update');
    Route::delete('/account/{account}', [AccountsController::class, 'destroy'])->name('account.delete');

    // Categories
    Route::get('/categories', [CategoryController::class, 'create'])->name('categories');
    Route::get('/category/new', [CategoryController::class, 'edit'])->name('category.edit');
    Route::get('/category/{id}', [CategoryController::class, 'edit'])->name('category.edit');

    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');

    Route::patch('/category/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/{category}', [CategoryController::class, 'destroy'])->name('category.delete');

    // Transfertypes
    Route::get('/transfer-types', [CoredataController::class, 'createTransferTypes'])->name('transfer-types');
    Route::get('/transfer-type/new', [CoredataController::class, 'editTransferTypes'])->name('transfer-types.edit');
    Route::get('/transfer-type/{id}', [CoredataController::class, 'editTransferTypes'])->name('transfer-types.edit');

    Route::post('/transfer-type', [CoredataController::class, 'storeTransferType'])->name('transfer-type.store');
    Route::patch('/transfer-type/{transferType}', [CoredataController::class, 'updateTransferType'])->name('transfer-type.update');
    Route::delete('/transfer-type/{transferType}', [CoredataController::class, 'destroyTransferType'])->name('transfer-type.delete');
});

/**
 * Routes required to perform crud operations on Transactions.
 */
Route::group(['middleware' => 'auth'], function () {
    // Transactions
    // TODO: Rename this to transactions
    Route::get('/transfers', [TransfersController::class, 'index'])->name('transfers');
    Route::get('/transfer/new', [TransfersController::class, 'edit'])->name('transfers.new');
    Route::get('/transfer/{id}', [TransfersController::class, 'edit'])->name('transfers.edit');

    Route::post('/transfer', [TransfersController::class, 'store'])->name('transfer.store');
    Route::patch('/transfer/{transfer}', [TransfersController::class, 'update'])->name('transfer.update');
    Route::delete('/transfer/{transfer}', [TransfersController::class, 'destroy'])->name('transfer.delte');
});

/**
 * Admin user Routes
 */
Route::middleware(['admin'])->group(function () {
    // Page where admin user can set certain rules e.g. user management
    Route::get('/admin-panel', [AdminPanelController::class, 'createAdminPanel'])->name('admin-panel');

    Route::get('/users', [AdminPanelController::class, 'showUsers'])->name('users');
    Route::get('/user/new', [AdminPanelController::class, 'editUser'])->name('user.new');
    Route::get('/user/{id}', [AdminPanelController::class, 'editUser'])->name('user.edit');

    Route::post('/user', [AdminPanelController::class, 'storeUser'])->name('user.store');
    Route::patch('/user/{user}', [TransfersController::class, 'updateUser'])->name('user.update');
});

Route::group(['middleware' => 'auth'], function () {
    // Transactions
    // Default Transactionspage
    // Here are all Transactions listed (grouped by Date)
    // Each Transaction is clickable and on Click a PopUp-Component is loaded with the clicked transactions data
    // There are 3 transaction types INCOME, EXPENSE, TRANSFER --> Income and Expense concern one account only and do either add or subtract the given amount to/from the account
    /*
        
        Table structure: 
            transactions:
                transaction_type : int
                date
                Repeat : repeat_id
                Amount : int (in cents)
                fees : int (in cents)
                category_id
                FromAccount: account_id
                ToAccount: account_id
                Note: Text
                Description: longtext
            
            Repeat (unfixed amt. of months): 
                RepeatPeriod: text
                repeatamount: int
            
            Installment (fixed amt. of months):
                InstallmentPeriod: monthly

        */
});

/**
 * Profile related routes
 */
Route::middleware(['auth'])->group(function () {
    // Profile where user can change password, enter his data and maybe view dashboards
    Route::post('/logout', [SessionController::class, 'destroy'])->name('logout')->middleware('auth');

    // Dashboard: Total balances across accounts, recent transfers, maybe a chart.
});
