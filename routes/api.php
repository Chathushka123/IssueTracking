<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

////////////////////////////////////////////////////////////////////////////////
//                            Issue                                        //
///////////////////////////////////////////////////////////////////////////////

Route::post('createIssue','App\Http\Controllers\IssueController@createIssue')->name('createIssue');
Route::get('getIssue','App\Http\Controllers\IssueController@getIssue')->name('getIssue');
Route::post('addIssueImage','App\Http\Controllers\IssueController@addIssueImage')->name('addIssueImage');
Route::get('getIssueByUuid/{uuid}','App\Http\Controllers\IssueController@getIssueByUuid')->name('getIssueByUuid');
Route::get('getIssueByCategory/{categoryId}','App\Http\Controllers\IssueController@getIssueByCategory')->name('getIssueByCategory');
Route::get('getIssueBySubcategory/{subcategoryId}','App\Http\Controllers\IssueController@getIssueBySubcategory')->name('getIssueBySubcategory');
Route::post('addIssueComment','App\Http\Controllers\IssueController@addIssueComment')->name('addIssueComment');

////////////////////////////////////////////////////////////////////////////////
//                            Category                                        //
///////////////////////////////////////////////////////////////////////////////

Route::post('createCategory','App\Http\Controllers\CategoryController@createCategory')->name('createCategory');
Route::post('createCategoryIssueByCategory','App\Http\Controllers\CategoryController@createCategoryIssueByCategory')->name('createCategoryIssueByCategory');
