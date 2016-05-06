<?php
Route::group(['middleware' => ['web']], function () {
    $s = 'social.';
    Route::get('/social/redirect/{provider}',   [
        'as' => $s . 'redirect',   
        'uses' => 'Gsdw\Social\Controllers\AuthController@getSocialRedirect'
        ]);
    Route::get('/social/handle/{provider}',     [
        'as' => $s . 'handle',     
        'uses' => 'Gsdw\Social\Controllers\AuthController@getSocialHandle'
    ]);
});
