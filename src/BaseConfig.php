<?php

namespace Axm;

use Axm\Cache\Cache;
use Axm\Exception\AxmException;


/**
 * Clase para manejar la configuración de la aplicación.
 *
 * Esta clase proporciona métodos para cargar la configuración desde diferentes tipos de archivos,
 * acceder a los valores de configuración y almacenar valores predeterminados. También se puede utilizar
 * para cachear los valores de configuración para mejorar el rendimiento.
 **/
class BaseConfig
{
    private static $instance;
    private array $config = [];
    private array $cache = [];
    private array $cacheFile = [];

    private function __construct()
    {
    }


    /**
     * Obtener la instancia de la clase
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }


    /**
     * Abrir un archivo de cofiguracion
     */
    public function load(string $file, bool $merge = true)
    {
        // if ($this->getCache($file) !== false) {
        //     return;
        // }

        if (!file_exists($file))
            throw new AxmException('Archivo de configuración no encontrado: ' . $file);

        $ext = pathinfo($file, PATHINFO_EXTENSION);
        switch ($ext) {
            case 'php':
                $data = require($file);
                break;
            case 'json':
                $data = json_decode(file_get_contents($file), true);
                break;
            case 'ini':
                $data = parse_ini_file($file, true);
                break;

            default:
                throw new AxmException('Formato de archivo de configuración no válido: ' . $ext);
        }

        if (!is_array($data))
            throw new AxmException('Archivo de configuración no válido: ' . $file);

        if ($merge)
            $this->config = array_merge($this->config, $data);
        else
            $this->config = $data;

        // $filename = strtolower(basename($file, '.php'));
        // Cache::driver()->cachePath = STORAGE_PATH . '/framework/cache/config/';
        // $this->saveCache($filename, serialize($data));
        // Cache::driver()->cachePath = null;

        return (array) $this->config;
    }


    /**
     * Obtiene la cache de view.
     *
     * @return bool
     */
    protected function getCache(string $view)
    {
        $cache = Cache::driver()->get($view);
        return $cache;
    }


    /**
     * Guarda en la cache la view.
     *
     * @return bool
     */
    protected function saveCache(string $file, $data)
    {
        $cache = Cache::driver()->set($file, $data);
        return $cache;
    }


    /**
     * Obtener la cache
     */
    public function get($key, $default = null)
    {
        // if (($data = $this->getCache($key)) !== false) {
        //     return unserialize($data[$key]);
        // }

        $value = $this->config;
        foreach (explode('.', $key) as $segment) {
            if (!is_array($value) || !array_key_exists($segment, $value)) {
                $this->cache[$key] = $default;
                return $default;
            }

            $value = $value[$segment];
        }

        $this->cache[$key] = $value;
        return $value;
    }


    /**
     * Verificar si exite un cache existe
     */
    public function has(string $name): bool
    {
        return isset($this->cache[$name]);
    }


    /**
     *Obtener todas las configuraciones 
     */
    public function all()
    {
        return $this->config;
    }


    /**
     * 
     */
    public function setDefaults(array $defaults)
    {
        $this->config = array_merge($defaults, $this->config);
    }


    /**
     * Limpiar cache
     */
    public function clearCache()
    {
        $this->cache = [];
    }


    /**
     *
     */
    public function __get($key)
    {
        return $this->get($key);
    }
}
