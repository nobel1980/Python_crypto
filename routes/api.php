<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ItemsController;
use App\Http\Controllers\API\ServiceController;
use App\Http\Controllers\API\SalesController;
use App\Http\Controllers\API\SettingController;
use App\Http\Controllers\API\CryptController;

Route::post('/auth/signin', [AuthController::class, 'login']);
Route::post('/auth/refreshtoken', [AuthController::class, 'refresh_token']);
Route::get('/settings/policies/dto', [ServiceController::class, 'policies_dto']); /** All policy as list -api 4 */
Route::get('/settings/service/categories/all', [ServiceController::class, 'category_all']);
Route::get('/inventory/devices/all', [ServiceController::class, 'devices_all']);
Route::get('/inventory/devices/sysdate', [ServiceController::class, 'server_date']);
Route::get('/inventory/devices/dto/{device_number}/slno', [ServiceController::class, 'device_status']); /** Device status -API 7 */ 
Route::get('/inventory/devices/{device_number}/slno', [ServiceController::class, 'device_data']);  /** Device data details API -9 */
Route::get('/invoices/items/{bin_number}', [ServiceController::class, 'invoice_details']);
Route::post('/invoices/bulk', [SalesController::class, 'invoice_bulk']);
Route::post('/invoices/create', [SalesController::class, 'invoice_create']);
Route::get('/items/{bin_number}/bin', [ItemsController::class, 'bin_wise_items']);
Route::get('/taxpayer/setup/outlets/{bin_number}/bin', [SettingController::class, 'binholder_outlet']);

Route::post('encrypt', [CryptController::class, 'encrypt']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::middleware('auth:api')->group( function(){
});