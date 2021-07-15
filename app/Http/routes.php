<?php

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
/*----------------For Customer---------------*/

Route::get('home','homecontroller@index');

Route::get('json-city','registrationcontroller@city');
Route::get('registration','registrationcontroller@index');
Route::post('registrationform','registrationcontroller@store')->name('registrationform');

Route::get('login','logincontroller@index');
Route::post('loginform','logincontroller@store')->name('loginform');

Route::get('forgotpwd','forgotpwdcontroller@index');
Route::post('forgotpwdform','forgotpwdcontroller@forgotpwdform')->name('forgotpwdform');

Route::get('contact','homecontroller@contact');
Route::post('contactform','homecontroller@contactform')->name('contactform');

Route::get('aboutus','homecontroller@aboutus');

Route::get('changepwd','changepwdcontroller@changepwd');
Route::post('changepwdform','changepwdcontroller@changepwdform')->name('changepwdform');

Route::get('profile','homecontroller@profile');
Route::get('profileadmin','homecontroller@profileadmin');
Route::get('logout','logincontroller@logout');

Route::post('categoryproduct','productcontroller@cusproduct')->name('categoryproduct');
Route::post('singleproduct','productcontroller@singleproduct')->name('singleproduct');

Route::post('cart','cartcontroller@cart')->name('addtocart');
Route::get('showcart','cartcontroller@index');
Route::post('increment','cartcontroller@increment')->name('increment');
Route::post('decrement','cartcontroller@decrement')->name('decrement');

//Route::controllers([
		//'password' => 'Auth\PasswordController']);


Route::get('mypurchaseorder','ordercontroller@mypurchaseorder');
Route::get('placeorder','ordercontroller@index');
Route::post('cancelorder','ordercontroller@cancelorder')->name('cancelorder');
Route::post('orderview','ordercontroller@orderview')->name('orderview');
Route::post('complateorderview','ordercontroller@complateorderview')->name('complateorderview');
Route::post('invoice','ordercontroller@invoice')->name('invoice');

Route::post('returnproducts','ordercontroller@returnproducts')->name('returnproducts');
Route::post('returnproductsform','ordercontroller@returnproductsform')->name('returnproductsform');


Route::post('giverating','feedbackcontroller@giverating')->name('giverating');
Route::post('rating','feedbackcontroller@rating')->name('rating');
Route::post('feedback','feedbackcontroller@feedback')->name('feedback');

/*----------------For Admin---------------*/

Route::get('dashboard','dashboardcontroller@index');


Route::get('category','categorycontroller@index');
Route::post('categoryform','categorycontroller@store')->name('categoryform');
Route::post('categoryupdate','categorycontroller@update')->name('categoryupdate');
Route::post('editcategory','categorycontroller@edit')->name('editcategory');
Route::get('categorydelete/{id}','categorycontroller@destroy');

Route::get('rawmaterial','rawmaterialcontroller@index');
Route::post('rawmaterialform','rawmaterialcontroller@store')->name('rawmaterialform');
Route::post('rawmaterialupdate','rawmaterialcontroller@update')->name('rawmaterialupdate');
Route::post('editrawmaterial','rawmaterialcontroller@edit')->name('editrawmaterial');
Route::get('rawmaterialdelete/{id}','rawmaterialcontroller@destroy');

Route::get('purchase','purchasecontroller@index');
Route::get('addpurchase','purchasecontroller@addpurchase');
Route::post('addpurchaseorder','purchasecontroller@addpurchaseorder')->name('addpurchaseorder');
Route::post('purchseview','purchasecontroller@purchseview')->name('purchseview');
Route::post('returnpurchase','purchasecontroller@returnpurchase')->name('returnpurchase');
Route::post('returnpurchaseform','purchasecontroller@returnpurchaseform')->name('returnpurchaseform');
Route::get('purchasereturn','purchasecontroller@purchasereturn');
Route::post('purchsereturnview','purchasecontroller@purchsereturnview')->name('purchsereturnview');


Route::get('json-city','suppliercontroller@city');
Route::get('json-material','suppliercontroller@material');

Route::get('supplier','suppliercontroller@index');
Route::post('addsupplier','suppliercontroller@store')->name('supplierstore');
Route::post('updatesupplier','suppliercontroller@update')->name('updatesupplier');
Route::post('editsupplier','suppliercontroller@edit')->name('editsupplier');
Route::post('showsupplier','suppliercontroller@show')->name('showsupplier');
Route::get('supplierdelete/{id}','suppliercontroller@destroy');


Route::get('json-product','employeecontroller@product');

Route::get('employee','employeecontroller@index');
Route::post('addsemployee','employeecontroller@store')->name('employeestore');
Route::post('updateemployee','employeecontroller@update')->name('updateemployee');
Route::post('editemployee','employeecontroller@edit')->name('editemployee');
Route::post('showemployee','employeecontroller@show')->name('showemployee');
Route::get('employeedelete/{id}','employeecontroller@destroy');


Route::get('product','productcontroller@index');
Route::post('productform','productcontroller@store')->name('productform');
Route::post('productupdate','productcontroller@update')->name('productupdate');
Route::post('editproduct','productcontroller@edit')->name('editproduct');
Route::post('showproduct','productcontroller@show')->name('showproduct');
Route::get('productdelete/{id}','productcontroller@destroy');



Route::get('pendsalesorder','salesordercontroller@pendsalesorder');
Route::post('processsalesorder','salesordercontroller@processsalesorder')->name('processsalesorder');
Route::post('pendingorderview','salesordercontroller@pendingorderview')->name('pendingorderview');
Route::get('procesalesorder','salesordercontroller@procesalesorder');
Route::post('complateorder','salesordercontroller@complateorder')->name('complateorder');
Route::post('processorderview','salesordercontroller@processorderview')->name('processorderview');
Route::get('comporder','salesordercontroller@comporder');
Route::post('comporderview','salesordercontroller@comporderview')->name('comporderview');
Route::get('salesreturn','salesordercontroller@salesreturn');
Route::post('salesreturnview','salesordercontroller@salesreturnview')->name('salesreturnview');




