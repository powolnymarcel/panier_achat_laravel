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


Route::get('/mot-de-passe/reset/{token?}', [
    'uses' => 'PasswordController@showResetForm',
    'as' => 'mot-de-passe.reset'
]);
// Password Reset Routes...
Route::post('mot-de-passe/email', 'PasswordController@sendResetLinkEmail');
Route::post('mot-de-passe/reset', 'PasswordController@reset');