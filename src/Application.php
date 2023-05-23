<?php

declare(strict_types=1);

namespace Axm;

use Axm;
use Axm\Container;
use Locale;
use Axm\Exception\AxmException;

/**
 * Class Application
 *
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package System
 */

abstract class Application
{
	const EVENT_BEFORE_REQUEST = 'beforeRequest';
	const EVENT_AFTER_REQUEST  = 'afterRequest';

	private ?Container $container;

	private string $socketToken;


	public function __construct($config)
	{
		Axm::setApplication($this);
		$this->preinit();
	}

	/**
	 * Get the container instance
	 */
	public function getContainer(): Container
	{
		return $this->container ??= Container::getInstance();
	}

	/**
	 * Pre-initialize the application
	 */
	private function preInit(): void
	{
		$this->getContainer()->load(APP_PATH . '/Config/Services');
		// $this->setupCustomContainer();
		$this->openConfigUser();
		$this->openRoutesUser();
		$this->generateTokens();
	}

	/**
	 * Open the user configuration file
	 */
	private function openConfigUser(): void
	{
		$this->config->load(APP_PATH . '/Config/App.php');
	}

	/**
	 * Get the application configuration
	 */
	public function config(string $key = '')
	{
		$key = strtolower($key);
		$config = $this->config;

		return empty($key) ? $config : (strpos($key, '/') ? $config->load($key) : $config->get($key));
	}

	/**
	 * Open the user routes configuration file
	 */
	private function openRoutesUser(): void
	{
		require_once APP_PATH . '/Config/Routes.php';
	}

	/**
	 * Generate security tokens
	 */
	private function generateTokens(): void
	{
		$this->generateCsrfToken();
	}

	/**
	 * Load a configuration file into the container
	 */
	public function load(string $path, string $root = APP_PATH): void
	{
		$path = cleanPath($root . $path);
		$path = str_replace('.', '/', $path);

		$this->container->load($path);
	}

	/**
	 * Set up the custom container configuration
	 */
	private function setupCustomContainer(): void
	{
		$this->container->load(APP_PATH . '/Config/Services');
	}

	/**
	 * Check if the application is in production mode
	 */
	public function isProduction(): bool
	{
		return Axm::isProduction();
	}

	/**
	 * Check if the user is logged in
	 */
	public function isLogged(): bool
	{
		return !empty($this->user);
	}

	/**
	 * Set the user from the session variable
	 */
	private function setUser(): void
	{
		$this->user = function () {
			return $this->session->get('user', true);
		};
	}

	/**
	 * Log out the user
	 */
	public function logout(string $path = '/'): void
	{
		$this->session->flush();
		$this->response->redirect($path);
	}

	/**
	 * Gets the event handler intent
	 */
	public function event()
	{
		return $this->event;
	}


	/**
	 * Calls an event 
	 * @return true if the specified event exists and false if not
	 */
	public function getEvent(string $eventName): array
	{
		return $this->event->getEvent($eventName);
	}

	/**
	 * Calls events recursively if they exist
	 */
	public function registerEvent(string $eventName, callable $callback)
	{
		if (!$this->event->hasEvent($eventName)) {          // check if event exists before triggering it 

			$this->event->onEvent($eventName, $callback);  // register the event 
		}
	}

	/**
	 * Returns the time zone used by this application.
	 * This is a simple wrapper of PHP function date_default_timezone_get().
	 * @return string the time zone used by this application.
	 * @see http://php.net/manual/en/function.date-default-timezone-get.php
	 */
	public function getTimeZone(): string
	{
		return date_default_timezone_get();
	}

	/**
	 * Sets the time zone used by this application.
	 * This is a simple wrapper of PHP function date_default_timezone_set().
	 * @param string $value the time zone used by this application.
	 * @see http://php.net/manual/en/function.date-default-timezone-set.php
	 */
	public function setTimeZone(string $timezone): void
	{
		date_default_timezone_set($timezone);
	}

	/**
	 * 
	 */
	public function getLocale()
	{
		if (!isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
			return '';
		}

		if (!extension_loaded('intl')) {
			throw new AxmException('The "intl" extension is not enabled on this server');
		}

		return Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']);
	}

	/**
	 * Generate token CSRF 
	 * 
	 **/
	public function generateCsrfToken(): string
	{
		if (empty($_SESSION['csrfToken']))
			$token = $_SESSION['csrfToken'] = bin2hex(random_bytes(50) . time());
		else
			$token = $_SESSION['csrfToken'];

		return $token;
	}

	/**
	 * Check token de session id
	 * 
	 **/
	public function hasCsrfToken(string $token): bool
	{
		return ($_SESSION['csrfToken'] === $token);
	}

	/**
	 * Get token CSRF */
	public function getCsrfToken(): ?string
	{
		return $_SESSION['csrfToken'] ?? $this->generateCsrfToken();
	}

	/**
	 * Check token de session id
	 * 
	 **/
	public function checkSoketToken(string $token): bool
	{
		return $this->socketToken === $token;
	}

	/**
	 * devuelve todos los helpers agregados 
	 * @return array
	 * */
	public function getHelpers(): array
	{
		return $this->helpers;
	}

	/**
	 * 
	 */
	public function user(string $value = null)
	{
		if (is_null($value)) {
			return $this->container->get('user');
		}

		return $this->container->get('user')->{$value} ?? null;
	}

	/**
	 * 
	 */
	public function addService($name, $value)
	{
		$this->container->set($name, $value);
	}

	/**
	 * 
	 */
	public function getService(string $alias)
	{
		return $this->container->get($alias);
	}

	/**
	 * 
	 */
	public function getServices()
	{
		return $this->container->getServices();
	}

	/**
	 * 
	 */
	public function hasService(string $alias): bool
	{
		return $this->container->has($alias);
	}

	/**
	 * 
	 */
	public function removeService(string $alias)
	{
		return $this->container->remove($alias);
	}

	/**
	 * 
	 */
	public function __get($name)
	{
		if ($name === 'user') {
			$this->setUser();
		}

		return $this->container->get($name);
	}

	/**
	 * 
	 */
	public function __set($name, $value)
	{
		$this->container->set($name, $value);
	}

	/**
	 * 
	 */
	public function __isset($name)
	{
		return $this->container->has($name);
	}

	/**
	 * 
	 */
	public function __unset($name)
	{
		$this->container->remove($name);
	}

	/**
	 * Run the application
	 */
	public function run(): void
	{
		$this->event->triggerEvent(self::EVENT_BEFORE_REQUEST);
		$this->router->dispatch();
		$this->event->triggerEvent(self::EVENT_AFTER_REQUEST);
	}
}
