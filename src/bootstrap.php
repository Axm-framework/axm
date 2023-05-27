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
defined('ROOT_PATH') or define('ROOT_PATH', getcwd());

// Define la ruta de las dependencias
const VENDOR_PATH = ROOT_PATH . '/vendor';

// Define la ruta de instalación de AXM framework 
const AXM_PATH =  VENDOR_PATH . '/axm';

// Define la ruta de la aplicación
const APP_PATH = ROOT_PATH . '/app';

// Define la ruta para escritura de archivos
const STORAGE_PATH = ROOT_PATH . '/storage';

// Define la ruta clara de la URI de solicitud
defined('PATH_CLEAR_URI') or define('PATH_CLEAR_URI', substr($_SERVER['SCRIPT_NAME'], 0, -9));

// Define el ambiente de desarrollo
const AXM_ENV_PRODUCTION = 'production';
const AXM_ENV_DEBUG = 'debug';

require_once('axm_helper.php');

try {
    \Dotenv\Dotenv::createImmutable(ROOT_PATH)->load();
} catch (\Throwable $th) {
    trigger_error($th);
}
