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

Route::get('/', function () {
    return redirect('/home');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth.checkrole:admin'], function() {
    // Rotas de CATEGORIA
    Route::group(['prefix' => 'categories', 'as' => 'categories.'], function() {
        Route::get('', ['as' => 'index', 'uses' => 'CategoriesController@index']);
        Route::get('/create', ['as' => 'create', 'uses' => 'CategoriesController@create']);
        Route::get('/edit/{id}', ['as' => 'edit', 'uses' => 'CategoriesController@edit']);
        Route::put('/update/{id}', ['as' => 'update', 'uses' => 'CategoriesController@update']);
        Route::post('/store', ['as' => 'store', 'uses' => 'CategoriesController@store']);
    });

    // Rotas de CLIENTE
    Route::group(['prefix' => 'clients', 'as' => 'clients.'], function() {
        Route::get('', ['as' => 'index', 'uses' => 'ClientsController@index']);
        Route::get('/create', ['as' => 'create', 'uses' => 'ClientsController@create']);
        Route::get('/edit/{id}', ['as' => 'edit', 'uses' => 'ClientsController@edit']);
        Route::put('/update/{id}', ['as' => 'update', 'uses' => 'ClientsController@update']);
        Route::post('/store', ['as' => 'store', 'uses' => 'ClientsController@store']);
    });

    // Rotas de PEDIDO
    Route::group(['prefix' => 'orders', 'as' => 'orders.'], function() {
        Route::get('', ['as' => 'index', 'uses' => 'OrdersController@index']);
        Route::get('/edit/{id}', ['as' => 'edit', 'uses' => 'OrdersController@edit']);
        Route::put('/update/{id}', ['as' => 'update', 'uses' => 'OrdersController@update']);
    });

    // Rotas de CUPOM
    Route::group(['prefix' => 'cupoms', 'as' => 'cupoms.'], function() {
        Route::get('', ['as' => 'index', 'uses' => 'CupomsController@index']);
        Route::get('/create', ['as' => 'create', 'uses' => 'CupomsController@create']);
        Route::post('/store', ['as' => 'store', 'uses' => 'CupomsController@store']);
        Route::get('/edit/{id}', ['as' => 'edit', 'uses' => 'CupomsController@edit']);
        Route::put('/update/{id}', ['as' => 'update', 'uses' => 'CupomsController@update']);
    });

    // Rotas de PRODUTO
    Route::group(['prefix' => 'products', 'as' => 'products.'], function() {
        Route::get('', ['as' => 'index', 'uses' => 'ProductsController@index']);
        Route::get('/create', ['as' => 'create', 'uses' => 'ProductsController@create']);
        Route::get('/edit/{id}', ['as' => 'edit', 'uses' => 'ProductsController@edit']);
        Route::put('/update/{id}', ['as' => 'update', 'uses' => 'ProductsController@update']);
        Route::post('/store', ['as' => 'store', 'uses' => 'ProductsController@store']);
        Route::get('/destroy/{id}', ['as' => 'destroy', 'uses' => 'ProductsController@destroy']);
    });
});

Route::group(['prefix' => 'customer', 'as' => 'customer.', 'middleware' => 'auth.checkrole:client'], function () {
    //Rotas de CHECKOUT
    Route::group(['prefix' => 'order', 'as' => 'order.' ], function () {
        Route::get('', ['as' => 'index', 'uses' => 'CheckoutController@index']);
        Route::get('/create', ['as' => 'create', 'uses' => 'CheckoutController@create']);
        Route::post('/store', ['as' => 'store', 'uses' => 'CheckoutController@store']);
        Route::get('/edit/{id}', ['as' => 'edit', 'uses' => 'CheckoutController@edit']);
        Route::put('/update/{id}', ['as' => 'update', 'uses' => 'CheckoutController@update']);
    });
});

// Rota para gerar oauth token
Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});

// Rotas de API
Route::group(['prefix' => 'api', 'as' => 'api.', 'middleware' => 'oauth'], function() {
    // Rota com dados do usuário logado
    Route::get('/authenticated', ['as' => 'authenticated', 'uses' => 'Api\UserController@authenticated']);
    //API CLIENTE
    Route::group(['prefix' => 'client', 'as' => 'client.', 'middleware' => 'oauth.checkrole:client'], function () {
        // Rotas para pedidos
        Route::resource('order',
            'Api\Client\ClientCheckoutController',
            ['except' => ['create', 'edit', 'destroy']]
        );
    });

    //API ENTREGADOR
    Route::group(['prefix' => 'deliveryman', 'as' => 'deliveryman.', 'middleware' => 'oauth.checkrole:deliveryman'], function () {
        // Rotas para pedidos
        Route::resource('order',
            'Api\Deliveryman\DeliverymanCheckoutController',
            ['except' => ['create', 'edit', 'destroy', 'store']]
        );

        // Rota para atualizar status do pedido
        Route::patch('order/{id}/update-status', ['as' => 'order.update-status', 'uses' => 'Api\Deliveryman\DeliverymanCheckoutController@updateStatus']);
    });
});
