<?php

/*
 * ---------------------------------------------------------------
 * SETUP OUR PATH CONSTANTS
 * ---------------------------------------------------------------**/

// Define la versión del Framework
const AXM_VERSION = '1.0.0';

// Define el charset de la aplicación
const APP_CHARSET = 'UTF-8';

// Define la ruta raíz
defined('ROOT_PATH') or define('ROOT_PATH', dirname(dirname(__DIR__)));

// Define la ruta de instalación de AXM framework
const AXM_PATH =  ROOT_PATH . '/System';

// Define la ruta de la aplicación
const APP_PATH = ROOT_PATH . '/App';

// Define la ruta para escritura de archivos
const STORAGE_PATH = ROOT_PATH . '/Storage';

// Define la ruta de las dependencias
const VENDOR_PATH = ROOT_PATH . '/Vendor';

// Define la ruta pública
defined('PUBLIC_PATH') or define('PUBLIC_PATH', substr($_SERVER['SCRIPT_NAME'], 0, -9)); // la path menos el index.php string[9]

// Define la ruta clara de la URI de solicitud
defined('PATH_CLEAR_URI') or define('PATH_CLEAR_URI', str_replace($_SERVER['DOCUMENT_ROOT'], '', strtr(ROOT_PATH, '\\', '/')));

// Define el ambiente de desarrollo
const AXM_ENV_PRODUCTION = 'production';
const AXM_ENV_DEBUG = 'debug';

require_once('axm_helper.php');

try {
    Dotenv\Dotenv::createImmutable(ROOT_PATH)->load();
} catch (\Throwable $th) {
    trigger_error($th);
}
