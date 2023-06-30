  <?php

  use Axm\Application;
  use Axm\Exception\AxmException;
  use Axm\I18n\I18n;
  use Axm\Raxm\RaxmManager;
  use Axm\Views\View;


  if (!function_exists('extend')) {

    function extend(string $layout)
    {
      return View::extend($layout);
    }
  }

  /**
   * 
   */
  if (!function_exists('memoize')) {

    function memoize(callable $fn): callable
    {
      $cache = [];

      return function (...$args) use ($fn, &$cache) {
        $key = sha1(serialize($args));

        return $cache[$key] ?? ($cache[$key] = $fn(...$args));
      };
    }
  }

  if (!function_exists('raxm')) {

    function raxm(string $component)
    {
      return RaxmManager::initialComponent($component);
    }
  }


  function raxmScripts()
  {
    return RaxmManager::raxmScripts();
  }

  if (!function_exists('view')) {

    function view(string $view, $params = null, bool $buffer = true, string $ext = '.php')
    {
      return Axm::app()->controller->renderView($view, $params, $buffer, $ext);
    }
  }
  
  if (!function_exists('section')) {

    function section(string $name)
    {
      return View::section($name);
    }
  }

  if (!function_exists('endSection')) {

    function endSection()
    {
      return View::endSection();
    }
  }

  if (!function_exists('env')) {
    /**
     * Allows user to retrieve values from the environment
     * variables that have been set. Especially useful for
     * retrieving values set from the .env file for
     * use in config files.
     *
     * @param string|null $default
     *
     * @return mixed
     */
    function env(string $key, $default = null)
    {
      static $cache = [];

      // Check if the key is already in the cache
      if (isset($cache[$key])) {
        return $cache[$key];
      }

      // Try to get the value from different sources
      $value = $_SERVER[$key] ?? $_ENV[$key] ?? getenv($key) ?? null;

      // Not found? Return the default value
      if ($value === null) {
        return $default;
      }

      // Store the value in the cache and return it
      return $cache[$key] = $value;
    }
  }


  if (!function_exists('protect')) {

    function protect($values)
    {
      if (is_array($values) || is_object($values)) {

        $srt = [];
        foreach ($values as $key => $value) :
          if (!is_array($value))
            $srt[$key] = executeProtect($value);
          else
            $srt[$key] = protect($value);
        endforeach;

        return $srt;
      }

      return executeProtect($values);
    }
  }


  if (!function_exists('executeProtect')) {

    function executeProtect(string $values)
    {
      $dom = new DOMDocument();
      $dom->loadHTML('<?xml encoding="UTF-8">' . $values, LIBXML_HTML_NODEFDTD | LIBXML_NOXMLDECL);

      foreach ($dom->getElementsByTagName('*') as $node) {
        for ($i = $node->attributes->length - 1; $i >= 0; --$i) {
          $attr = $node->attributes->item($i);
          $node->removeAttributeNode($attr);
          $node->setAttribute($attr->nodeName, htmlspecialchars($attr->nodeValue, ENT_QUOTES | ENT_HTML5, 'UTF-8'));
        }
      }

      return $dom->saveHTML($dom->documentElement);
    }
  }


  if (!function_exists('show')) {
    /**
     * 
     */
    function show($data = null, $return = false)
    {
      $output = $data ?: '';

      if ($return) {
        return $data;
      }

      echo $output . PHP_EOL;
    }
  }


  if (!function_exists('cVar')) {
    /**
     * copia una variable original,
     * la borrara y rettorna la nueva variable.
     * (Exencialmente para copair y borrar varible tipo: $_COOKIE, $_SESSION)
     */
    function cVar($var)
    {
      $result = $var;
      unset($var);

      return $result;
    }
  }

  if (!function_exists('randomId')) {

    function randomId($size = 50)
    {
      return crc32(bin2hex(random_bytes($size)));
    }
  }


  if (!function_exists('lang')) {

    function lang(string $key)
    {

      $message = I18n::gettext($key);    //Obtengo el menssage
      if (func_num_args() > 1) :        // Si se pasan multiples parametros
        $args = func_get_args();
        unset($args[0]);
        $message = vsprintf($message, $args);
      endif;

      return $message;
    }
  }


  /**
   * Escucha si existen mensajes en los flashmessage de la clase Session y 
   * lo muestra en pantalla con el toastr js;
   * ej:  toast_flashMessage(Axm\Axm::app()->session); **/
  if (!function_exists('toast_flashMessage')) {

    function toast_flashMessage(object $session)
    {
      if ($session->getFlash('success'))     return toastr('success', $session->getFlashValue('success'));
      elseif ($session->getFlash('info'))    return toastr('info', $session->getFlashValue('info'));
      elseif ($session->getFlash('error'))   return toastr('error', $session->getFlashValue('error'));
      elseif ($session->getFlash('warning')) return toastr('warning', $session->getFlashValue('warning'));
    }
  }

  /**
   * Escucha si existen mensajes en los flashmessage de la clase Session y 
   * lo muestra en pantalla con la biblioteca de notificaciones especificada;
   * ej:  toast_flashMessage(Axm\Axm::app()->session, 'sweetalert'); 
   **/
  // if (!function_exists('toast_flashMessage')) {

  //   function toast_flashMessage(object $session, string $library = 'toastr')
  //   {
  //     $availableLibraries = [
  //       'toastr' => [
  //         'success' => 'success',
  //         'error' => 'error',
  //         'warning' => 'warning',
  //         'info' => 'info',
  //       ],
  //       'sweetalert' => [
  //         'success' => 'success',
  //         'error' => 'error',
  //         'warning' => 'warning',
  //         'info' => 'info',
  //         'primary' => 'primary',
  //         'secondary' => 'secondary',
  //       ],
  //     ];

  //     $messages = $session->getFlash();

  //     if (empty($messages)) {
  //       return;
  //     }

  //     foreach ($messages as $type => $message) {
  //       if (!isset($availableLibraries[$library][$type])) {
  //         continue;
  //       }

  //       $notificationClass = $availableLibraries[$library][$type];

  //       echo "<script>window.{$library}('{$message}', '{$notificationClass}')</script>";
  //     }
  //   }
  // }



  /**
   * fucntion para mostar mesajes en la lib toastr
   */
  if (!function_exists('toastr')) {

    // function toastr(string $tipo, string $text)
    // {
    //   echo '<script> toastr.' . $tipo . "('" . $text . " ')" . '</script>';
    // }
    function toastr(string $type, string $text)
    {
      $sanitizedType = htmlspecialchars($type, ENT_QUOTES);
      $sanitizedText = htmlspecialchars($text, ENT_QUOTES);

      show("<script>toastr.$sanitizedType('$sanitizedText')</script>");
    }
  }



  /**
   * Modifica el tipo y mensaje de los flashmessage de class Session
   * ej:  setFlash('error', 'User does not exist with this email address'); **/
  if (!function_exists('setFlash')) {

    function setFlash(string $type, string $message)
    {
      return Axm::app()->session->setFlash($type, $message);
    }
  }


  /**
   * This code checks if a function called "urlSite" exists. 
   *If it does not exist, the code creates a function called "urlSite" that takes in one parameter, a string called $dir. 
   *The function then sets the scheme and host variables to the request scheme and http host from the server respectively.
   *It then sets the path variable to the value of $dir after trimming off any slashes at the end. 
   *It then creates an url variable by concatenating the scheme, host and path variables.
   *If this url is not valid, it throws an exception. Otherwise, it returns the url.
   */
  if (!function_exists('generateUrl')) {

    function generateUrl(string $dir = ''): string
    {
      // Get the current scheme from the application request object
      $scheme = Axm::app()->request->getScheme();

      // Get the current host from the $_SERVER global array
      $host = $_SERVER['HTTP_HOST'] ?? '';

      // Trim the given directory string and prepare to append it to the URL
      $path = trim($dir, '/');

      // Build the URL from the scheme and host
      $url = "{$scheme}://{$host}";

      // If a directory was provided, append it to the URL
      if (!empty($path)) {
        $url .= "/{$path}";
      }

      // If the URL is not valid, throw an exception
      if (!filter_var($url, FILTER_VALIDATE_URL)) {
        throw new RuntimeException("Invalid URL: {$url}");
      }

      // Return the generated URL
      return $url;
    }
  }


  /**
   *  devuelve la root completa de sitio, si no se le pasa el parametro $dir mostrará solamente la root 
   * si se le pasasa la ruta de un file lo mostrará, esta funión sirve para mostar rutas primordialmente. 
   * ej:  baseUrl('assets/css/bootstrap.min.css'); **/
  if (!function_exists('baseUrl')) {

    function baseUrl(string $dir = ''): string
    {
      // If $dir is not empty, remove any forward-slashes or back-slashes from the beginning or end of the string, add a forward-slash to the end and assign it to $dir
      $dir = (!empty($dir)) ? rtrim($dir, '\/') . '/' : '';

      // Concatenate PUBLIC_PATH and $dir to form the full URL of the current site with the directory appended
      $url = generateUrl(ROOT_PATH . '/resources/' . $dir);

      // Return the URL
      return $url;
    }
  }


  /**
   *  sirve para ir a una pagina especíca, 
   * ej:  go('login'); **/
  if (!function_exists('go')) {

    function go(string $page = ''): string
    {
      $baseUrl = Axm::app()->request->getScheme() . '://' . $_SERVER['SERVER_NAME'] . PATH_CLEAR_URI;
      $url = $page;

      // Si la página no es una URL completa, añadir la base URL al principio.
      if (!preg_match('#^https?://#', $page)) {
        $url = rtrim($baseUrl, '/') . '/' . ltrim($page, '/');
      }

      // Comprobar que la página especificada existe.
      $path = parse_url($url, PHP_URL_PATH);
      // if (!file_exists(ROOT_PATH . $path)) {
      //   throw new AxmException(Axm::t('axm', 'La página especificada no existe: {page}', ['{page}' => $page]));
      // }

      return $url;
    }
  }

  /**
   *  sirve para ir hacia atras, 
   * si $_SERVER['HTTP_REFERER'] esta defino va hacia allá sino hace un refresh 
   * ej:  back('login'); **/
  if (!function_exists('back')) {
    function back()
    {
      $referer = $_SERVER['HTTP_REFERER'] ?? null;

      if (null !== $referer)
        return redirect($referer);

      return refresh();
    }
  }


  function is_cli(): bool
  {
    if (in_array(PHP_SAPI, ['cli', 'phpdbg'], true)) {
      return true;
    }

    return !isset($_SERVER['REMOTE_ADDR']) && !isset($_SERVER['REQUEST_METHOD']);
  }


  /**
   * Redireccionar una página a otra, 
   * ej:  redirect('login'); **/
  if (!function_exists('redirect')) {

    function redirect($url)
    {
      return Axm::app()->response->redirect($url);
    }
  }

  /**
   * Redirects the request to the current URL
   **/
  if (!function_exists('refresh')) {

    function refresh()
    {
      return Axm::app()->request->getUri();
    }
  }

  /**
   *  Devuelve todos los datos enviados por el método POST. 
   * si no le pasamos parametro muestra todos lo elemnento, si le pasamos parametros 
   * muestra el elemnto en específico
   * ej:  post(); || post('name'); **/
  if (!function_exists('post')) {

    function post($key = null)
    {
      if (!($post = Axm::app()->request->post())) return false;

      if ($key !== null) {
        return htmlspecialchars($post[$key], ENT_QUOTES, 'UTF-8');
      }

      return htmlspecialchars($post, ENT_QUOTES, 'UTF-8');
    }
  }


  if (!function_exists('isLogged')) {

    function isLogged()
    {
      return Axm::app()->isLogged();
    }
  }

  /**
   *  Sirve para mostrar nuevamente si existen de los datos enviados en 
   * elementos html(input, select,textarea,etc) enviados por el método POST. 
   * ej:  old('name);**/
  if (!function_exists('old')) {

    function old(string $value)
    {
      $input = Axm::app()->request->post();
      return (isset($input[$value]) && !empty($input[$value])) ? $input[$value] : '';
    }
  }


  /**
   * chequear si una session esta definida o no
   */
  if (!function_exists('checkSession')) {

    function checkSession(string $key): bool
    {
      return Axm::app()->session->get($key);
    }
  }


  /**
   * Devuelve una info específica del usuario cualquiera, el nombre de la clase desde la ConfigApp
   * var public userClass
   * 
   * @param string $user
   * @param string $value
   */
  if (!function_exists('getInfoUser')) {

    function getInfoUser(string $user, string $value)
    {
      $userClass = Axm::app()->config()->userClass;
      return $userClass::getInfoUser($user, $value);
    }
  }


  /**
   * Devuelve una info específica del usuario que se ha logueado satisfactoriamente
   */
  if (!function_exists('getUser')) {

    function getUser(string $value = null)
    {
      return Axm::app()->user->{$value};
    }
  }


  /**
   * Devuelve una info específica del usuario que se ha logueado satisfactoriamente
   */
  if (!function_exists('app')) {

    function app(?string $alias = null, Closure $callback = null, bool $shared = false): Application
    {
      return Axm::app($alias, $callback, $shared);
    }
  }

  /**
   * Devuelve una info específica del usuario que se ha logueado satisfactoriamente
   */
  if (!function_exists('config')) {

    function config(string $key = '')
    {
      return Axm::app()->config($key);
    }
  }


  /**
   * Mide los procesos en fracciones de tiempo.
   * $star_time = microtime(true);              porner al principio del script
   * timeExec($star_time);                      poner al final del script */
  if (!function_exists('timeExec')) {

    function timeExec($start_time)
    {
      $end_time = microtime(true);
      $duration = $end_time - $start_time;
      $time     = gmdate('H:i:s', (int)$duration);

      return $time;
    }
  }

  if (!function_exists('dum')) {
    /**
     * Muestra en pantalla los valores pasados
     *
     * @param mixed $data
     * @return void
     */
    function dum()
    {
      $output = '';
      $id = 1;

      foreach (func_get_args() as $value) {
        $output .= var_dump($value, true) . "\n";
        $id++;
      }

      echo ($output);
      exit();
    }
  }

  if (!function_exists('d')) {
    /**
     * Muestra en pantalla los valores pasados
     *
     * @param mixed $data
     * @return void
     */
    function d(...$args)
    {
      helpers('text');
      ob_start();
      $id = 1;

      foreach ($args as $value) {
        echo "Variable($id): >>>\n";
        var_dump($value);
        echo "\n\n";
        $id++;
      }

      echo "\n\nBacktrace:\n";
      $backtrace = debug_backtrace();

      foreach ($backtrace as $trace) {
        $file = $trace['file'] ?? '';
        $line = isset($trace['line']) ? '(' . $trace['line'] . ')' : '';
        echo "{$file} {$line}\n";
      }

      $output = ob_get_clean();
      highlight_string($output);

      exit();
    }
  }


  if (!function_exists('logg')) {

    function logg($data)
    {
      echo "<script>console.info('<<< Begin Console Axm: ')\n";
      echo "console.log(" . json_encode($data) . ")\n";
      echo "console.info('End Console Axm >>>')\n</script>";
    }
  }

  if (!function_exists('debug')) {
    /**
     * Muestra en pantalla los valores pasados
     *
     * @param mixed $data
     * @return void
     */
    function debug()
    {
      $output = '';
      $id = 1;

      foreach (func_get_args() as $value) {
        $output .= "Variable($id): >>> " . var_dump($value, true) . "\n";
        $id++;
      }

      helpers('text');
      echo highlight_string($output);
      exit();
    }
  }

  if (!function_exists('secure_directory')) {

    function secure_directory()
    {
      $random = randomHash();
      $s_dir  = substr(hash('sha256', $random), 0, 20);

      return $s_dir;
    }
  }


  if (!function_exists('to_object')) {
    /**
     * Convierte el elemento en un objecto
     *
     * @param [type] $array
     * @return void
     */
    function to_object($array)
    {
      return json_decode(json_encode($array));
    }
  }


  if (!function_exists('helpers')) {

    /**
     * Carga uno o varios helpers de la aplicación o del sistema de axm.
     *
     * @param string|array $helpers Nombres de los helpers a cargar, separados por espacios o comas.
     * @param bool $system Indica si los helpers son del sistema de axm o de la aplicación.
     * @param string $path Ruta a la carpeta de los helpers. Si no se proporciona, se usa una ubicación predeterminada.
     * @return bool Verdadero si todos los helpers se cargaron correctamente, falso en caso contrario.
     * 
     * example:
     *     Cargar un solo helper:  
     *     1- helpers('array');

     * Cargar múltiples helpers separados por comas:  
     *     2- helpers('array, text, integer, utility');
  

     * Cargar múltiples helpers separados por puntos
     *  3-helpers('array.text.integer.utility');

  
     * Cargar múltiples helpers separados por espacios
     *   4-helpers('array text integer utility');


     * Cargar múltiples helpers utilizando un array
     *   5- helpers(['array', 'text', 'integer', 'utility']);

     */
    function helpers($helpers, $system = false, $basePath = null)
    {
      if (is_string($helpers)) {
        $helpers = preg_split('/[\s,\.]+/', $helpers);
      } elseif (!is_array($helpers)) {
        throw new AxmException('axm', 'The $helpers variable must be a string or an array.');
      }

      if (!$basePath) {
        $basePath = $system ? AXM_PATH : APP_PATH;
      }

      $helpersPath = "$basePath/Helpers/";

      foreach ($helpers as $helper) {
        $helper = trim($helper . '_helper.php');
        $helperFile = "$helpersPath/$helper";

        if (!file_exists($helperFile)) {
          throw new AxmException(
            Axm::t('axm', 'The helper "%s" does not exist in %s.', [
              $helper,
              $helpersPath,
            ])
          );
        }

        require_once($helperFile);
      }
    }
  }

  if (!function_exists('getRouteParams')) {

    function getRouteParams()
    {
      return Axm::app()->request->getRouteParams();
    }
  }


  if (!function_exists('getUri')) {

    function getUri()
    {
      return Axm::app()->request->getUri();
    }
  }


  /**
   * Loggea un registro en un archivo de logs del sistema, usado para debugging
   *
   * @param string $message
   * @param string $type
   * @param boolean $output
   * @return mixed
   */
  function logger(string $message, string $level = 'debug', bool $output = false)
  {
    $levels           = ['debug', 'import', 'info', 'success', 'warning', 'error'];
    $dateTime         = date('d-m-Y H:i:s');
    $level            = in_array($level, $levels) ? $level : 'debug';
    $formattedMessage = '[' . strtoupper($level) . "] $dateTime - $message";
    $logFilePath      = STORAGE_PATH . '/logs/axm_log.log';

    if (!file_exists($logFilePath)) {
      setFlash('error', sprintf('The log file does not exist at %s', $logFilePath));

      return false;
    }

    if (!$fileHandle = fopen($logFilePath, 'a')) {
      setFlash('error', sprintf('Cannot open file at %s', $logFilePath));

      return false;
    }

    fwrite($fileHandle, "$formattedMessage\n");
    fclose($fileHandle);

    if ($output) {
      print "$formattedMessage\n";
    }

    return true;
  }


  if (!function_exists('cleanPath')) {
    /**
     * A convenience method to clean paths for
     * a nicer looking output. Useful for exception
     * handling, error logging, etc.
     */
    function cleanPath(string $path): string
    {
      // Resolve relative paths
      $path = realpath($path) ?: $path;

      switch (true) {
        case strpos($path, APP_PATH) === 0:
          return APP_PATH . DIRECTORY_SEPARATOR . substr($path, strlen(APP_PATH));

        case strpos($path, AXM_PATH) === 0:
          return AXM_PATH . DIRECTORY_SEPARATOR . substr($path, strlen(AXM_PATH));

        case defined('VENDOR_PATH') && strpos($path, VENDOR_PATH) === 0:
          return VENDOR_PATH . DIRECTORY_SEPARATOR . substr($path, strlen(VENDOR_PATH));

        case strpos($path, ROOT_PATH) === 0:
          return ROOT_PATH . DIRECTORY_SEPARATOR . substr($path, strlen(ROOT_PATH));

        case strpos($path, STORAGE_PATH) === 0:
          return STORAGE_PATH . DIRECTORY_SEPARATOR . substr($path, strlen(STORAGE_PATH));

        default:
          return $path;
      }
    }
  }
