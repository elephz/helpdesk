<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/hasBeenBanned', function () {
    return view('banned');
})->name('banned');

Route::get('/pending', function () {
    return view('tech.wait');
})->name('tech.wait');


Auth::routes();

Route::group(['middleware' => 'CheckBlocked'], function () {
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::group(['middleware' => 'Admin'], function () {
        Route::get('/', 'AdminController@index')->name('admin.dashboard');
      
        Route::group(['prefix' => 'jobtype'], function () {
            Route::get('/', 'JobsTypeController@index')->name('admin.jobtype');
            Route::post('/', 'JobsTypeController@store')->name('admin.jobtype.store');
            Route::put('/update', 'JobsTypeController@update')->name('admin.jobtype.update');
            Route::delete('/delete/{id?}', 'JobsTypeController@delete')->name('admin.jobtype.delete');
        });

        Route::group(['prefix' => 'equipment'], function () {
            Route::get('/', 'EquipmentController@index')->name('admin.equipment');
            Route::post('/', 'EquipmentController@store')->name('admin.equipment.store');
            Route::put('/update', 'EquipmentController@update')->name('admin.equipment.update');
            Route::delete('/delete/{id?}', 'EquipmentController@delete')->name('admin.equipment.delete');
        });

        Route::group(['prefix' => 'jobs'], function () {
            Route::get('/', 'JobsController@index')->name('admin.jobs');
            Route::get('/detail/{id}', 'JobsController@detail')->name('admin.jobs.detail');
            Route::put('/assignTech', 'JobsController@assignTech')->name('admin.jobs.assignTech');
        });

        Route::group(['prefix' => 'user'], function () {
            Route::get('/', 'UserController@index')->name('admin.user');
            Route::put('/banned', 'UserController@Banned')->name('admin.putBanned');
            Route::get('/profile/{id}', 'UserController@profile')->name('admin.profile');
        });

        Route::group(['prefix' => 'tech'], function () {
            Route::get('/', 'UserController@allTech')->name('admin.allTech');
            Route::get('/newTech', 'UserController@newTech')->name('admin.newtech');
            Route::put('/newTech/accept', 'UserController@acceptTech')->name('admin.tech.accept');
        });
    });
});

Route::group(['middleware' => 'User'], function () {
    Route::group(['prefix' => 'user', 'namespace' => 'User'], function () {
        Route::get('/', 'UserController@index')->name('user.dashboard');
        Route::post('/', 'JobCaseController@store')->name('user.store');
        Route::put('/update', 'UserController@update')->name('user.update');
    });
});

Route::group(['middleware' => 'Tech'], function () {
    Route::group(['prefix' => 'tech', 'namespace' => 'Tech'], function () {
        Route::get('/', 'TechController@index')->name('tech.dashboard');
        Route::get('/Jobs', 'JobsController@index')->name('tech.Jobs');
        Route::put('/Jobs/{id}', 'JobsController@accept')->name('tech.Jobs.accept');
        Route::put('/Jobs/success/{id}', 'JobsController@success')->name('tech.Jobs.success');
     
        Route::put('/Jobs/cancel/msg','JobsController@cancel')->name('tech.Jobs.cancel');
        Route::get('/Jobs/getCancelMsg/detail/{id}','JobsController@getCancelMsg')->name('tech.Jobs.getCancelMsg');
        Route::get('/Jobs/success/detail/{id}','JobsController@getSuccessReport')->name('tech.Jobs.success.detail');
        Route::get('/detail/{id}', 'JobsController@detail')->name('tech.jobs.detail');
    });
});

});

