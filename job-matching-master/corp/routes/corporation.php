<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
    #corporations
    Route::get('corporations/{name?}', 'App\Http\Controllers\Corporation\CorporationsController@index')->name('corporations.index')
    ->where('name', 'index');
    Route::match(['get', 'post'], 'corporations/add', 'App\Http\Controllers\Corporation\CorporationsController@add')->name('corporations.add');
    Route::match(['get', 'post'], 'corporations/edit', 'App\Http\Controllers\Corporation\CorporationsController@edit')->name('corporations.edit');
    Route::get('corporations/view', 'App\Http\Controllers\Corporation\CorporationsController@view')->name('corporations.view');
    Route::delete('corporations/delete', 'App\Http\Controllers\Corporation\CorporationsController@delete')->name('corporations.delete');

    #scouts
    Route::get('scouts', 'App\Http\Controllers\Corporation\ScoutsController@index');
    Route::match(['post'], 'scouts', 'App\Http\Controllers\Corporation\ScoutsController@edit')->name('scouts.edit');

    #jobs
    Route::get('jobs', 'App\Http\Controllers\Corporation\JobsController@index')->name('jobs.index');
    Route::match(['get', 'post'], 'jobs/add', 'App\Http\Controllers\Corporation\JobsController@add')->name('jobs.add');
    Route::match(['get', 'post'], 'jobs/edit', 'App\Http\Controllers\Corporation\JobsController@edit')->name('jobs.edit');
    Route::get('jobs/view', 'App\Http\Controllers\Corporation\JobsController@view')->name('jobs.view');
    Route::delete('jobs/delete', 'App\Http\Controllers\Corporation\JobsController@delete')->name('jobs.delete');


    #favorites
    Route::get('favorites/{name?}', 'App\Http\Controllers\Corporation\FavoritesController@index')->name('favorites.index')
    ->where('name', 'index');

    #browsing_histories
    Route::get('browsing_histories/{name?}', 'App\Http\Controllers\Corporation\BrowsingHistoriesController@index')->name('browsing_histories.index')
    ->where('name', 'index');

    #help
    Route::get('helps/{name?}', 'App\Http\Controllers\Corporation\HelpsController@index')
    ->name('helps.index')->where('name', 'index');
    // Route::get('helps_searched', 'App\Http\Controllers\Corporation\HelpsController@help')
    //  ->name('helps.searched');
});
