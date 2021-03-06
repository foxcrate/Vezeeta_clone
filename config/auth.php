<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | here which uses session storage and the Eloquent user provider.
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | Supported: "session", "token"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],
        'patien' => [
            'driver' => 'session',
            'provider' => 'patien',
        ],
        'clinic' => [
            'driver' => 'session',
            'provider' => 'clinic',
        ],
        'hosptail' => [
            'driver' => 'session',
            'provider' => 'hosptail',
        ],
        'xray' => [
            'driver' => 'session',
            'provider' => 'xray',
        ],
        'labs' => [
            'driver' => 'session',
            'provider' => 'labs',
        ],
        'pharmacy' => [
            'driver' => 'session',
            'provider' => 'pharmacy',
        ],
        'doctor' => [
            'driver' => 'session',
            'provider' => 'doctors',
        ],
        'branch' => [
            'driver' => 'session',
            'provider' => 'branchs',
        ],
        'online_doctor' => [
            'driver' => 'session',
            'provider' => 'online_doctors',
        ],
        'nurse' => [
            'driver' => 'session',
            'provider' => 'nurses',
        ],


        'api' => [
            'driver' => 'jwt',
            'provider' => 'users',
            'hash' => false,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | If you have multiple user tables or models you may configure multiple
    | sources which represent each model / table. These sources may then
    | be assigned to any extra authentication guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\User::class,
        ],

        'admins' => [
            'driver' => 'eloquent',
            'model' => App\models\Admin::class,
        ],
        'patien' => [
            'driver' => 'eloquent',
            'model' => App\models\Patien::class,
        ],
        'clinic' => [
            'driver' => 'eloquent',
            'model' => App\models\Clinic::class,
        ],
        'hosptail' => [
            'driver' => 'eloquent',
            'model' => App\models\Hosptail::class,
        ],
        'xray' => [
            'driver' => 'eloquent',
            'model' => App\models\Xray::class,
        ],
        'labs' => [
            'driver' => 'eloquent',
            'model' => App\models\Lab::class,
        ],
        'pharmacy' => [
            'driver' => 'eloquent',
            'model' => App\models\Pharmacy::class,
        ],
        'doctors' => [
            'driver' => 'eloquent',
            'model' => App\models\Doctor::class,
        ],
        'branchs' => [
            'driver' => 'eloquent',
            'model' => App\models\Branch::class,
        ],
        'online_doctors' => [
            'driver' => 'eloquent',
            'model' => App\models\OnlineDoctor::class,
        ],
        'nurses' => [
            'driver' => 'eloquent',
            'model' => App\models\Nurse::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | You may specify multiple password reset configurations if you have more
    | than one user table or model in the application and you want to have
    | separate password reset settings based on the specific user types.
    |
    | The expire time is the number of minutes that the reset token should be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
        ],
        'patien' => [
            'provider' => 'patien',
            'table' => 'password_resets',
            'expire' => 60,
        ],
    ],

];
