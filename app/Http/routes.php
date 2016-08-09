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

Route::get('/', [
    'uses' => 'ProduitController@getIndex',
    'as' => 'produit.index'
]);
Route::get('/ajouter-au-panier/{id}', [
    'uses' => 'ProduitController@getAjouterAuPanier',
    'as' => 'produit.ajouterAuPanier'
]);
Route::get('/panier', [
    'uses' => 'ProduitController@getPanier',
    'as' => 'produit.panier'
]);
Route::get('/paiement', [
    'uses' => 'ProduitController@getPaiement',
    'as' => 'paiement',
    'middleware' => 'auth'
]);
Route::get('/vider-panier', [
    'uses' => 'ProduitController@viderPanier',
    'as' => 'vider.panier'
]);



Route::post('/paiement', [
    'uses' => 'ProduitController@postPaiement',
    'as' => 'paiement',
    'middleware' => 'auth'
]);

Route::get('/acces_non_autorise', function () {
    return view('errors.acces_non_autorise');
})->name('acces_non_autorise');

Route::group(['prefix' => 'admin'], function () {

    Route::group(['middleware' => ['EstAdmin']], function () {
        Route::get('/index', [
            'uses' => 'AdminController@getIndexAdmin',
            'as' => 'admin.index'
        ]);
    });

});


Route::group(['prefix' => 'utilisateur'], function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/inscription', [
            'uses' => 'UtilisateurController@getInscription',
            'as' => 'utilisateur.inscription'
        ]);
        Route::post('/inscription', [
            'uses' => 'UtilisateurController@postInscription',
            'as' => 'utilisateur.inscription'
        ]);
        Route::get('/connexion', [
            'uses' => 'UtilisateurController@getConnexion',
            'as' => 'utilisateur.connexion'
        ]);
        Route::post('/connexion', [
            'uses' => 'UtilisateurController@postConnexion',
            'as' => 'utilisateur.connexion'
        ]);
    });
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/profil', [
            'uses' => 'UtilisateurController@getProfil',
            'as' => 'utilisateur.profil'
        ]);
        Route::get('/deconnexion', [
            'uses' => 'UtilisateurController@getDeconnexion',
            'as' => 'utilisateur.deconnexion'
        ]);
    });
});

Route::group(['prefix' => 'mot-de-passe'], function () {
    Route::get('/reset/{token?}', [
        'uses' => 'PasswordController@showResetForm',
        'as' => 'mot-de-passe.reset'
    ]);
    Route::post('/email', 'PasswordController@sendResetLinkEmail');
    Route::post('/reset', 'PasswordController@reset');
});

