<?php

declare(strict_types=1);

use Composer\InstalledVersions;
use Console\ConsoleApplication;

/**
 * Class Application
 *
 * The Application class represents the core of the framework.
 * It is responsible for managing the application's lifecycle and components.
 *
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package Framework
 */
final class App extends Container
{
    protected $class = [
        'app'        => App::class,
        'config'     => Config::class,
        'session'    => Session\Session::class,
        'request'    => Http\Request::class,
        'response'   => Http\Response::class,
        'router'     => Http\Router::class,
        'view'       => Views\View::class,
        'controller' => App\Controllers\BaseController::class,
        'database'   => Database\Database::class,
        'validator'  => Validation\Validator::class,
        'auth'       => Auth\Auth::class,
        'console'    => Console\ConsoleApplication::class,
        // 'event'      => EventManager::class,
        // 'cache'      => Cache\Cache::class,
    ];

    /**
     * Constructor for the Application class.
     */
    public function __construct()
    {
        $this->setApp();
        $this->loadEnv();
        $this->registerProviders();
        $this->bootServices();
    }

    /**
     * Set instance app
     */
    private function setApp()
    {
        $this->singleton('app', fn () => $this);
    }

    /**
     *  Open the .env file
     */
    private function loadEnv(): void
    {
        Env::load(ROOT_PATH . DIRECTORY_SEPARATOR . '.env');
    }

    /**
     * Register service providers.
     *
     * This method reads the service provider configurations from the `providers.php` file
     * and registers them with the application container.
     */
    public function registerProviders()
    {
        $pathConfig = config('paths.providersPath') . DIRECTORY_SEPARATOR;
        $providers  = include $pathConfig . 'providers.php';
        $this->services(array_merge($this->class, $providers));
    }

    /**
     * Boot the services specified in the 'boot' configuration array.
     */
    public function bootServices()
    {
        $services = config('boot');
        $method = 'boot';

        foreach ($services ?? [] as $class) {
            $class::$method;
        }
    }

    /**
     * Check if the application is in production mode.
     * @return bool True if the application is in production mode, false otherwise.
     */
    public function isProduction(): bool
    {
        return env('APP_ENVIRONMENT') === 'production';
    }

    /**
     *  Get the current application environment.
     */
    public function getEnvironment()
    {
        return env('APP_ENVIRONMENT', 'production');
    }

    /**
     * Check if the user is logged in.
     */
    public function isLogged(): bool
    {
        return !empty($this->user);
    }

    /**
     * Set the user from the session variable.
     */
    private function getUser(): void
    {
        $this->user = function () {
            return $this->session->get('user', true);
        };
    }

    /**
     * Set the user from the session variable.
     */
    private function setUser(): void
    {
        $this->user = function () {
            return $this->session->set('user', true);
        };
    }

    /**
     * Attempts to log in a user based on provided data.
     *
     * @param array|array[] $fields An array or nested arrays containing the fields to use for the database query.
     * @param array|array[] $values An array or nested arrays containing the corresponding values to match in the database query.
     * @param callable|null $callback A callback function to execute upon successful login.
     * @return bool Returns true if the login is successful, false otherwise.
     * @throws \Exception Throws an exception in case of an error during the login process.
     */
    public function login(): bool
    {
        $instance = new Auth\Auth($this);
        return $instance->resolverLogin(...func_get_args());
    }

    /**
     * Log out the user.
     * @param string $path The optional path to redirect after logout.
     */
    public function logout(string $path = '/'): void
    {
        $this->session->flush();
        $this->response->redirect($path);
    }

    /**
     * Returns the time zone used by this application.
     * @see http://php.net/manual/en/function.date-default-timezone-get.php
     */
    public function getTimeZone(): string
    {
        return date_default_timezone_get();
    }

    /**
     * Sets the time zone used by this application.
     * @see http://php.net/manual/en/function.date-default-timezone-set.php
     */
    public function setTimeZone(string $timezone): void
    {
        date_default_timezone_set($timezone);
    }

    /**
     * Get the user's preferred locale based on the HTTP Accept-Language header.
     */
    public function getLocale(): string|false
    {
        if (!extension_loaded('intl'))
            throw new \Exception('The "Intl" extension is not enabled on this server');

        $http = \Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '');
        $locale = !empty($http) ? $http : 'en_US';

        return $locale;
    }

    /**
     * Generate security tokens, including CSRF tokens.
     */
    private function generateTokens(): string
    {
        return bin2hex(random_bytes(64) . time());
    }

    /**
     * Modify cookies for the CSRF token
     */
    public function setCsrfCookie(string $csrfToken): void
    {
        $expiration = config('session.expiration');
        setcookie('csrfToken', $csrfToken, time() + 60 * $expiration);
    }

    /**
     * Get the CSRF token. If the token is not present in the cookie, generate and set a new one.
     * @return string The generated or existing CSRF token.
     */
    public function getCsrfToken(): string
    {
        return isset($_COOKIE['csrfToken']) ? $_COOKIE['csrfToken'] : $this->generateAndSetCsrfToken();
    }

    /**
     * Generate a CSRF token and set it in the cookie.
     * @return string The newly generated CSRF token.
     */
    private function generateAndSetCsrfToken(): string
    {
        $csrfToken = $this->generateTokens();
        $this->setCsrfCookie($csrfToken);

        return $csrfToken;
    }

    /**
     * Check if the provided CSRF token matches the one in the session.
     */
    public function hasCsrfToken(string $token): bool
    {
        return $_COOKIE['csrfToken'] === $token;
    }

    /**
     * Get the version of a specified library.
     */
    public function version(string $libraryName = 'axm/axm'): ?string
    {
        $v = InstalledVersions::getVersion($libraryName);
        return $v;
    }

    /**
     * Get the user or a specific user property.
     */
    public function user(string $value = null)
    {
        if (is_null($value)) return $this->get('user');

        return $this
            ->get('user')
            ->{$value} ?? null;
    }

    /**
     * Remove a service identified by its alias from the container.
     * @param string $alias
     */
    public function removeService(string $alias)
    {
        return $this->remove($alias);
    }

    /**
     * Magic method to dynamically retrieve properties.
     * @return mixed The value of the retrieved property.
     */
    public function __get(string $name)
    {
        if ($name == 'user') {
            return $this->setUser();
        }

        return $this->get($name);
    }

    /**
     * Returns a new instance of the ConsoleApplication class
     * @return ConsoleApplication A new instance of the ConsoleApplication class.
     */
    public function createConsoleApplication()
    {
        static $console;
        return $console ??= new ConsoleApplication($this);
    }

    /**
     * Run the application.
     *
     * This method triggers events before and after handling the request 
     * and dispatches the router.
     */
    public function run(): void
    {
        (new Http\Router())
            ->openRoutesUser()
            ->dispatch();
    }
}