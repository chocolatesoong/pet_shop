<?php

namespace Config;

use App\Filters\AdminOnlyFilter;
use App\Filters\AlreadyLoggedInFilter;
use App\Filters\AuthCheckFilter;
use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array
     */
    public $aliases = [
        'csrf'     => CSRF::class,
        'toolbar'  => DebugToolbar::class,
        'honeypot' => Honeypot::class,
        'authcheck' => AuthCheckFilter::class,
        'alreadyloggedin' => AlreadyLoggedInFilter::class,
        'adminonly' => AdminOnlyFilter::class,
        'userlogin' => \App\Filters\UserLoginFilter::class,
        'guest' => \App\Filters\GuestFilter::class,
        'driverLogin' =>\App\Filters\DriverLoginFilter::class,
        'jwtauth' => \App\Filters\JWTAuthenticationFilter::class
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array
     */
    public $globals = [
        'before' => [
            // 'honeypot',
            'csrf' => ['except' => ['driver/*', 'api/*']],
        ],
        'after' => [
            'toolbar' => ['except' => ['api/*']],
            // 'honeypot',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['csrf', 'throttle']
     *
     * @var array
     */
    public $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array
     */
    public $filters = [];
}
