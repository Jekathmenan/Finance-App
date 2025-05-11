<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransfersController;
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
 * Routes required to perform crud operations on Accounts.
 */
Route::group(['middleware'=>'auth'], function () {
    // Accounts
    Route::get('/accounts', [AccountsController::class, 'create'])->name('accounts');
    Route::get('/account/new', [AccountsController::class, 'edit'])->name('account.edit');
    Route::get('/account/{id}', [AccountsController::class, 'edit'])->name('account.edit');

    Route::post('/account', [AccountsController::class, 'store'])->name('account.store');
    Route::patch('/account/{account}', [AccountsController::class, 'update'])->name('account.update');
    Route::delete('/account/{account}', [AccountsController::class, 'destroy'])->name('account.delete');
});

/**
 * Routes required to perform crud operations on TransferCategories.
 */
Route::group(['middleware'=>'auth'], function () {
    // Accounts
    Route::get('/categories', [CategoryController::class, 'create'])->name('categories');
    Route::get('/category/new', [CategoryController::class, 'edit'])->name('category.edit');
    Route::get('/category/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    
    Route::get('/category/new', [AccountsController::class, 'edit'])->name('category.edit');
    Route::get('/category/{id}', [AccountsController::class, 'edit'])->name('category.edit');
    /*
    Route::post('/category', [AccountsController::class, 'store'])->name('category.store');
    Route::patch('/category/{category}', [AccountsController::class, 'update'])->name('category.update');
    Route::delete('/category/{category}', [AccountsController::class, 'destroy'])->name('category.delete');
    */
    

});

/**
 * Routes required to perform crud operations on Transactions.
 */
Route::group(['middleware'=>'auth'], function () {
    // Transactions
    Route::get('/transfers', [TransfersController::class, 'index'])->name('transfers');
    Route::get('/transfer/new', [TransfersController::class, 'edit'])->name('transfers.new');
    Route::get('/transfer/{id}', [TransfersController::class, 'edit'])->name('transfers.edit');

    Route::post('/transfer', [TransfersController::class, 'store'])->name('transfer.store');
    Route::patch('/transfer/{transfer}', [TransfersController::class, 'update'])->name('transfer.update');
    Route::delete('/transfer/{transfer}', [TransfersController::class, 'destroy'])->name('transfer.delte');
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
 * Admin panel Routes
 */
Route::middleware(['auth'])->group(function () {
    // Profile where user can change password, enter his data and maybe view dashboards
    Route::post('/logout', [SessionController::class, 'destroy'])->name('logout')->middleware('auth');
});

