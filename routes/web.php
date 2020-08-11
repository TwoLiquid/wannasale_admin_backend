<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Dashboard
Route::group(['prefix' => 'dashboard', 'namespace' => 'Dashboard'], function () {

    Route::get('registration/confirm',  'AuthController@confirmEmail')->name('dashboard.registration.confirm');

    Route::group(['middleware' => 'guest:' . GUARD_DASHBOARD], function () {

        Route::get( 'login', 'AuthController@login'       )->name('dashboard.login');
        Route::post('login', 'AuthController@authenticate')->name('dashboard.login.make');
    });

    Route::group(['middleware' => 'auth:' . GUARD_DASHBOARD], function () {

        Route::get('/',      'MainController@index' )->name('dashboard.index');
        Route::get('logout', 'AuthController@logout')->name('dashboard.logout');

        Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

            Route::group(['prefix' => 'rates'], function () {

                Route::get('/',            'RateController@index' )->name('dashboard.admin.rates');
                Route::get('create',       'RateController@create')->name('dashboard.admin.rates.create');
                Route::post('create',      'RateController@store' )->name('dashboard.admin.rates.store');
                Route::get('{id}/edit',    'RateController@edit'  )->name('dashboard.admin.rates.edit');
                Route::post('{id}/edit',   'RateController@update')->name('dashboard.admin.rates.update');
                Route::post('{id}/delete', 'RateController@delete')->name('dashboard.admin.rates.delete');
            });

            Route::group(['prefix' => 'vendors'], function () {

                Route::get('/',                 'VendorController@index' )->name('dashboard.admin.vendors');
                Route::get('create',            'VendorController@create')->name('dashboard.admin.vendors.create');
                Route::post('create',           'VendorController@store' )->name('dashboard.admin.vendors.store');
                Route::get('{id}/edit',         'VendorController@edit'  )->name('dashboard.admin.vendors.edit');
                Route::post('{id}/edit',        'VendorController@update')->name('dashboard.admin.vendors.update');
                Route::post('{id}/delete',      'VendorController@delete')->name('dashboard.admin.vendors.delete');

                Route::get('{id}/users/invite',         'UserController@create')->name('dashboard.admin.vendors.users.create');
                Route::post('{id}/users/invite',        'UserController@invite')->name('dashboard.admin.vendors.users.invite');
                Route::post('{id}/users/{uid}/delete',  'UserController@delete')->name('dashboard.admin.vendors.users.delete');

                Route::get('{id}/sites/create',         'SiteController@create'  )->name('dashboard.admin.vendors.sites.create');
                Route::post('{id}/sites/create',        'SiteController@store'   )->name('dashboard.admin.vendors.sites.store');
                Route::get('{id}/sites/requests',       'SiteController@requests')->name('dashboard.admin.vendors.sites.requests');
                Route::post('{id}/sites/delete',        'SiteController@delete'  )->name('dashboard.admin.vendors.sites.delete');
            });

            Route::group(['prefix' => 'partners'], function () {

                Route::get('/',                 'AdminController@index' )->name('dashboard.admin.partners');
                Route::get('create',            'AdminController@create')->name('dashboard.admin.partners.create');
                Route::post('create',           'AdminController@store' )->name('dashboard.admin.partners.store');
                Route::get('{id}/edit',         'AdminController@edit'  )->name('dashboard.admin.partners.edit');
                Route::post('{id}/edit',        'AdminController@update')->name('dashboard.admin.partners.update');
                Route::post('{id}/delete',      'AdminController@delete')->name('dashboard.admin.partners.delete');
            });

            /* Route::group(['prefix' => 'users'], function () {

                Route::get('/',            'UserController@index' )->name('dashboard.users');
                Route::get('create',       'UserController@create')->name('dashboard.users.create');
                Route::post('create',      'UserController@store' )->name('dashboard.users.store');
                Route::get('{id}/edit',    'UserController@edit'  )->name('dashboard.users.edit');
                Route::post('{id}/edit',   'UserController@update')->name('dashboard.users.update');
                Route::post('{id}/delete', 'UserController@delete')->name('dashboard.users.delete');
            }); */
        });

        Route::group(['prefix' => 'partner', 'namespace' => 'Partner'], function () {

            Route::group(['prefix' => 'vendors'], function () {

                Route::get('/',                 'VendorController@index' )->name('dashboard.partner.vendors');
                Route::get('create',            'VendorController@create')->name('dashboard.partner.vendors.create');
                Route::post('create',           'VendorController@store' )->name('dashboard.partner.vendors.store');
                Route::get('{id}/edit',         'VendorController@edit'  )->name('dashboard.partner.vendors.edit');
                Route::post('{id}/edit',        'VendorController@update')->name('dashboard.partner.vendors.update');
                Route::post('{id}/delete',      'VendorController@delete')->name('dashboard.partner.vendors.delete');

                Route::get('{id}/users/invite',         'UserController@create')->name('dashboard.partner.vendors.users.create');
                Route::post('{id}/users/invite',        'UserController@invite')->name('dashboard.partner.vendors.users.invite');
                Route::post('{id}/users/{uid}/delete',  'UserController@delete')->name('dashboard.partner.vendors.users.delete');

                Route::get('{id}/sites/create',         'SiteController@create'  )->name('dashboard.partner.vendors.sites.create');
                Route::post('{id}/sites/create',        'SiteController@store'   )->name('dashboard.partner.vendors.sites.store');
                Route::get('{id}/sites/requests', 'SiteController@requests')->name('dashboard.partner.vendors.sites.requests');
                Route::post('{id}/sites/delete',  'SiteController@delete'  )->name('dashboard.partner.vendors.sites.delete');
            });

            Route::group(['prefix' => 'requests'], function () {
                Route::get('/','RequestController@index' )->name('dashboard.partner.requests');
            });
        });

    });
});

// Root routes
Route::get('/', 'MainController@index')->name('index');
