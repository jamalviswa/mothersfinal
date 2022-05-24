<?php

use App\Task;
use Illuminate\Http\Request;

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

Route::resource('my', 'MyController');
Route::any('/', 'AdminusersController@login');
Route::any('/admin', 'AdminusersController@login');
Route::any('adminusers/logout', 'AdminusersController@logout');
Route::any('adminusers/profile', 'AdminusersController@profile');
Route::any('adminusers/changepassword', 'AdminusersController@changepassword');



Route::any('adminusers/subadmin/index', 'AdminusersController@subadmin_index')->name('adminusers.subadmin_index');
Route::get('adminusers/subadmin/add', 'AdminusersController@subadmin_add')->name('adminusers.subadmin_add');
Route::get('adminusers/subadmin/edit/{id}', 'AdminusersController@subadmin_edit')->name('adminusers.subadmin_edit');
Route::get('adminusers/subadmin/view/{id}', 'AdminusersController@subadmin_view')->name('adminusers.subadmin_view');
Route::post('adminusers/subadmin/store', 'AdminusersController@subadmin_store')->name('adminusers.subadmin_store');
Route::post('adminusers/subadmin/update/{id}', 'AdminusersController@subadmin_update')->name('adminusers.subadmin_update');
Route::get('adminusers/subadmin/delete/{id}', 'AdminusersController@subadmin_delete')->name('adminusers.subadmin_delete');


//Customer Details

Route::any('customers/personal/index', 'CustomersController@personal_index')->name('customers.personal_index');
Route::get('customers/personal/add', 'CustomersController@personal_add')->name('customers.personal_add');
Route::get('customers/personal/edit/{id}', 'CustomersController@personal_edit')->name('customers.personal_edit');
Route::get('customers/personal/view/{id}', 'CustomersController@personal_view')->name('customers.personal_view');
Route::post('customers/personal/store', 'CustomersController@personal_store')->name('customers.personal_store');
Route::post('customers/personal/update/{id}', 'CustomersController@personal_update')->name('customers.personal_update');
Route::get('customers/personal/delete/{id}', 'CustomersController@personal_delete')->name('customers.personal_delete');
Route::get('customers/personal/invoicepdf/{id}', 'CustomersController@personal_invoicepdf')->name('customers.personal_invoicepdf');
Route::get('customers/personal/receiptform/{id}', 'CustomersController@personal_receiptform')->name('customers.personal_receiptform');

Route::any('customers/official/index', 'CustomersController@official_index')->name('customers.official_index');
Route::get('customers/official/add', 'CustomersController@official_add')->name('customers.official_add');
Route::get('customers/official/edit/{id}', 'CustomersController@official_edit')->name('customers.official_edit');
Route::get('customers/official/view/{id}', 'CustomersController@official_view')->name('customers.official_view');
Route::post('customers/official/store', 'CustomersController@official_store')->name('customers.official_store');
Route::post('customers/official/update/{id}', 'CustomersController@official_update')->name('customers.official_update');
Route::get('customers/official/delete/{id}', 'CustomersController@official_delete')->name('customers.official_delete');
Route::post('customers/map/', 'CustomersController@map')->name('customers.map');
Route::post('customers/maps/', 'CustomersController@maps')->name('customers.maps');
Route::get('customers/official/invoicepdf/{id}', 'CustomersController@official_invoicepdf')->name('customers.official_invoicepdf');
Route::get('customers/official/receiptform/{id}', 'CustomersController@official_receiptform')->name('customers.official_receiptform');


Route::any('payments/index', 'PaymentsController@index')->name('payments.index');
Route::get('payments/add', 'PaymentsController@add')->name('payments.add');
Route::post('payments/store', 'PaymentsController@store')->name('payments.store');
Route::get('payments/edit/{id}', 'PaymentsController@edit')->name('payments.edit');
Route::post('payments/update/{id}', 'PaymentsController@update')->name('payments.update');
Route::get('payments/delete/{id}', 'PaymentsController@delete')->name('payments.delete');
Route::get('payments/view/{id}', 'PaymentsController@view')->name('payments.view');
Route::post('payments/map/', 'PaymentsController@map')->name('payments.map');
Route::get('payments/invoicepdf/{id}', 'PaymentsController@invoicepdf')->name('payments.invoicepdf');
Route::get('payments/receiptform/{id}', 'PaymentsController@receiptform')->name('payments.receiptform');

Route::any('receipts/index', 'ReceiptsController@index')->name('receipts.index');
Route::get('receipts/add', 'ReceiptsController@add')->name('receipts.add');
Route::post('receipts/store', 'ReceiptsController@store')->name('receipts.store');
Route::get('receipts/edit/{id}', 'ReceiptsController@edit')->name('receipts.edit');
Route::post('receipts/update/{id}', 'ReceiptsController@update')->name('receipts.update');
Route::get('receipts/delete/{id}', 'ReceiptsController@delete')->name('receipts.delete');
Route::get('receipts/view/{id}', 'ReceiptsController@view')->name('receipts.view');
Route::post('receipts/map/', 'ReceiptsController@map')->name('receipts.map');
Route::get('receipts/invoicepdf/{id}', 'ReceiptsController@invoicepdf')->name('receipts.invoicepdf');
Route::get('receipts/receiptform/{id}', 'ReceiptsController@receiptform')->name('receipts.receiptform');

Route::any('deletes/personal/index', 'DeletesController@personal_index')->name('deletes.personal_index');
Route::get('deletes/personal/view/{id}', 'DeletesController@personal_view')->name('deletes.personal_view');
Route::any('deletes/official/index', 'DeletesController@official_index')->name('deletes.official_index');
Route::get('deletes/official/view/{id}', 'DeletesController@official_view')->name('deletes.official_view');
Route::any('deletes/cost/index', 'DeletesController@cost_index')->name('deletes.cost_index');
Route::get('deletes/cost/view/{id}', 'DeletesController@cost_view')->name('deletes.cost_view');
Route::any('deletes/receipt/index', 'DeletesController@receipt_index')->name('deletes.receipt_index');
Route::get('deletes/receipt/view/{id}', 'DeletesController@receipt_view')->name('deletes.receipt_view');
Route::any('deletes/payment/index', 'DeletesController@payment_index')->name('deletes.payment_index');
Route::get('deletes/payment/view/{id}', 'DeletesController@payment_view')->name('deletes.payment_view');


Route::any('costs/index', 'CostsController@index')->name('costs.index');
Route::get('costs/add', 'CostsController@add')->name('costs.add');
Route::post('costs/store', 'CostsController@store')->name('costs.store');
Route::get('costs/edit/{id}', 'CostsController@edit')->name('costs.edit');
Route::post('costs/update/{id}', 'CostsController@update')->name('costs.update');
Route::get('costs/delete/{id}', 'CostsController@delete')->name('costs.delete');
Route::get('costs/view/{id}', 'CostsController@view')->name('costs.view');
Route::post('costs/map/', 'CostsController@map')->name('costs.map');
Route::get('costs/invoicepdf/{id}', 'CostsController@invoicepdf')->name('costs.invoicepdf');
Route::get('costs/receiptform/{id}', 'CostsController@receiptform')->name('costs.receiptform');

Route::any('blocks/index', 'BlocksController@index')->name('blocks.index');
Route::get('blocks/add', 'BlocksController@add')->name('blocks.add');
Route::post('blocks/store', 'BlocksController@store')->name('blocks.store');
Route::get('blocks/edit/{id}', 'BlocksController@edit')->name('blocks.edit');
Route::post('blocks/update/{id}', 'BlocksController@update')->name('blocks.update');
Route::get('blocks/delete/{id}', 'BlocksController@delete')->name('blocks.delete');
Route::get('blocks/view/{id}', 'BlocksController@view')->name('blocks.view');
Route::post('blocks/map/', 'BlocksController@map')->name('blocks.map');
Route::get('blocks/invoicepdf/{id}', 'BlocksController@invoicepdf')->name('blocks.invoicepdf');
Route::get('blocks/receiptform/{id}', 'BlocksController@receiptform')->name('blocks.receiptform');
//Master

Route::any('masters/phase/index', 'MastersController@phase_index')->name('masters.phase_index');
Route::get('masters/phase/add', 'MastersController@phase_add')->name('masters.phase_add');
Route::post('masters/phase/store', 'MastersController@phase_store')->name('masters.phase_store');
Route::get('masters/phase/edit/{id}', 'MastersController@phase_edit')->name('masters.phase_edit');
Route::post('masters/phase/update/{id}', 'MastersController@phase_update')->name('masters.phase_update');

Route::any('masters/block/index', 'MastersController@block_index')->name('masters.block_index');
Route::get('masters/block/add', 'MastersController@block_add')->name('masters.block_add');
Route::get('masters/block/edit/{id}', 'MastersController@block_edit')->name('masters.block_edit');
Route::post('masters/block/store', 'MastersController@block_store')->name('masters.block_store');
Route::post('masters/block/update/{id}', 'MastersController@block_update')->name('masters.block_update');

Route::any('masters/floor/index', 'MastersController@floor_index')->name('masters.floor_index');
Route::get('masters/floor/add', 'MastersController@floor_add')->name('masters.floor_add');
Route::get('masters/floor/edit/{id}', 'MastersController@floor_edit')->name('masters.floor_edit');
Route::post('masters/floor/store', 'MastersController@floor_store')->name('masters.floor_store');
Route::post('masters/floor/update/{id}', 'MastersController@floor_update')->name('masters.floor_update');

Route::any('masters/flattype/index', 'MastersController@flattype_index')->name('masters.flattype_index');
Route::get('masters/flattype/add', 'MastersController@flattype_add')->name('masters.flattype_add');
Route::get('masters/flattype/edit/{id}', 'MastersController@flattype_edit')->name('masters.flattype_edit');
Route::post('masters/flattype/store', 'MastersController@flattype_store')->name('masters.flattype_store');
Route::post('masters/flattype/update/{id}', 'MastersController@flattype_update')->name('masters.flattype_update');

Route::any('masters/flatnumber/index', 'MastersController@flatnumber_index')->name('masters.flatnumber_index');
Route::get('masters/flatnumber/add', 'MastersController@flatnumber_add')->name('masters.flatnumber_add');
Route::get('masters/flatnumber/edit/{id}', 'MastersController@flatnumber_edit')->name('masters.flatnumber_edit');
Route::post('masters/flatnumber/store', 'MastersController@flatnumber_store')->name('masters.flatnumber_store');
Route::post('masters/flatnumber/update/{id}', 'MastersController@flatnumber_update')->name('masters.flatnumber_update');
Route::post('masters/map/', 'MastersController@map')->name('masters.map');

Route::any('countries/index', 'CountriesController@index')->name('countries.index');
Route::get('countries/add', 'CountriesController@add')->name('countries.add');
Route::post('countries/store', 'CountriesController@store')->name('countries.store');
Route::get('countries/edit/{id}', 'CountriesController@edit')->name('countries.edit');
Route::post('countries/update/{id}', 'CountriesController@update')->name('countries.update');
Route::get('countries/delete/{id}', 'CountriesController@delete')->name('countries.delete');
Route::get('countries/view/{id}', 'CountriesController@view')->name('countries.view');