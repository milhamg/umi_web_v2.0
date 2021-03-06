<?php

use App\Models\MasterProvince;
use App\Models\FavoriteProduct;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\OpenHourController;
use App\Http\Controllers\API\AuthAPIController;
use App\Http\Controllers\API\CartAPIController;
use App\Http\Controllers\API\NewsAPIController;
use App\Http\Controllers\API\UserAPIController;
use App\Http\Controllers\API\EventAPIController;
use App\Http\Controllers\API\RatingAPIController;
use App\Http\Controllers\API\AddressAPIController;
use App\Http\Controllers\API\MasterBankController;
use App\Http\Controllers\API\ProductAPIController;
use App\Http\Controllers\API\BalancesAPIController;
use App\Http\Controllers\API\BusinessAPIController;
use App\Http\Controllers\API\DiscountAPIController;
use App\Http\Controllers\API\MidtransAPIController;
use App\Http\Controllers\API\OpenHourAPIController;
use App\Http\Controllers\API\MasterBankAPIController;
use App\Http\Controllers\API\MasterCityAPIController;
use App\Http\Controllers\API\MasterUnitAPIController;
use App\Http\Controllers\API\NotificationAPIController;
use App\Http\Controllers\API\MasterProvinceAPIController;
use App\Http\Controllers\MasterDeliveryServiceController;
use App\Http\Controllers\API\FavoriteProductAPIController;
use App\Http\Controllers\API\ProductCategoryAPIController;
use App\Http\Controllers\API\WithdrawBalanceAPIController;
use App\Http\Controllers\API\BusinessCategoryAPIController;
use App\Http\Controllers\API\CommentFeedAPIController;
use App\Http\Controllers\API\EventRegisterAPIController;
use App\Http\Controllers\API\FeedAPIController;
use App\Http\Controllers\API\LikeFeedAPIController;
use App\Http\Controllers\API\SalesTransactionAPIController;
use App\Http\Controllers\API\MasterSubDistrictAPIController;
use App\Http\Controllers\API\MasterProductCategoryAPIController;
use App\Http\Controllers\API\MasterBusinessCategoryAPIController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

#Master category business
Route::group(['prefix' => 'masterCategoryBusiness/'], function () {
    Route::get('get', [MasterBusinessCategoryAPIController::class, 'index']);
    Route::post('add', [MasterBusinessCategoryAPIController::class, 'store']);
    Route::delete('delete/{id}', [MasterBusinessCategoryAPIController::class, 'destroy']);
});
// master_delivery_serviceAPIController
Route::get('getMasterDeliveryService', [MasterDeliveryServiceController::class, 'index']);

// Master Province
Route::get('getMasterProvince', [MasterProvinceAPIController::class, 'index']);

// Master MasterCity
Route::get('getMasterCity', [MasterCityAPIController::class, 'index']);

// Master Sub District
Route::get('getSubDistrict', [MasterSubDistrictAPIController::class, 'index']);

Route::group(['prefix' => 'masterCategoryProduct'], function () {
    Route::get('/', [MasterProductCategoryAPIController::class, 'all']);
    Route::delete('/delete/{id}', [MasterProductCategoryAPIController::class, 'destroy']);
    // Route::post('update', [ProductAPIController::class, 'store']);
});

Route::group(['prefix' => 'categoryProduct'], function () {
    Route::get('/', [ProductCategoryAPIController::class, 'all']);
    Route::delete('/delete', [ProductCategoryAPIController::class, 'destroy']);
    // Route::post('update', [ProductAPIController::class, 'store']);
});

Route::group(['prefix' => 'masterUnit'], function () {
    Route::get('/', [MasterUnitAPIController::class, 'all']);
    // Route::post('update', [ProductAPIController::class, 'store']);
});

Route::group(['prefix' => 'midtrans'], function () {
    Route::post('/callback', [MidtransAPIController::class, 'callback']);
});

// AUTH

Route::group(['prefix' => 'auth'], function () {
    Route::post('register', [AuthAPIController::class, 'register']);
    Route::post('login', [AuthAPIController::class, 'login']);
    Route::post('checkNoHp', [AuthAPIController::class, 'checkNoHp']);
    Route::post('changePassword', [AuthAPIController::class, 'changePassword']);
});


Route::middleware('auth:sanctum')->group(function () {
    Route::group(['prefix' => 'user'], function () {
        Route::get('getMyUser', [UserAPIController::class, 'getMyUser']);
        Route::post('update', [UserAPIController::class, 'updateProfile']);
        Route::post('updatePhotoProfile', [UserAPIController::class, 'updatePhotoProfile']);
        Route::post('checkUsername', [UserAPIController::class, 'checkUsername']);
        Route::post('sendVerifikasiEmail', [UserAPIController::class, 'sendEmailVerification']);
    });

    Route::group(['prefix' => 'address'], function () {
        Route::post('updateAddress', [AddressAPIController::class, 'store']);
        Route::get('getAddress', [AddressAPIController::class, 'index']);
        Route::delete('delete', [AddressAPIController::class, 'delete']);

    });
    Route::group(['prefix' => 'business'], function () {
        Route::get('/all', [BusinessAPIController::class, 'all']);
        Route::get('/', [BusinessAPIController::class, 'index']);
        Route::post('update', [BusinessAPIController::class, 'store']);
    });

    Route::group(['prefix' => 'auth'], function () {
        Route::delete('logout', [AuthAPIController::class, 'logout']);
    });

    Route::group(['prefix' => 'businessCategory'], function () {
        Route::get('/', [BusinessCategoryAPIController::class, 'index']);
    });

    Route::group(['prefix' => 'openhours'], function () {
        Route::get('/', [OpenHourAPIController::class, 'index']);
        Route::post('update', [OpenHourAPIController::class, 'update']);
    });

    Route::group(['prefix' => 'product'], function () {
        Route::get('/', [ProductAPIController::class, 'all']);
        Route::post('update', [ProductAPIController::class, 'update']);
        Route::delete('delete', [ProductAPIController::class, 'delete']);

    });

    Route::group(['prefix' => 'discount'], function () {
        Route::get('/', [DiscountAPIController::class, 'index']);
        Route::post('update', [DiscountAPIController::class, 'store']);
        Route::delete('delete', [DiscountAPIController::class, 'delete']);
    });

    Route::group(['prefix' => 'cart'], function () {
        Route::get('/getMyCart', [CartAPIController::class, 'getMyCart']);
        Route::post('/update', [CartAPIController::class, 'update']);
        Route::delete('/delete', [CartAPIController::class, 'delete']);
    });

    Route::group(['prefix' => 'transaction'], function () {
        Route::get('/getMyTransaction', [SalesTransactionAPIController::class, 'getMyTransaction']);
        Route::get('/all', [SalesTransactionAPIController::class, 'all']);
        Route::post('/checkout', [SalesTransactionAPIController::class, 'checkout']);
        Route::post('/confirmation', [SalesTransactionAPIController::class, 'confirmation']);
        Route::post('/payment', [SalesTransactionAPIController::class, 'payment']);
        Route::post('/changeStatus', [SalesTransactionAPIController::class, 'changeStatus']);
        Route::delete('/delete', [SalesTransactionAPIController::class, 'destroy']);
    });


    Route::group(['prefix' => 'rating'], function () {
        Route::get('/all', [RatingAPIController::class, 'all']);
        Route::post('/update', [RatingAPIController::class, 'update']);
        Route::delete('/delete', [RatingAPIController::class, 'delete']);
    });

    Route::group(['prefix' => 'notification'], function () {
        Route::get('/getMyNotification', [NotificationAPIController::class, 'getMyNotification']);
        Route::post('/update', [NotificationAPIController::class, 'update']);
        Route::delete('/delete', [NotificationAPIController::class, 'delete']);
    });

    Route::group(['prefix' => 'balance'], function () {
        Route::get('/getMyBalance', [BalancesAPIController::class, 'getMyBalance']);
        Route::post('/add', [BalancesAPIController::class, 'add']);
    });

    Route::group(['prefix' => 'withdraw'], function () {
        Route::get('/all', [WithdrawBalanceAPIController::class, 'all']);
        Route::post('/add', [WithdrawBalanceAPIController::class, 'addRequest']);
    });

    Route::group(['prefix' => 'master_bank'], function () {
        Route::get('/all', [MasterBankAPIController::class, 'all']);
    });

    Route::group(['prefix' => 'product_favorite'], function () {
        Route::get('/all', [FavoriteProductAPIController::class, 'all']);
        Route::post('/update', [FavoriteProductAPIController::class, 'update']);
        Route::delete('/delete', [FavoriteProductAPIController::class, 'delete']);
    });

    Route::group(['prefix' => 'news'], function () {
        Route::get('/all', [NewsAPIController::class, 'all']);
        Route::post('/update', [NewsAPIController::class, 'update']);
        Route::delete('/delete', [NewsAPIController::class, 'delete']);
    });

    Route::group(['prefix' => 'events'], function () {
        Route::get('/all', [EventAPIController::class, 'all']);
        Route::post('/update', [EventAPIController::class, 'update']);
        Route::delete('/delete', [EventAPIController::class, 'delete']);
        Route::post('/register', [EventRegisterAPIController::class, 'registerEvent']);
        Route::get('/participants', [EventRegisterAPIController::class, 'all']);

    });

    Route::group(['prefix' => 'feed'], function () {
        Route::get('/all', [FeedAPIController::class, 'all']);
        Route::post('/update', [FeedAPIController::class, 'update']);
        Route::delete('/delete', [FeedAPIController::class, 'delete']);
    });

    Route::group(['prefix' => 'like_feed'], function () {
        Route::get('/all', [LikeFeedAPIController::class, 'all']);
        Route::post('/update', [LikeFeedAPIController::class, 'update']);
        Route::delete('/delete', [LikeFeedAPIController::class, 'delete']);
    });

    Route::group(['prefix' => 'comment_feed'], function () {
        Route::get('/all', [CommentFeedAPIController::class, 'all']);
        Route::post('/update', [CommentFeedAPIController::class, 'update']);
        Route::delete('/delete', [CommentFeedAPIController::class, 'delete']);
    });
    
});

// http:172.0.1:80000/api/v1/business/update


Route::resource('master_product_categories', App\Http\Controllers\API\MasterProductCategoryAPIController::class);


Route::resource('master_business_categories', App\Http\Controllers\API\MasterBusinessCategoryAPIController::class);


Route::resource('master_status_businesses', App\Http\Controllers\API\MasterStatusBusinessAPIController::class);


Route::resource('master_units', App\Http\Controllers\API\MasterUnitAPIController::class);


Route::resource('master_privileges', App\Http\Controllers\API\MasterPrivilegeAPIController::class);


Route::resource('master_provinces', App\Http\Controllers\API\MasterProvinceAPIController::class);


Route::resource('master_delivery_services', App\Http\Controllers\API\MasterDeliveryServiceAPIController::class);


Route::resource('master_payment_methods', App\Http\Controllers\API\MasterPaymentMethodAPIController::class);


Route::resource('master_transaction_categories', App\Http\Controllers\API\MasterTransactionCategoryAPIController::class);

Route::resource('master_status_users', App\Http\Controllers\API\MasterStatusUserAPIController::class);


Route::resource('users', App\Http\Controllers\API\UserAPIController::class);


Route::resource('businesses', App\Http\Controllers\API\BusinessAPIController::class);


Route::resource('business_files', App\Http\Controllers\API\BusinessFileAPIController::class);


Route::resource('business_categories', App\Http\Controllers\API\BusinessCategoryAPIController::class);


Route::resource('master_cities', App\Http\Controllers\API\CityAPIController::class);


Route::resource('sub_districts', App\Http\Controllers\API\SubDistrictAPIController::class);


Route::resource('addresses', App\Http\Controllers\API\AddressAPIController::class);


Route::resource('products', App\Http\Controllers\API\ProductAPIController::class);


Route::resource('product_categories', App\Http\Controllers\API\ProductCategoryAPIController::class);


Route::resource('open_hours', App\Http\Controllers\API\OpenHourAPIController::class);


Route::resource('business_delivery_services', App\Http\Controllers\API\BusinessDeliveryServiceAPIController::class);


Route::resource('shipping_cost_variables', App\Http\Controllers\API\ShippingCostVariableAPIController::class);


Route::resource('shipping_useds', App\Http\Controllers\API\ShippingUsedAPIController::class);


Route::resource('discounts', App\Http\Controllers\API\DiscountAPIController::class);


Route::resource('sales_delivery_services', App\Http\Controllers\API\SalesDeliveryServiceAPIController::class);


Route::resource('product_files', App\Http\Controllers\API\ProductFileAPIController::class);


Route::resource('business_payment_methods', App\Http\Controllers\API\BusinessPaymentMethodAPIController::class);


Route::resource('sales_transactions', App\Http\Controllers\API\SalesTransactionAPIController::class);


Route::resource('ratings', App\Http\Controllers\API\RatingAPIController::class);


Route::resource('transaction_statuses', App\Http\Controllers\API\TransactionStatusAPIController::class);


Route::resource('transaction_products', App\Http\Controllers\API\TransactionProductAPIController::class);


Route::resource('balances', App\Http\Controllers\API\BalancesAPIController::class);




Route::resource('events', App\Http\Controllers\API\EventAPIController::class);


Route::resource('news', App\Http\Controllers\API\NewsAPIController::class);


Route::resource('announcements', App\Http\Controllers\API\AnnouncementAPIController::class);


Route::resource('event_registers', App\Http\Controllers\API\EventRegisterAPIController::class);
