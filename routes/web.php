<?php

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

Auth::routes();

Route::middleware(['auth'])->group(function(){

	Route::get('/', 'Auth\LoginController@showLoginForm');
	Route::get('/logout', 'Auth\LoginController@logout');
	Route::get('/dashboard', 'UserController@index');
	Route::get('/create-accounts-credentials', 'CredentialController@index');
	Route::post('/add-save-credentials', 'CredentialController@store');
	Route::get('/create-client-access', 'HeadOfficeController@index');
	Route::post('/save-client-access', 'HeadOfficeController@store');
	Route::get('/view-credentials-details', 'HeadOfficeController@show');
	Route::get('/update', 'HeadOfficeController@update');
	Route::get('/payment', 'PaymentController@index');
	Route::post('/payments-save', 'PaymentController@store');
	Route::get('/view-user-profile', 'UserController@view_profile');
	Route::get('/user-status/{id}', 'UserController@update_status');
	Route::post('/upload-image', 'UserController@upload_image');
	Route::get('/client-informations-{id}', 'UserController@about_client');
	Route::get('/client-account-status-{id}', 'UserController@client_account_status');
	Route::post('/update-client-subscription-{id}', 'UserController@update_subscription');

	Route::get('/receipt', 'ReceiptController@index');
	Route::post('/receipt-payment', 'ReceiptController@store');
	Route::post('/update-payment-{id}', 'ReceiptController@update');
	Route::get('/receipt-{id}', 'ReceiptController@edit');



	Route::get('/edit-credentials', 'CredentialController@show');
	/*headoffice*/
	Route::get('/head-office-dashboard', 'UserController@head_office');
	Route::get('/head-office-information', 'HeadOfficeController@head_office_information');
	Route::post('/head-office-information-saved', 'HeadOfficeController@post_head_office_information');
	Route::get('/head-office-information-edit', 'HeadOfficeController@edit_head_office_information');
	Route::post('/head-office-information-update', 'HeadOfficeController@update_head_office_information');

	#branch
	Route::get('/create-branch-access', 'BranchesController@get_branch');
	Route::post('/save-branch-access', 'BranchesController@post_branch_access');
	Route::get('/branch-details', 'BranchesController@get_branch_details');
	// Route::get('/branch-users', 'BranchesController@get_branch_users');


	#Billing History
	Route::get('/head-office-billing-history', 'PaymentController@show_billing_history');
	Route::get('/view_pdf/invoice/prepaid-invoice/{id}', 'InvoiceController@view_invoice_prepaid');
	Route::get('/view_pdf/invoice/postpaid-invoice/{id}', 'InvoiceController@view_invoice_postpaid');
	Route::get('/view_pdf/receipt/postpaid-receipt/{id}', 'ReceiptController@view_receipt_postpaid');
	Route::get('/view_pdf/payment/payment/{id}', 'PaymentController@view_payment');

	#end Billing History

	#USER ACCOUNT, PASSWORD, INFORMATION
	Route::post('/update-user-account', 'UserController@update_user_account');
	Route::post('/update-user-password', 'UserController@update_user_password');
	Route::post('/update-company-information', 'UserController@update_company_information');
	/*endheadoffice*/

	/*Display Clients Billing Statement*/
	Route::get('/clients-billing-statements', 'BillController@index');
	Route::get('/users', 'BillController@usersList');

	/*Display Sent Messages*/
	Route::get('/sent-message','MessageController@showSentMessages');
	Route::get('/sent-message-json', 'MessageController@showSentMessagesJson')->name('messages.show');

	//Ajax Request
	Route::get('/findTotalUsage', 'ReceiptController@invoiceTotalUsage');

	/*Clients Resource*/
	Route::resource('clients', 'ClientController');
	// client credentials
	Route::get('client/{id}/credentials', 'ClientCredentials@index')->name('client.credentials');
	// client branches
	Route::get('client/{id}/branches', 'ClientBranchesController@getBranches')->name('client.branches');
	// create client branches
	Route::get('create/{client_id}/branches', 'ClientBranchesController@create')->name('create.branch');
	// Store new branch for client
	Route::post('store/client/branch', 'ClientBranchesController@store')->name('store.client.branch');
	// tagging client to branches route
	Route::post('update-client-branches', 'ClientBranchesController@updateClientBranch')->name('update.client.branch');


});
