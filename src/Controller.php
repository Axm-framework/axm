<?php

namespace Axm\Core;

use Axm;
use Axm\Views\View;
use Axm\Http\Request;
use Axm\Http\Response;
use Axm\Exception\AxmException;
use Axm\Middlewares\BaseMiddleware;
use Axm\Middlewares\MaintenanceMiddleware;
use Axm\Middlewares\AuthMiddleware;


/**
 * Class Controller
 *
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package System
 */

abstract class Controller
{
    protected ?Request  $request = null;
    protected ?Response $response = null;

    protected ?object $user = null;
    protected ?View   $view = null;

    protected string  $layout = 'main';
    protected string  $action = '';
    protected string  $controllerName = '';
    protected ?object $model = null;

    /**
     * @var BaseMiddleware[]
     */
    protected array $middlewares = [];

    public function __construct()
    {
        $this->request  = Axm::app()->request;
        $this->response = Axm::app()->response;
        $this->view     = new View();

        $this->init();
    }


    public function init()
    {
        $middleware = new MaintenanceMiddleware;
        $this->registerMiddleware($middleware);
    }

    /**
     * Modifica el layout actual
     */
    public function setLayout(string $layout): void
    {
        $this->layout = $layout;
    }


    /**
     * Obtiene el layout actual
     */
    public function getLayout(): string
    {
        return $this->layout;
    }

    /**
     * Specifies that the current view should extend an existing layout.
     */
    public function setPathView(string $path)
    {
        return $this->view::$viewPath = $path;
    }


    /**
     * Agrega una acción al controlador
     * 
     * @param string|null $action
     * @return void
     */
    public function addAction(?string $action): void
    {
        $this->action = $action ?? '';
    }


    /**
     * Obtiene la acción actual del controlador.
     *
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }


    /**
     * Renderiza la vista
     * 
     * @param string $view
     * @param array $param
     */
    public function renderView(string $view, array $params = [], bool $buffer = true, string $ext = '.php'): ?string
    {
        return show($this->view::render($view, $params, $buffer, $ext));
    }


    /**
     * Incluye una plantilla mediante su ruta
     *
     * @param $view
     * @param null|array $params
     * @param bool $buffer
     * @return string
     */
    public function templatePartial(string $view, array $params = [], $buffer = true): void
    {
        echo $this->view->templatePartial($view, $params, $buffer);
    }

    /**
     * Registra un Middleware en el Controller
     *
     * @param BaseMiddleware $middleware
     */
    public function registerMiddleware(BaseMiddleware $middleware): void
    {
        $this->middlewares[] = $middleware;
    }


    /**
     * @return Middlewares\BaseMiddleware[]
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }


    /**
     * Registra y ejecuta el middleware AuthMiddleware en el controlador
     * para el control de acceso a las acciones especificadas.
     *
     * @param array $actions Las acciones que requieren autorización
     * @param bool  $allowedAction Indica si se permite el acceso a otras
     * acciones diferentes a las especificadas.
     */
    public function accessControl(array $actions, bool $allowedAction = false)
    {
        $middleware = new AuthMiddleware($actions, $allowedAction);
        $this->registerMiddleware($middleware);
    }


    public function getName()
    {
        get_class($this);
    }

    /**
     * Se llama cuando no existe un método
     *
     * @param string $name      
     * @param array  $arguments
     * @throws AxmException
     * @return void
     */
    public function __call($name, $arguments)
    {
        return show(
            'El método "%s" no existe',
            [$name]
        );
        // throw new AxmException(Axm::t('axm', 'El método "%s" no existe', [$name]), 'no_action');
    }
}
