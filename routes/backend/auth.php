<?php

use App\Http\Controllers\Backend\Auth\Role\RoleController;
use App\Http\Controllers\Backend\Auth\User\UserController;
use App\Http\Controllers\Backend\Auth\User\UserSocialController;
use App\Http\Controllers\Backend\Auth\User\UserStatusController;
use App\Http\Controllers\Backend\Auth\User\UserSessionController;
use App\Http\Controllers\Backend\Auth\User\UserPasswordController;
use App\Http\Controllers\Backend\Auth\User\UserConfirmationController;
use App\Http\Controllers\Backend\Profile\ProfileController;
use App\Http\Controllers\Backend\Message\MessageController;
use App\Http\Controllers\Backend\Price\PriceController;

// All route names are prefixed with 'admin.auth'.
Route::group(
    [
        'prefix' => 'auth',
        'as' => 'auth.',
        'namespace' => 'Auth',
        'middleware' => 'role:' . config('access.users.admin_role'),
    ],
    function () {
        // User Management
        Route::group(
            ['namespace' => 'User'],
            function () {

                // User Status'
                Route::get('user/deactivated', [UserStatusController::class, 'getDeactivated'])->name('user.deactivated');
                Route::get('user/deleted', [UserStatusController::class, 'getDeleted'])->name('user.deleted');

                // User CRUD
                Route::get('user', [UserController::class, 'index'])->name('user.index');
                Route::get('user/create', [UserController::class, 'create'])->name('user.create');
                Route::post('user', [UserController::class, 'store'])->name('user.store');

                // Specific User
                Route::group(
                    ['prefix' => 'user/{user}'],
                    function () {
                        // User
                        Route::get('/', [UserController::class, 'show'])->name('user.show');
                        Route::get('edit', [UserController::class, 'edit'])->name('user.edit');
                        Route::patch('/', [UserController::class, 'update'])->name('user.update');
                        Route::delete('/', [UserController::class, 'destroy'])->name('user.destroy');

                        // Account
                        Route::get('account/confirm/resend', [UserConfirmationController::class, 'sendConfirmationEmail'])->name('user.account.confirm.resend');

                        // Status
                        Route::get('mark/{status}', [UserStatusController::class, 'mark'])->name('user.mark')->where(['status' => '[0,1]']);

                        // Social
                        Route::delete('social/{social}/unlink', [UserSocialController::class, 'unlink'])->name('user.social.unlink');

                        // Confirmation
                        Route::get('confirm', [UserConfirmationController::class, 'confirm'])->name('user.confirm');
                        Route::get('unconfirm', [UserConfirmationController::class, 'unconfirm'])->name('user.unconfirm');

                        // Password
                        Route::get('password/change', [UserPasswordController::class, 'edit'])->name('user.change-password');
                        Route::patch('password/change', [UserPasswordController::class, 'update'])->name('user.change-password.post');

                        // Session
                        Route::get('clear-session', [UserSessionController::class, 'clearSession'])->name('user.clear-session');

                        // Deleted
                        Route::get('delete', [UserStatusController::class, 'delete'])->name('user.delete-permanently');
                        Route::get('restore', [UserStatusController::class, 'restore'])->name('user.restore');
                    }
                );
            }
        );

        // Role Management
        Route::group(
            ['namespace' => 'Role'],
            function () {
                Route::get('role', [RoleController::class, 'index'])->name('role.index');
                Route::get('role/create', [RoleController::class, 'create'])->name('role.create');
                Route::post('role', [RoleController::class, 'store'])->name('role.store');

                Route::group(
                    ['prefix' => 'role/{role}'],
                    function () {
                        Route::get('edit', [RoleController::class, 'edit'])->name('role.edit');
                        Route::patch('/', [RoleController::class, 'update'])->name('role.update');
                        Route::delete('/', [RoleController::class, 'destroy'])->name('role.destroy');
                    }
                );
            }
        );
    }
);

Route::group(
    [
        'prefix' => 'message',
        'as' => 'message.',
        'namespace' => 'Backend',
        'middleware' => 'role:' . config('access.users.admin_role'),
    ],
    function () {

        // Message Management
        Route::group(
            ['namespace' => 'Message'],
            function () {
                Route::get('all/index', [MessageController::class, 'allmessage'])->name('allmessage');
                Route::get('/type/{ messagetype }', [MessageController::class, 'getmessagetype'])->name('getmessage'); //

                //                Route::get('found/{{ here }}', [MessageController::class, 'foundyou'])->name('alex');

                Route::get('/index', [MessageController::class, 'index'])->name('index');
                Route::get('/typea', [MessageController::class, 'messageTypeA'])->name('typea');
                Route::get('/typeb', [MessageController::class, 'messageTypeB'])->name('typeb');
                Route::get('/typec', [MessageController::class, 'messageTypeC'])->name('typec');
                Route::get('/typed', [MessageController::class, 'messageTypeD'])->name('typed');
                Route::get('/type_unknown', [MessageController::class, 'messageTypeUnknown'])->name('typeunknown');
                // Route::get('/tablecount/{messagetype}/{pagination}', [MessageController::class, 'tableCount'])->name('tablecount');
                Route::get('/getmessage/{messagetype}', [MessageController::class, 'getmessagetype'])->name('getmessage');
            }
        );
    }
);

Route::group(
    [
        'prefix' => 'profile',
        'as' => 'profile.',
        'namespace' => 'Backend',
        'middleware' => 'role:' . config('access.users.admin_role'),
    ],
    function () {

        // Profile Management
        Route::group(
            ['namespace' => 'Profile'],
            function () {
                Route::get('', [ProfileController::class, 'profilepage'])->name('table1');
                Route::get('phone/{phone}', [ProfileController::class, 'profilepage'])->name('table');
                Route::get('/{phone}', [ProfileController::class, 'profile'])->name('phone');
            }
        );
    }
);


Route::group(
    [
        'prefix' => 'pricelist',
        'as' => 'pricelist.',
        'namespace' => 'Backend',
        'middleware' => 'role:' . config('access.users.admin_role'),
    ],
    function () {

        // price Management
        Route::group(
            ['namespace' => 'Price'],
            function () {
                Route::get('', [PriceController::class, 'delete'])->name('delete');
                Route::get('/price', [PriceController::class, 'priceList'])->name('pricedata');
                Route::get('/index', [PriceController::class, 'index'])->name('price');
                Route::get('/delete/{id}', [PriceController::class, 'delete'])->name('deletedata');
                Route::post('/update/{id}', [PriceController::class, 'update'])->name('update');
                Route::post('/add', [PriceController::class, 'addPrice'])->name('addprice');
            }
        );
    }
);
