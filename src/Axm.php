<?php

use Axm\Application;
use Axm\Exception\AxmException;
use Axm\Exception\AxmCLIException;

/**
 * AXM Framework PHP.
 *
 * @author Juan Cristobal <juancristobalgd1@gmail.com>
 * @link http://www.axm.com/
 * @copyright 2021-2022 AXM Software LLC
 * @license http://www.axm.com/license/
 * @package AXM\System
 * @since 1.0
 */
class Axm
{

	private static $framework = 'Axm Framework';  // Nombre idenficador del framework

	/**
	 * @var array class map used by the AXM autoloading mechanism.
	 * The array keys are the class names and the array values are the corresponding class file paths.
	 * @since 1.1.5
	 */
	public static $classMap = [];

	/**
	 * Request path to use.
	 *
	 * @var string
	 */
	protected $path;

	public  static $_environment;
	private static $_app;


	/**
	 * 
	 */
	private static function initialize()
	{
		//agregar las constantes del framework
		self::boot();

		// Initialize system handlers 
		self::initSystemHandlers();

		// detect environment 
		self::iniatilezeEnvironment();
	}


	/**
	 * Inicia la aplicación cargando el archivo de bootstrap especificado.
	 *
	 * @param string $bootstrapFileName El nombre del archivo de bootstrap.
	 * @throws Exception Si el archivo de bootstrap no se puede cargar o no es legible.
	 */
	public static function boot(string $bootstrapFileName = 'bootstrap.php'): void
	{
		$bootstrapPath = __DIR__ . DIRECTORY_SEPARATOR . $bootstrapFileName;
		require_once $bootstrapPath;
	}


	/**
	 * Initializes the error handlers.
	 */
	protected static function initSystemHandlers()
	{
		if (env('AXM_ENABLE_EXCEPTION_HANDLER', true)) {
			set_exception_handler(fn ($e) => self::handleException($e));
		}

		if (env('AXM_ENABLE_ERROR_HANDLER', true)) {
			set_error_handler([self::class, 'handleError'], error_reporting());
		}
	}


	/**
	 * Maneja y muestras las expeciones de la app 
	 */
	private static function handleException(\Throwable $e)
	{
		// disable error capturing to avoid recursive errors
		restore_error_handler();
		restore_exception_handler();

		if (is_cli()) {
			return self::throwCLIDisplay($e);
		}

		return AxmException::handleException($e);
	}


	/**
	 * Displays the captured PHP error.
	 * This method displays the error in HTML when there is
	 * no active error handler.
	 * @param integer $code error code
	 * @param string $message error message
	 * @param string $file error file
	 * @param string $line error line
	 */
	public static function handleError($code, $msg, $file, $line)
	{
		// disable error capturing to avoid recursive errors
		restore_error_handler();
		restore_exception_handler();

		$e = (object) [
			'code'    => $code,
			'message' => $msg ?? '(null)',
			'file'    => $file,
			'line'    => $line,
			'traces'  => debug_backtrace()
		];

		if (is_cli()) {
			return self::throwCLIDisplay($e);
		}

		return AxmException::handleError($e);
	}


	/**
	 * Muestra las exxepciones tipo CLI
	 */
	public static function throwCLIDisplay(\Throwable $e): AxmCLIException
	{
		return AxmCLIException::handleCLIException($e);
	}



	/**
	 * Inicia el entorno y configura el manejo de errores.
	 */
	private static function iniatilezeEnvironment()
	{
		// Obtener el valor de AXM_ENVIRONMENT o usar un valor predeterminado.
		static::$_environment = $environment = env('AXM_ENVIRONMENT', 'production');

		// Configurar el manejo de errores basado en el entorno.
		if ($environment === 'debug') {
			error_reporting(E_ALL);
			ini_set('display_errors', '1');
		} else {
			error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
			ini_set('display_errors', '0');
		}
	}


	/**
	 * Creates an application of the specified class.
	 * 
	 * @param string $class the application class name
	 * @param mixed $config application configuration. This parameter will be passed as the parameter
	 * to the constructor of the application class.
	 * @return mixed the application instance
	 */
	public static function iniApplication()
	{
		return self::createApplication('Axm\\IniApplication');
	}


	/**
	 * Intancia una clase de la aplicacion
	 * 
	 * @param string $class
	 * @param mixed $config
	 */
	private static function createApplication(string $class, $config = null)
	{
		static::initialize();
		return new $class($config);
	}


	/**
	 * Creates a console application instance.
	 * @param mixed $config application configuration.
	 * If a string, it is treated as the path of the file that contains the configuration;
	 * If an array, it is the actual configuration information.
	 * @return Console
	 */
	public static function createConsoleApplication($config = null)
	{
		return self::createApplication('Axm\\Console\\ConsoleApplication', $config);
	}


	/**
	 * @return string the version of AXM framework
	 */
	public static function getVersion()
	{
		return AXM_VERSION;
	}


	/**
	 * @return string the name of framework
	 */
	public static function getName()
	{
		return self::$framework;
	}


	/**
	 * @return string the path of the framework
	 */
	public static function getFrameworkPath()
	{
		return AXM_PATH;
	}


	/**
	 * Gets the application singleton or a registered service instance.
	 *
	 * @param string|null $alias The service alias to get or register.
	 * @param Closure|null $callback The callback function to create the service.
	 * @param bool $shared Whether the service instance should be shared across requests.
	 * 
	 * @return mixed|null The application singleton, the requested service instance, or null if not found.
	 *
	 * @throws InvalidArgumentException if attempting to register a service with an existing alias.
	 * @throws RuntimeException if attempting to get a non-existent service.
	 * 	
	 * Example:
	 * 
	 *  Axm::app('user', function () {
	 *		return new \App\Models\User();
	 *	}, false);
	 *
	 *	Axm::app()->hasService('user');
	 *
	 *	$n = Axm::app('user');
	 */
	public static function app(?string $alias = null, Closure $callback = null, bool $shared = false)
	{
		if ($alias === null && $callback === null) {
			return self::getSingleton();
		}

		if ($alias !== null && $callback === null) {

			$service = self::$_app->getServices($alias);
			if ($service === null) {
				throw new RuntimeException("Service '{$alias}' not found.");
			}

			return $service;
		}

		if (self::$_app->hasService($alias)) {
			return;
		}

		self::$_app->addService($alias, $callback, $shared);
		return;
	}


	/**
	 * Devuelve la instancia de la app
	 */
	private static function getSingleton(): ?Application
	{
		return self::$_app;
	}

	/**
	 * 
	 */
	public static function getEnvironment()
	{
		return static::$_environment;
	}

	/**
	 * 
	 */
	public static function isProduction(): bool
	{
		return static::$_environment === AXM_ENV_PRODUCTION;
	}


	/**
	 * Returns an array with our basic performance stats collected.
	 */
	public static function getPerformanceStats(): array
	{
		return [
			'startTime' => AXM_BEGIN_TIME,
			'totalTime' => (microtime(true) - AXM_BEGIN_TIME),
		];
	}

	/**
	 * Stores the application instance in the class static member.
	 * This method helps implement a singleton pattern for Application.
	 * Repeated invocation of this method or the Application constructor
	 * will cause the throw of an exception.
	 * To retrieve the application instance, use {@link app()}.
	 * @param Application $app the application instance. If this is null, the existing
	 * application singleton will be removed.
	 * @throws AxmException if multiple application instances are registered.
	 */
	public static function setApplication(Application $app): void
	{
		if (self::$_app !== null) {
			throw new AxmException(Axm::t('axm', 'Axm application can only be created once.'));
		}

		self::$_app = $app;
	}

	/**
	 * método de traducción que permite traducir mensajes en el sistema. 
	 * Si se proporciona la aplicación, se usará el objeto de aplicación para buscar la traducción. 
	 * La categoría de la traducción y el mensaje original se pasan como argumentos. 
	 * Si se proporcionan parámetros, se reemplazan en el mensaje original y se devuelve el mensaje resultante.
	 */
	public static function t($category, $message, $params = [], $language = null)
	{
		$source = ($category === 'axm') ? 'coreMessages' : 'messages';

		$message = vsprintf($message, array_map(function ($value) {
			return '<b>' . $value . '</b>';
		}, $params));

		return $message;
	}
}
