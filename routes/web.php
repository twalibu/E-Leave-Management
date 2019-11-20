<?php
Route::group(array('middleware' => 'web'),function() {

    Route::get('/','LoginController@getLogin');

    Route::post('/login', array(
        'as' => 'login',
        'uses' => 'LoginController@login'
    ));

    Route::get('forgot-password','LoginController@forgotPassword');
    Route::get('reset-password/{email}/{resetCode}','LoginController@resetPassword');
    Route::post('reset-password/{email}/{resetCode}','LoginController@postPassword');
    Route::get('activate/{email}/{activationCode}', array('as' => 'activate', 'uses' => 'EleaveController@getActivate'));

    Route::post('get-password','LoginController@getPassword');


    Route::group(array('middleware' => 'admin'),function() {

        Route::post('setting','EleaveController@settingEdit');
        Route::post('show_smtp','EleaveController@smtpShow');
        Route::post('update_smtp','EleaveController@smtpUpdate');
        Route::post('reset_smtp','EleaveController@smtpReset');

        Route::get('users', 'AdminController@userProfile');
        Route::get('users-create', 'AdminController@createUser');
        Route::get('leave_archive/{id}', 'AdminController@showArchive');
        Route::get('user-application', 'EleaveController@userApplication');
        Route::get('settings', 'EleaveController@setting');

        Route::post('createnew', [
            'as' => 'createnew',
            'uses' => 'EleaveController@registration'
        ]);

        Route::post('delete_des','EleaveController@deleteDes');

        Route::post('edit_des','EleaveController@editDes');

    });



    Route::group(array('middleware' => 'user') ,function() {


        Route::get('/home', 'AdminController@dashboard');

        Route::get('apply-leave', 'EleaveController@applyLeave');

        Route::get('my-application/{name}', 'EleaveController@requestLeave');



        Route::get('logout', 'AdminController@getLogout');
        Route::post('add_des', 'AdminController@addDesignation');

        Route::post('data_send', [
            'as' => 'sendajax',
            'uses' => 'EleaveController@senddata'
        ]);

        Route::post('fetch_data', [
            'as' => 'fetch_data',
            'uses' => 'EleaveController@fetchData'
        ]);

        Route::post('data_fetch', [
            'as' => 'notify',
            'uses' => 'EleaveController@notifyData'
        ]);

        Route::post('accept_application', [
            'as' => 'accept_app',
            'uses' => 'EleaveController@acceptApp'
        ]);

        Route::post('reject_application', [
            'as' => 'reject_app',
            'uses' => 'EleaveController@rejectApp'
        ]);


        Route::get('profile', 'EleaveController@profile');

        Route::get('user_profile', 'EleaveController@profile');

        Route::post('delete-user',[
            'as'=>'delete-user',
            'uses'=>'AdminController@delete'
        ]);

        Route::post('notification',[
            'as'=>'clear-notification',
            'uses'=>'EleaveController@clearNotification'
        ]);

        Route::post('update',[
            'as'=>'editinfo',
            'uses'=>'EleaveController@updateInfo'
        ]);

        Route::post('change_password',[
            'as'=>'change_password',
            'uses'=>'EleaveController@updatePassword'
        ]);

        Route::post('pic_change',[
            'as'=>'profile_pic',
            'uses'=>'EleaveController@profilePic'
        ]);

        Route::post('leave_report', [
            'as' => 'leave_report',
            'uses' => 'EleaveController@leaveReport'
        ]);

    });


});