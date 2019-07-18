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

Route::get('test-broadcast', function () {
    broadcast(new \App\Events\ExampleEvent);
});

/* Kayıt ve giriş giriş için varsayılan rotes'lar */
Auth::routes();
Route::get('/home', ['as' => 'home', 'uses' => 'IndexController@home']);

Route::get('/auth/register/verify/email/{userId}/{verificationCode}', [
    'as' => 'auth.register.verify.email',
    'uses' => 'Auth\TwoStepVerificationController@getUserRegisterEmailCode',
]);
/* Auth grubu */
Route::group([
    'as' => 'auth.',
    'middleware' => ['auth'],
    'namespace' => 'Auth',
    'prefix' => 'auth',
], function () {

    Route::group(['as' => 'register.', 'prefix' => 'register'], function () {
        Route::group(['as' => 'verify.', 'prefix' => 'verify'], function () {
            Route::post('/phone', [
                'as' => 'phone',
                'uses' => 'TwoStepVerificationController@getUserRegisterPhoneCode',
            ]);
            Route::post('/2fa', [
                'as' => '2fa',
                'uses' => 'TwoStepVerificationController@getGoogle2FaRegisterVerify',
            ]);
        });
        Route::group(['as' => 'send.', 'prefix' => 'send'], function () {
            Route::post('/call', [
                'as' => 'call',
                'uses' => 'TwoStepVerificationController@setUserRegisterPhoneCallCode',
            ]);
        });
    });


    Route::group(['as' => 'login.', 'prefix' => 'login'], function () {
        Route::group(['as' => 'verify.', 'prefix' => 'verify'], function () {
            Route::post('/phone', [
                'as' => 'phone',
                'uses' => 'TwoStepVerificationController@getUserLoginPhoneCode',
            ]);
            Route::post('/2fa', [
                'as' => '2fa',
                'uses' => 'TwoStepVerificationController@getGoogle2FaLoginVerify',
            ]);
        });
        Route::group(['as' => 'send.', 'prefix' => 'send'], function () {
            Route::post('/call', [
                'as' => 'call',
                'uses' => 'TwoStepVerificationController@setUserLoginPhoneCallCode',
            ]);
        });
    });
});

/* Test  */
Route::get('/test',
    ['as' => 'show', 'uses' => 'Template\TemplateController@getExchangeMenu']);

/* Home için route */
Route::get('/', ['as' => 'index', 'uses' => 'IndexController@index']);

/* İletişim grubu */
Route::group([
    'as' => 'contact.',
    'namespace' => 'Contact',
    'prefix' => 'contact',
], function () {

    /* İletişim için index sayfası */
    Route::get('/', ['as' => 'index', 'uses' => 'ContactController@index']);

    Route::post('/', ['as' => 'store', 'uses' => 'ContactController@store']);
});

/* Grafikler için grup */
Route::group([
    'as' => 'graphic.',
    'namespace' => 'Graphic',
    'prefix' => 'graphic',
], function () {

    /* Mum grafikleri için grup */
    Route::group(['as' => 'candlestick.', 'prefix' => 'candlestick'],
        function () {

            /* İstelen grafiği exchange id'sini baz alarak uuid kısıtlaması ile json olarak döndüren fonksiyon */
            Route::get('/{id?}', [
                'where' => ['id' => '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}'],
                'as' => 'index',
                'uses' => 'CandlestickController@index',
            ]);
        });

});

/* Destek grubu */
Route::group([
    'as' => 'support.',
    'namespace' => 'Support',
    'prefix' => 'support',
], function () {

    /* Destek için index sayfası */
    Route::get('/', ['as' => 'index', 'uses' => 'SupportController@index']);
});

/* Duyurular gurubu */
Route::group([
    'as' => 'announcement.',
    'namespace' => 'Announcement',
    'prefix' => 'announcement',
], function () {

    /* Duyuru için index sayfası */
    Route::get('/',
        ['as' => 'index', 'uses' => 'AnnouncementController@index']);
});

/* Blog grubu */
Route::group(['as' => 'blog.', 'namespace' => 'Blog', 'prefix' => 'blog'],
    function () {

        /* Blog için index sayfası */
        Route::get('/', ['as' => 'index', 'uses' => 'BlogController@index']);
    });

/* Dashboard grubu */
Route::group([
    'as' => 'dashboard.',
    'namespace' => 'Dashboard',
    'middleware' => ['auth',/*'twostep'*/],
    'prefix' => 'dashboard',
], function () {

    /* Dashboard için index sayfası */
    Route::get('/', ['as' => 'index', 'uses' => 'DashboardController@index']);

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
            'as' => 'index',
            'uses' => 'ExchangeController@index',
        ]);

        Route::post('/sell/{buying_name?}/{selling_name?}', [
            'where' => [
                'buying_name' => '[a-zA-Z0-9]+',
                'selling_name' => '[a-zA-Z0-9]+',
            ],
            'as' => 'sell',
            'uses' => 'ExchangeController@sell',
        ]);

        Route::post('/buy/{buying_name?}/{selling_name?}', [
            'where' => [
                'buying_name' => '[a-zA-Z0-9]+',
                'selling_name' => '[a-zA-Z0-9]+',
            ],
            'as' => 'buy',
            'uses' => 'ExchangeController@buy',
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

                Route::get('/create',
                    ['as' => 'create', 'uses' => 'UserTicketController@create']);
            });

            /* Aktivite grubu */
            Route::group([
                'as' => 'activity.',
                'namespace' => 'Activity',
                'prefix' => 'activity',
            ], function () {


                /* Hesap aktivetesi grubu */
                Route::group(['as' => 'account.', 'prefix' => 'account', 'namespace' => 'Account',],
                    function () {

                        /* Hesap aktivetesi show sayfası  (auth işlemleri logları) */
                        Route::get('/', [
                            'as' => 'index',
                            'uses' => 'UserActivityAccountController@index',
                        ]);
                        /* Hesap aktivetesi show sayfası  (auth işlemleri logları) */
                        Route::post('/show', [
                            'as' => 'show',
                            'uses' => 'UserActivityAccountController@show',
                        ]);
                    });

                /* Finansal aktiviteler grubu */
                Route::group(['as' => 'financial.', 'prefix' => 'financial', 'namespace' => 'Financial',],
                    function () {

                        /* Finansal aktivite show sayfası (para yatırma çekme işlemleri logları) */
                        Route::get('/', [
                            'as' => 'index',
                            'uses' => 'UserActivityFinancialController@index',
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

            /* Profil grubu */
            Route::group([
                'as' => 'profile.',
                'namespace' => 'Profile',
                'prefix' => 'profile',
            ], function () {

                /* Profil için index sayfası */
                Route::get('/', [
                    'as' => 'index',
                    'uses' => 'UserProfileController@index',
                ]);
            });

            /* Bakiyeler grubu */
            Route::group([
                'as' => 'balance.',
                'namespace' => 'Balance',
                'prefix' => 'balance',
            ], function () {
                /* kripto grubu */
                Route::group(['as' => 'crypto.', 'prefix' => 'crypto',  'namespace' => 'Crypto'],
                    function () {
                        /* çekme için koin adı */
                        Route::get('/', [
                            'as' => 'index',
                            'uses' => 'UserBalanceCryptoController@index',
                        ]);

                        Route::post('/deposit', [
                            'as' => 'deposit',
                            'uses' => 'UserBalanceCryptoController@deposit',
                        ]);

                        Route::post('/withdraw', [
                            'as' => 'withdraw',
                            'uses' => 'UserBalanceCryptoController@withdraw',
                        ]);

                        Route::post('/getwithdraw', [
                            'as' => 'getwithdraw',
                            'uses' => 'UserBalanceCryptoController@getWithdraw',
                        ]);

                        Route::post('/getwithdrawConfirm', [
                            'as' => 'getWithdrawConfirm',
                            'uses' => 'UserBalanceCryptoController@getWithdrawConfirm',
                        ]);

                        Route::post('/gethistory', [
                            'as' => 'getHistory',
                            'uses' => 'UserBalanceCryptoController@getHistory',
                        ]);

                        Route::post('/getpending', [
                            'as' => 'getPending',
                            'uses' => 'UserBalanceCryptoController@getPending',
                        ]);

                        Route::post('/withdrawCancel', [
                            'as' => 'withdrawCancel',
                            'uses' => 'UserBalanceCryptoController@withdrawCancel',
                        ]);


                    });
                Route::group(['as' => 'local.', 'prefix' => 'local',  'namespace' => 'Local'],
                    function () {
                        /* çekme için koin adı */
                        Route::get('/', [
                            'as' => 'index',
                            'uses' => 'UserBalanceLocalController@index',
                        ]);

                        Route::post('/deposit', [
                            'as' => 'deposit',
                            'uses' => 'UserBalanceLocalController@deposit',
                        ]);

                        Route::post('/withdraw', [
                            'as' => 'withdraw',
                            'uses' => 'UserBalanceLocalController@withdraw',
                        ]);

                        Route::post('/getwithdraw', [
                            'as' => 'getwithdraw',
                            'uses' => 'UserBalanceLocalController@getWithdraw',
                        ]);

                        Route::post('/getwithdrawConfirm', [
                            'as' => 'getWithdrawConfirm',
                            'uses' => 'UserBalanceLocalController@getWithdrawConfirm',
                        ]);

                        Route::post('/gethistory', [
                            'as' => 'getHistory',
                            'uses' => 'UserBalanceLocalController@getHistory',
                        ]);

                        Route::post('/getpending', [
                            'as' => 'getPending',
                            'uses' => 'UserBalanceLocalController@getPending',
                        ]);

                        Route::post('/withdrawCancel', [
                            'as' => 'withdrawCancel',
                            'uses' => 'UserBalanceLocalController@withdrawCancel',
                        ]);



                    });
            });

        });
});
