<?php

use Illuminate\Http\Request;

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

/* Api namespace */
Route::group([
    'as' => 'api.',
    'namespace' => 'Api',
], function () {

    /* Home için route */
    Route::get('/test', ['as' => 'test', 'uses' => 'HomeController@test']);
    Route::post('/test', ['as' => 'test', 'uses' => 'HomeController@test']);

    /* Home için route */
    Route::get('/', ['as' => 'index', 'uses' => 'HomeController@index']);

    /* Blog grubu */
    Route::group(['as' => 'blog.', 'namespace' => 'Blog', 'prefix' => 'blog'],
        function () {

            /* Blog için index sayfası */
            Route::get('/', ['as' => 'index', 'uses' => 'BlogController@index']);

            /* Blog için slug show */
            Route::get('/{slug}', ['as' => 'show', 'uses' => 'BlogController@show']);
        });

    /* Duyuru grubu */
    Route::group(['as' => 'announcement.', 'namespace' => 'Announcement', 'prefix' => 'announcement'],
        function () {

            /* Duyuru için index sayfası */
            Route::get('/', ['as' => 'index', 'uses' => 'AnnouncementController@index']);

            /* Duyuru için show */
            Route::get('/{slug}', ['as' => 'show', 'uses' => 'AnnouncementController@show']);
        });

    /* İletişim grubu */
    Route::group([
        'as' => 'contact.',
        'namespace' => 'Contact',
        'prefix' => 'contact',
    ], function () {

        /* İletişim post */
        Route::post('/', ['as' => 'store', 'uses' => 'ContactController@store']);
    });


    /* Dashboard grubu */
    Route::group([
        'as' => 'dashboard.',
        'namespace' => 'Dashboard',
        'prefix' => 'dashboard',
        'middleware' => 'auth:api'
    ], function () {

        /* Dashboard için index sayfası */
        Route::get('/', ['as' => 'index', 'uses' => 'IndexController@index']);

        /* Exchange Grubu */
        Route::group([
            'as' => 'exchange.',
            'namespace' => 'Exchange',
            'prefix' => 'exchange',
        ], function () {

            /* Exchange için show sayfası A-Z 0-9 arası url kabul eder TL/BTC gibi */
            Route::get('{buying_name?}/{selling_name?}', [
                'where' => [
                    'buying_name' => '[a-zA-Z0-9]+',
                    'selling_name' => '[a-zA-Z0-9]+',
                ],
                'as' => 'show',
                'uses' => 'ExchangeController@show',
            ]);
        });

        /* Kullanıcı grubu  */
        Route::group(['as' => 'user.', 'namespace' => 'User', 'prefix' => 'user'],
            function () {

                /* ticket grubu */
                Route::group([
                    'as' => 'ticket.',
                    'namespace' => 'Ticket',
                    'prefix' => 'ticket',
                ], function () {

                    /* Ticket için index sayfası */
                    Route::get('/',
                        ['as' => 'index', 'uses' => 'UserTicketController@index']);
                });

                /* Aktivite grubu */
                Route::group([
                    'as' => 'activity.',
                    'namespace' => 'Activity',
                    'prefix' => 'activity',
                ], function () {

                    /* Hesap aktivetesi grubu */
                    Route::group(['as' => 'account.', 'prefix' => 'account'],
                        function () {

                            /* Hesap aktivetesi show sayfası  (auth işlemleri logları) */
                            Route::get('/', [
                                'as' => 'show',
                                'uses' => 'UserActivityAccountController@show',
                            ]);
                        });

                    /* Finansal aktiviteler grubu */
                    Route::group(['as' => 'financial.', 'prefix' => 'financial'],
                        function () {

                            /* Finansal aktivite show sayfası (para yatırma çekme işlemleri logları) */
                            Route::get('/', [
                                'as' => 'show',
                                'uses' => 'UserActivityFinancialController@show',
                            ]);
                        });

                });

                /* Hesap onay grubu */
                Route::group([
                    'as' => 'confirmation.',
                    'namespace' => 'Confirmation',
                    'prefix' => 'confirmation',
                ], function () {

                    /* Hesap onayı için show */
                    Route::get('/', [
                        'as' => 'show',
                        'uses' => 'UserConfirmationController@show',
                    ]);
                });

                /* Ayarlar grubu */
                Route::group([
                    'as' => 'settings.',
                    'namespace' => 'Settings',
                    'prefix' => 'settings',
                ], function () {

                    /* Ayalar için index sayfası */
                    Route::get('/', [
                        'as' => 'index',
                        'uses' => 'UserSettingsController@index',
                    ]);
                });

                /* Bakiyeler grubu */
                Route::group([
                    'as' => 'balance.',
                    'namespace' => 'Balance',
                    'prefix' => 'balance',
                ], function () {

                    /* tüm bakiyeleri için index */
                    Route::get('/all',
                        ['as' => 'all', 'uses' => 'UserBalanceController@index']);

                    /* yatırma işlemleri grubu */
                    Route::group(['as' => 'deposit.', 'prefix' => 'deposit'],
                        function () {

                            /* yatırma için koin adı */
                            Route::get('/{name?}', [
                                'where' => ['name' => '[a-zA-Z0-9]+'],
                                'as' => 'show',
                                'uses' => 'UserBalanceDepositController@show',
                            ]);
                        });

                    /* çekme grubu */
                    Route::group(['as' => 'withdraw.', 'prefix' => 'withdraw'],
                        function () {

                            /* çekme için koin adı */
                            Route::get('/{name?}', [
                                'where' => ['name' => '[a-zA-Z0-9]+'],
                                'as' => 'show',
                                'uses' => 'UserBalanceWithdrawController@show',
                            ]);
                        });
                });

            });
    });

    /* Auth işlemleri */
    Route::group([
        'as' => 'auth.',
        'namespace' => 'Auth',
        'prefix' => 'auth',
    ], function () {

        /* Kayıt */
        Route::post('/register', [
            'as' => 'register',
            'uses' => 'RegisterController@register',
        ]);

        /* Giriş */
        Route::post('/login', [
            'as' => 'login',
            'uses' => 'LoginController@login',
        ]);

        /* Api middleware login kontrolü */
        Route::group([
            'middleware' => 'auth:api'
        ], function () {
            Route::get('/logout', [
                'as' => 'logout',
                'uses' => 'LoginController@logout',
            ]);

            /* kayıt route grubu */
            Route::group(['as' => 'register.', 'prefix' => 'register'], function () {
                /* doğrulama route grubu */
                Route::group(['as' => 'verify.', 'prefix' => 'verify'], function () {
                    /* Telefon doğrula */
                    Route::post('/phone', [
                        'as' => 'phone',
                        'uses' => 'TwoStepVerificationController@getUserRegisteredPhoneCode',
                    ]);
                    /* 2fa doğrula */
                    Route::post('/2fa', [
                        'as' => '2fa',
                        'uses' => 'TwoStepVerificationController@getGoogle2FaRegisterVerify',
                    ]);
                });

                /* gönder */
                Route::group(['as' => 'send.', 'prefix' => 'send'], function () {

                    /* çağrı */
                    Route::post('/call', [
                        'as' => 'call',
                        'uses' => 'TwoStepVerificationController@setUserRegisteredPhoneCallCode',
                    ]);
                });
            });
        });
    });
});






