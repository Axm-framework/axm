<?php

namespace Axm;

use Axm;
use Axm\Validation\Validator;
use Axm\Exception\AxmException;
use Axm\DbModel;
use PhpParser\Node\Expr\FuncCall;

/**
 * Class Model
 *
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package System
 */
abstract class Model extends DbModel
{
    private  $separator = '|';
    private  $equals  = ':';
    private  $grouper_open  = '[';
    private  $grouper_close = ']';
    private  $compare = [
        '===', '!==', '!=', '==',
        '>=', '<=', '<', '>'
    ];

    private  $not = '!';

    private array $rules = [];
    private string $rule = '';

    public $data;
    /**variables donde se guardan todos los errores */

    private array $errors = [];
    /**variable que cuenta la ocurrencias de errores por cada reglas */

    public $_input;

    public array $countErrors = [];
    private $val = [];
    private $classValidate;

    protected $validationRules = [];

    protected $allowedFields = [];

    public $loadData = false;

    public $skipValidation = false;
    private $fields;

    protected $validationMessage = [];

    protected $errorMessage =
    [
        'required'   => 'The field {field} is required',
        'email'      => 'The field must be valid email address',
        'min'        => 'Min length of the field {field} must be {min}',
        'max'        => 'Max length of the field {field} must be {max}',
        'match'      => 'The field must be the same as {match}',
        'size'       => 'Size of the {field} must be {size}',
        'equals'     => 'Este campo debe ser igual al campo {field}',
        'compare'    => 'The field {field} not is {operator} to field {value}',
        'unique'     => 'Record with The {field} already exists',
        'alpha'      => 'The field {field} is text',
        'alnum'      => 'The field {field} is alphanumeric',
        'numeric'    => 'The field {field} is numeric',
        'phone'      => 'Este formato de telefono es incorrecto',
        'file'       => 'File invalid',
        'number'     => 'The field {field} is number',
        'positive'   => 'The field {field} is positive number',
        'negative'   => 'The field {field} is positive negative',
        'decimal'    => 'The field {field} is decimal',
        'int'        => 'The field {field} is int',
        'nif'        => 'The field {field} is nif',
        'array'      => 'The field {field} is array',
        'string'     => 'The field {field} is string',
        'postalcode' => 'The field {field} is invalid',
        'dir'        => 'The field {field} is dir',
        'lower'      => 'The field {field} is lower',
        'uppercase'  => 'The field {field} is uppercase',
        'consonant'  => 'The field {field} is consonant',
        'date'       => 'The field {field} is date',   //revisar
        'time'       => 'The field {field} is time',   //revisar
        'slug'       => 'The field {field} is slug',
        'finite'     => 'The field {field} is finite',
        'infinite'   => 'The field {field} is infinite',
        'isbn'       => 'The field {field} is isbn',
        'iban'       => 'The field {field} is incorrect',
        'nif'        => 'The field {field} is incorrect',
        'fibonacci'  => 'The field {field} is number fibonacci',
        'null'       => 'The field {field} is null',
        'url'        => 'The field {field} is url',
        'card'       => 'The number card invalid',
        'true'       => 'The field {field} is true',
        'false'      => 'The field {field} is false',
        'json'       => 'The field {field} is json',
        'leapdate'   => 'The field {field} is leapdate',
        'leapyear'   => 'The field {field} is leadyear',
        'mac'        => 'The field {field} is mac address',
        'oject'      => 'The field {field} is object',
        'odd'        => 'The field {field} is odd', //si es par
        'pis'        => 'The field {field} is pis',
        'link'       => 'The field {field} is link',

        //not
        '!required'   => 'The field {field} no is required',
        '!email'      => 'The field no must be valid email address',
        '!alpha'      => 'The field no is text',
        '!alnum'      => 'The field no is alphanumeric',
        '!numeric'    => 'The field no is numeric',
        '!phone'      => 'Este formato no de telefono es incorrecto',
        '!file'       => 'File no valid',
        '!number'     => 'The field no is number',
        '!positive'   => 'The field no is positive number',
        '!negative'   => 'The field no is positive negative',
        '!decimal'    => 'The field no is decimal',
        '!int'        => 'The field no is int',
        '!nif'        => 'The field no is nif',
        '!array'      => 'The field no is array',
        '!string'     => 'The field no is string',
        '!postalcode' => 'Postal code no invalid',
        '!dir'        => 'The field no is dir',
        '!lower'      => 'The field no is lower',
        '!uppercase'  => 'The field no is uppercase',
        '!consonant'  => 'The field no is consonant',
        '!date'       => 'The field no is date',   //revisar
        '!time'       => 'The field no is time',   //revisar
        '!slug'       => 'The field no is slug',
        '!finite'     => 'The field no is finite',
        '!infinite'   => 'The field no is infinite',
        '!isbn'       => 'The field no is isbn',
        '!iban'       => 'The field no is iban',
        '!nif'        => 'The field no is nif',
        '!fibonacci'  => 'The field no is number fibonacci',
        '!null'       => 'The field no is null',
        '!url'        => 'The field no is url',
        '!card'       => 'The number no card invalid',
        '!true'       => 'The field no is true',
        '!false'      => 'The field no is false',
        '!json'       => 'The field no is json',
        '!leapdate'   => 'The field no is leapdate',
        '!leapyear'   => 'The field no is leadyear',
        '!mac'        => 'The field no is mac address',
        '!oject'      => 'The field no is object',
        '!odd'        => 'The field no is odd', //si es par
        '!pis'        => 'The field no is pis',
        '!link'       => 'The field no is link'
    ];



    /**
     * Iniciamos la conexion a la DataBase
     * Cargamos la clase validator que es la registrara todas la clases de validacion   */
    public function __construct()
    {
        $this->init();
    }


    /**
     * Valida los datos del formulario según las reglas de validación.
     * 
     * Puedes utilizar este método sin antes haber cargados los datos con ( loadData($data) ), el mismo verifica automaticamenete 
     * si ya ser cargaron sino los carga.(esto es para ahorrar en espacio en el código, ponemos $this->validate() y ya está.)
     * Si se le pasa el argumento($data) validará estos datos pasados, sino buscará el método (GET || POST) con Axm::app()->request->getBody().
     * @return bool
     */
    // public function validate($data = null)
    // {
    //     $this->data = $this->data ?? $data ?? Axm::app()->request->post();     //$_POST
    //     $this->loadData ?? $this->loadData($this->data);                      //carga los datos si no se han cargado
    //     if ($this->startValidation())                                            //inicia la validación
    //         return true;
    //     else
    //         return false;
    // }


    public function validate($data = null): bool
    {
        $this->data = $data ?? Axm::app()->request->post() ?? [];
        $this->loadData($this->data);

        return $this->startValidation();
    }


    /**
     * Carga todos lo datos con los cual se va realzar la validacion  
     * verifica si la key de este array de datos son propiedades de la clase que la intanció,
     * recuerde que los atributos name de los formularios deben de llamarse(nombrarlo) iguales a
     * las propiedades de la clase modelo en cuestión, **/
    // public function loadData(array $data): void
    // {
    //     $this->_input = new \stdClass;
    //     foreach ($data as $key => $value) :
    //         $this->_input->{$key} = $value;
    //         $this->data[$key] = $value;
    //     endforeach;

    //     $this->loadData = true;
    // }

    // public function loadData(array $data): void
    // {
    //     $this->_input = new \stdClass;
    //     array_walk($data, function ($value, $key) {
    //         $this->_input->{$key} = $value;
    //         $this->data[$key] = $value;
    //     });
    // }


    public function loadData(array $data): void
    {
        $this->_input = (object) $data;
        $this->mapDataToProperties($this);
    }

    public function mapDataToProperties($obj): void
    {
        foreach ($this->_input as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
            // $obj->{$key} = $value;
            // $this->data[$key] = $value;
        }
    }

    public function atributes()
    {
        return [];
    }


    /**
     * Si esta funcion es implementada en el modelo del usuario agregara en las etiquetas label de los formularios 
     * el nombre asignado sino estará vacío, en los fieldss de tipo checbox
     *  y radiobutton salen al lado de estos.
     * 
     * @return array  */
    public function labels(): array
    {
        return [];
    }



    /**
     * Devuelve la etiqueta seleccionada  si existe
     * @param string $fields  */
    public function getLabel($fields)
    {
        return $this->labels()[$fields] ?? '';
    }



    /**
     * Devuelve todas las rules definidas.
     * @param string $fields
     * @return array
     * */
    public function getRules(): array
    {
        return $this->validationRules;
    }


    /**
     * Devuelve la rule solicitada.
     * @param string $fields
     * @return array
     * */
    public function getRule(string $field): string
    {
        return $this->validationRules[$field];
    }



    /**
     * Esta funcion realiza los proceso de validaciones de los campos,
     * si encuentra alguna regla de validacion instacia la clase de la validacion, ejecuta el metodo validate de dicha clase,
     * segun lo que devuelva la clase (true || false) agregará los errores con el metodo addErrorByRule(),
     * @return bool  */
    // private function startValidation(): bool
    // {
    //     if ($this->skipValidation == true) return true;   // si true saltar validation

    //     $star_time = microtime(true);
    //     $rules = [];
    //     foreach ($this->validationRules as $atribute => $rulePack) :
    //         $valueAtribute = $this->_input->$atribute ?? '';

    //         $rulePack = (false !== strpos($rulePack, $this->separator)) ? $rulePack : $rulePack . $this->separator;  //si no se encuntra el simbolo separator, agregarlo al final.
    //         $rules = explode($this->separator, $rulePack);  //separarlos por partes
    //         foreach ($rules as $value) :
    //             $value = str_replace(' ', '', $value);

    // /**
    //  * Class Rule Single
    //  * si encuentra la rule class en todas las reglas de validación
    //  * entonce  intanciará la clase y llamará al metodo validate */
    // $this->classValidation($value); //intanciar la rule class
    // $data = ($value === 'file' || $value === 'required' && !empty($_FILES[$atribute]['tmp_name'])) ? ($_FILES[$atribute]['tmp_name']) : $valueAtribute; // si la regla es file que busque el $_FILES sino es atributtes
    // $return = call_user_func_array(array($this->classValidate, 'validate'), [$data]);  //llamo al método de la clase

    // if (false === $return) $this->addErrorByRule($atribute, $value, [$valueAtribute, $value]);


    //             /**
    //              * Class Rule Not (!)
    //              * si encuentra la rule class en todas las reglas de validación
    //              * entonce  intanciará la clase y llamará al metodo validate 
    //              * esta rule solo funciona junto con reglas sencillas,
    //              * no utilizar junto a donde estan reglas que llevan signos de igualdad(min:,max:,size:),
    //              * ni con signos de comparación('<','>','<=','>=','==','===','!=','!=='),
    //              * ni junto con la regla unique
    //              *  */
    //             if (false !== strpos($value, $this->not)) :
    //                 $rule = substr($value, 1);  //!rule Ej: !number
    //                 $this->classValidation($rule); //intanciar la rule class
    //                 $data = ($value === 'file' || $value === 'required'  &&  isset($_FILES[$atribute])) ? ($_FILES[$atribute]['tmp_name']) : $valueAtribute; // si la regla es file que busque el $_FILES sino es atributtes
    //                 $return = call_user_func_array(array($this->classValidate, 'validate'), [$data]);  //llamo al método de la clase

    //                 if (true === $return) $this->addErrorByRule($atribute, $value, [$valueAtribute, $value]);
    //             endif;


    //             /**
    //              * Rule Class igual (:)
    //              * si  hay un signo de igualdad(:), la regla con atributes  encuentra su clase de validación 
    //              * la va instaciar y llamarará al método validate y le pasará los datos. */
    //             if (false !== strpos($value, $this->equals)) :
    //                 $part = explode($this->equals, $value);
    //                 $rule  = $part[0];    // nombre de la rule 
    //                 $value = $part[1];   //atributes

    //                 $this->classValidation($rule);
    //                 $rigth = $value; // value
    //                 $left  = $_FILES[$atribute]['tmp_name'] ?? $valueAtribute;
    //                 $return = call_user_func_array(array($this->classValidate, 'validate'),  [$left, $rigth]);  //llamo a al metodo de la clase

    //                 if (false === $return) $this->addErrorByRule($atribute, $rule, [$rule => $value]);

    //                 /**
    //                  * Rule Class para atribute con signos de iguales (:)
    //                  * los que tienen signo de iguals pero no son rules sino campos,
    //                  * revisará si tienen el mismo atributtes  */
    //                 if (in_array($rule, [$atribute]) && array_key_exists($rule, post())) :
    //                     $this->classValidation('equal'); //intanciar la rule class
    //                     $val = Post($value) ?? []; // value
    //                     $return = call_user_func_array(array($this->classValidate, 'validate'),  [$valueAtribute, $val]);  //llamo a al metodo de la clase

    //                     if (false === $return) $this->addErrorByRule($atribute, 'equals', ['field' => $value]);
    //                 endif;
    //             endif;

    //             /**
    //              * Rule class Unique (unique[table] )
    //              * verifica si existe en la base de datos  */
    //             $unique = 'unique' . $this->grouper_open;
    //             $gOpen  = @strpos($value, $unique);
    //             $gclose = @strpos($value, $this->grouper_close);

    //             if (false !== $gOpen && false !== $gclose) :
    //                 $tableName = explode($unique, $value);
    //                 $tableName = rtrim($tableName[1], $this->grouper_close);

    //                 $this->classValidation('unique');
    //                 $return = call_user_func_array(array($this->classValidate, 'validate'),  [$tableName, $atribute, $valueAtribute]);  //llamo a al metodo de la clase

    //                 if (false === $return) $this->addErrorByRule($atribute, 'unique', ['field' => $atribute]);
    //             endif;


    //             /**
    //              * Rule Class Comparacion number ('<','>','<=','>=','==','===','!=','!==')
    //              *  si  hay un signo de comparación ,la regla con atributes  encuentra su clase de validación 
    //              *la va instaciar y llamarará al método validate y le pasará los datos. */
    //             $count = count($this->compare);
    //             for ($i = 0; $i < $count; $i++) :

    //                 if (false !== strpos($value, $this->compare[$i])) :
    //                     $part = explode($this->compare[$i], $value);
    //                     $value = $part[1];   //value

    //                     $this->classValidation('compare');
    //                     $left  = $_FILES[$atribute]['tmp_name'] ?? $valueAtribute;
    //                     $rigth = $value; // value

    //                     $return = call_user_func_array(array($this->classValidate, 'validate'),  [$left, $rigth, $this->compare[$i]]);  //llamo a al metodo de la clase

    //                     if (false === $return) $this->addErrorByRule($atribute, 'compare', ['field' => $atribute, 'operator' => $this->compare[$i], 'value' => $value]);


    //                     /**
    //                      * Rule Class Comparation for fields ('<','>','<=','>=','==','===','!=','!==')
    //                      * los que tienen signo de comparation pero no son campos,
    //                      * realizará una comparacion entre los atributtes de los fields */
    //                     if (array_key_exists($value, post())) :
    //                         $this->classValidation('compare'); //intanciar la rule class
    //                         $rigth = $atributes;
    //                         $left = Post($value) ?? []; // value

    //                         $return = call_user_func_array(array($this->classValidate, 'validate'),  [$left, $atributes, $this->compare[$i]]);  //llamo a al metodo de la clase

    //                         if (false === $return) $this->addErrorByRule($fields, 'compare', ['field' => $fields, 'operator' => $this->compare[$i], 'value' => $value]);
    //                     endif;

    //                 endif;
    //             endfor;

    //         endforeach;
    //     endforeach;

    //     // echo timeExec($star_time);
    //     return empty($this->errors) ? true : false;
    // }

    // private function startValidation(): bool
    // {
    //     if ($this->skipValidation) {
    //         return true;
    //     }
    //     $star_time = microtime(true);
    //     foreach ($this->validationRules as $attribute => $rulePack) {
    //         $valueAttribute = $this->_input->$attribute ?? '';

    //         $rulePack = strpos($rulePack, $this->separator) === false ? $rulePack . $this->separator : $rulePack;
    //         $rules = explode($this->separator, $rulePack);

    //         foreach ($rules as $value) {
    //             $value = str_replace(' ', '', $value);

    //             $this->classValidation($value);
    //             $data = ($value === 'file' || ($value === 'required' && !empty($_FILES[$attribute]['tmp_name']))) ? ($_FILES[$attribute]['tmp_name']) : $valueAttribute;
    //             $return = call_user_func_array([$this->classValidate, 'validate'], [$data]);

    //             if ($return === false) {
    //                 $this->addErrorByRule($attribute, $value, [$valueAttribute, $value]);
    //             }

    //             if (strpos($value, $this->not) !== false) {
    //                 $rule = substr($value, 1);
    //                 $this->classValidation($rule);
    //                 $data = ($value === 'file' || ($value === 'required' && isset($_FILES[$attribute]))) ? ($_FILES[$attribute]['tmp_name']) : $valueAttribute;
    //                 $return = call_user_func_array([$this->classValidate, 'validate'], [$data]);

    //                 if ($return === true) {
    //                     $this->addErrorByRule($attribute, $value, [$valueAttribute, $value]);
    //                 }
    //             }

    //             if (strpos($value, $this->equals) !== false) {
    //                 [$rule, $attributes] = explode($this->equals, $value);
    //                 $this->classValidation($rule);
    //                 $right = $attributes;
    //                 $left = $_FILES[$attribute]['tmp_name'] ?? $valueAttribute;
    //                 $return = call_user_func_array([$this->classValidate, 'validate'],  [$left, $right]);

    //                 if ($return === false) {
    //                     $this->addErrorByRule($attribute, $rule, [$rule => $attributes]);
    //                 }

    //                 if (in_array($rule, [$attribute]) && array_key_exists($rule, post())) {
    //                     $this->classValidation('equal');
    //                     $val = post($attributes) ?? [];
    //                     $return = call_user_func_array([$this->classValidate, 'validate'],  [$valueAttribute, $val]);

    //                     if ($return === false) {
    //                         $this->addErrorByRule($attribute, 'equals', ['field' => $attributes]);
    //                     }
    //                 }
    //             }

    //             $unique = 'unique' . $this->grouper_open;
    //             $gOpen = strpos($value, $unique);
    //             $gClose = strpos($value, $this->grouper_close);

    //             if ($gOpen !== false && $gClose !== false) {
    //                 $tableName = rtrim(explode($unique, $value)[1], $this->grouper_close);
    //                 $this->classValidation('unique');
    //                 $return = call_user_func_array([$this->classValidate, 'validate'], [$valueAttribute, $tableName]);

    //                 if ($return === false) {
    //                     $this->addErrorByRule($attribute, 'unique', [$tableName]);
    //                 }
    //             }

    //         }
    //     }

    //     return true;
    // }


    // private function startValidation(): bool
    // {
    //     if ($this->shouldSkipValidation()) {
    //         return true;
    //     }

    //     foreach ($this->validationRules as $attribute => $rules) {
    //         $value = $input[$attribute] ?? '';

    //         foreach ($this->splitRules($rules) as $rule) {
    //             $ruleName = $this->getRuleName($rule);
    //             $args = $this->getRuleArguments($rule, $value, $attribute, $input);

    //             if (!$this->validateRule($ruleName, $args)) {
    //                 $this->addErrorByRule($attribute, $ruleName, $args);
    //             }
    //         }
    //     }

    //     return true;
    // }


    // private function shouldSkipValidation(): bool
    // {
    //     return $this->skipValidation;
    // }


    // private function splitRules(string $rulePack): array
    // {
    //     $separator = $this->separator . ' ';
    //     $rulePack = rtrim($rulePack, $this->separator);
    //     return explode($separator, $rulePack);
    // }


    // private function getRuleName(string $rule): string
    // {
    //     return str_replace(' ', '', $rule);
    // }


    // private function getRuleArguments(string $rule, $value, string $attribute, array $input): array
    // {
    //     switch ($rule) {
    //         case 'file':
    //             return [$_FILES[$attribute]['tmp_name']];
    //         case 'required':
    //             return [!empty($_FILES[$attribute]['tmp_name']) ? $_FILES[$attribute]['tmp_name'] : $value];
    //         case 'equals':
    //             [$ruleName, $args] = explode($this->equals, $rule);
    //             $left = $_FILES[$attribute]['tmp_name'] ?? $value;
    //             $right = $this->getRightArg($args, $input);
    //             return [$left, $right];
    //         case 'unique':
    //             $tableName = $this->getRightArg($rule, $input);
    //             return [$value, $tableName];
    //         default:
    //             return [$value];
    //     }
    // }


    // private function getRightArg(string $arg, array $input): array
    // {
    //     return strpos($arg, '.') !== false ? $this->getNestedValue($input, $arg) : ($input[$arg] ?? []);
    // }


    // private function getNestedValue(array $input, string $key): array
    // {
    //     foreach (explode('.', $key) as $segment) {
    //         if (!is_array($input) || !array_key_exists($segment, $input)) {
    //             return [];
    //         }

    //         $input = $input[$segment];
    //     }

    //     return $input;
    // }


    // private function validateRule(string $ruleName, array $args): bool
    // {
    //     $this->classValidation($ruleName);
    //     return call_user_func_array([$this->classValidate, 'validate'], $args);
    // }


    /**
     * Itancia la clase rule y verifica si existe.
     * */
    public function classValidation(string $classRuleName)
    {
        $class = "Axm\\Validation\\Rules\\" . ucfirst($classRuleName);
        if (!class_exists($class)) {
            return;
        }

        $this->classValidate = new $class;

        $method = "validate";
        if (!method_exists($this->classValidate, $method)) {

            throw new AxmException(Axm::t("Axm", 'El método "{method}" no existe en la clase "{class}".', [
                "{method}" => $method,
                "{class}" => $class,
            ]));

            return;
        }

        return $this->classValidate;
    }

    /**
     * Resets the class to a blank slate. Should be called whenever
     * you need to process more than one array.  */
    public function reset()
    {
        $this->rules           = [];
        $this->errors          = [];
        $this->validationRules = [];

        return $this;
    }



    /**
     * Agrega ala lista de errores un error mas, esta funcion es usada por la fuuncion validate 
     * para encontrar los errores y agrearlos a la lista. El mismo remplaza en los mensajes de errores 
     * el valor del atrbuto colocado entre {{}} 
     * @param string $fields 
     * @param string $rule 
     * @param array $params  */
    // protected function addErrorByRule(string $fields, string $rule, $params = [])
    // {      
    //     $params['field'] ??= $fields;
    //     $errorMessage = $this->errorMessage[$rule];

    //     foreach ($params as $key => $value):
    //         $errorMessage = str_replace("{{$key}}", $value, $errorMessage);
    //     endforeach;

    //     $addError = [
    //                  'rules'  => $rule, 
    //                  'errors' => $errorMessage
    //                 ];
    //     $this->rule = $rule;
    //     $this->errors[$fields] ??= $addError;
    //     $this->countOccurrencesErrors($this->rule);
    // }

    protected function addErrorByRule(string $field, string $rule, array $params = [])
    {
        $params['field'] = $field;
        $errorMessage = strtr($this->errorMessage[$rule], $params);
        $this->errors[$field][] = [
            'rule' => $rule,
            'message' => $errorMessage
        ];

        $this->countOccurrencesErrors($rule);
    }



    /**
     * Devuelve el error solicitado de la lista por default de los errores del framework 
     * 
     * @param string $rule */
    public function errorMessage($rule)
    {
        return $this->errorMessages[$rule];
    }



    /**
     * Agrega a la lista de errores un error más, con un message 
     * ej:  $model->addError('user', 'required', 'este campo es requerido');
     * 
     * @param string $fields 
     * @param string $rule 
     * @param string $errorMessage  */
    // public function addError(string $fields,string $rule, string $errorMessage = '')
    // {   
    //     $errorMessage ??= $this->errorMessages[$rule];
    //     $addError = [
    //                   'rules'  => $rule, 
    //                   'errors' => $errorMessage 
    //                 ];

    //     $this->rules[] = $rule;
    //     $this->rule = $rule;
    //     $this->errors[$fields] ??= $addError;
    //     $this->countOccurrencesErrors($this->rule);
    // }

    public function addError(string $field, string $rule, string $message = '')
    {
        $message = $message ?: $this->errorMessages[$rule];
        $this->errors[$field][] = [
            'rule' => $rule,
            'message' => $message
        ];
        $this->rules[] = $this->rule = $rule;
        $this->countOccurrencesErrors($rule);
    }



    /**
     * Esta funcion sirve para contar las ocurrencias de cada rules
     * @param string $rule
     * */
    public function countOccurrencesErrors(string $rule = null)
    {
        if (!empty($rule)) :
            $_SESSION['__occurrencesErrors' . $rule] ??= 0;
            ++$_SESSION['__occurrencesErrors' . $rule];
            $this->countErrors = [
                'rule'  => $rule,
                'count' => $_SESSION['__occurrencesErrors' . $rule],
            ];
            return (int) ($this->countErrors) ?? 0;
        endif;

        return false;
    }


    /**
     * Esta funcion sirve para resetear la cuenta de ocurrencia de erroes de una rule.
     * */
    public function resetCountError(string $rule)
    {
        unset($_SESSION['__occurrencesErrors' . $rule]);
    }


    /**
     * Esta funcion sirve para resetear la cuenta de ocurrencia de erroes de una rule
     * */
    public function resetCountErrors(array $rules)
    {
        foreach ($rules as $rule) :
            if (array_key_exists('__occurrencesErrors' . $rule, $_SESSION))
                unset($_SESSION['__occurrencesErrors' . $rule]);
        endforeach;
    }


    /**
     * Stores the rules that should be used to validate the items.
     * Rules should be an array formatted like:
     *
     *    [
     *        'field' => 'rule1|rule2'
     *    ]
     * 
     *  * The $errors array should be formatted like:
     *    [
     *        'field' => [
     *            'rule' => 'message',
     *            'rule' => 'message
     *        ],
     *    ]
     *
     * @param array $rules */
    public function setRules(array $rules)
    {
        $this->reset();
        $this->validationRules = $rules;

        return $this;
    }

    /**
     * Agrega las reglas asignadas a la reglas de validacion.
     *
     * @param array $rules */
    public function addRules(array $rules)
    {
        foreach ($rules as $key => $value) :
            $this->validationRules[$key] = $value;
        endforeach;

        return $this;
    }



    /**
     * Modifica en la lista de mensajes errores un nuevo mensaje, con un message 
     * ej: $model->setError('email', 'required', 'este campo debe de ser un email');
     * 
     * @param string $fields 
     * @param string $rule 
     * @param string $newMessage */
    public function setError(string $field, string $rule, string $newMessage)
    {
        $addError = [
            'rules'  => $rule,
            'message' => $newMessage
        ];
        $this->errors[$field] = $addError;
    }


    /**
     * Devuelve el error del campo solicitado si existe sino false
     * 
     * @param string $fields  */
    public function hasError($fields)
    {
        return $this->errors[$fields] ?? false;
    }


    public function getFirstErrorByField(string $field)
    {
        if (!array_key_exists($field, $this->errors)) {
            return '';
        }

        return $this->errors[$field][0]['message'];
    }


    /**
     * Devuelve todos los errores existentes en la lista
     * @return string
     */
    public function getErrors()
    {
        return $this->errors ?? '';
    }


    /**
     * Devuelve todos los errores existentes en la lista
     * @return string
     */
    public function getFirstError()
    {
        $errors = $this->errors ?? '';

        if (!empty($errors) && is_array($errors)) {
            $error = array_values($errors);
            [$errors] = $error;
        }
        return (string) isset($errors['message']) ? $errors['message'] : '';
    }


    /**
     * Verifica si el value Axm:model del input enviado tiene algún error lo muestra.
     * 
     * @return string
     */
    public function validateOne()
    {
        $field = array_keys($this->data)[0];
        if (!empty($field))
            return show($this->getFirstErrorByField($field));
    }


    /**
     * Inicia la conexion con la base de datos
     * para utlizar los modelos 
     */
    private function init()
    {
        // Axm::app()->config()->load(APP_PATH . '/Config/DataBase.php');
        // $db = Axm::app()->config()->get('DB');
        // Axm::app()->load('Config.DataBase');
        // Axm::app()->db;
        Axm::app()->config(APP_PATH . '/Config/DataBase.php');
        // dd(
        //     Axm::config('db'),
        //     Axm::app()->config()->get('DB')
        // );

        $db = Axm::app()->config()->get('DB');
        // var_dump(
        //     $this->getInstanceDb($db)
        // );
        Axm::app('db', function () use ($db) {
            return static::getInstanceDb($db);
        });

        // Axm::app()->
        // Axm::app()->db = self::getInstanceDb($db); //crea la conexion
    }


    private function startValidation(): bool
    {
        if ($this->skipValidation) {
            return true;
        }

        foreach ($this->validationRules as $attribute => $rulePack) {
            $valueAttribute = $this->_input->$attribute ?? '';

            $rules = $this->extractRules($rulePack);

            foreach ($rules as $rule) {
                $return = $this->validateAttribute($attribute, $valueAttribute, $rule);

                if ($return === false) {
                    $this->addErrorByRule($attribute, $rule, [$valueAttribute, $rule]);
                }
            }
        }

        return true;
    }


    private function extractRules(string $rulePack): array
    {
        $rulePack = strpos($rulePack, $this->separator) === false ? $rulePack . $this->separator : $rulePack;
        $rules = explode($this->separator, $rulePack);

        return array_map(function ($value) {
            return str_replace(' ', '', $value);
        }, $rules);
    }


    private function validateAttribute(string $attribute, string $valueAttribute, string $rule): bool
    {
        $this->classValidation($rule);

        if ($this->isFileAttribute($rule, $attribute) || $this->isRequiredFile($rule, $attribute)) {
            $data = $_FILES[$attribute]['tmp_name'];
        } else {
            $data = $valueAttribute;
        }

        $return = call_user_func_array([$this->classValidate, 'validate'], [$data]);

        if ($this->isNotAttribute($rule) && $return === true) {
            return false;
        }

        if ($this->isEqualsAttribute($rule, $attribute) && $this->validateEqualsAttribute($attribute, $valueAttribute, $rule) === false) {
            return false;
        }

        if ($this->isUniqueAttribute($rule, $attribute)) {
            $tableName = $this->extractUniqueTableName($rule);
            $return = call_user_func_array([$this->classValidate, 'validate'], [$valueAttribute, $tableName]);

            if ($return === false) {
                return false;
            }
        }

        return true;
    }


    private function isFileAttribute(string $rule, string $attribute): bool
    {
        return $rule === 'file' && isset($_FILES[$attribute]);
    }


    private function isRequiredFile(string $rule, string $attribute): bool
    {
        return $rule === 'required' && !empty($_FILES[$attribute]['tmp_name']);
    }


    private function isNotAttribute(string $rule): bool
    {
        return strpos($rule, $this->not) !== false;
    }


    private function isEqualsAttribute(string $rule, string $attribute): bool
    {
        return strpos($rule, $this->equals) !== false && in_array($attribute, [$this->equalsAttribute($rule)]);
    }


    private function equalsAttribute(string $rule): string
    {
        [$attribute] = explode($this->equals, $rule);
        return $attribute;
    }


    private function validateEqualsAttribute(string $attribute, string $valueAttribute, string $rule): bool
    {
        [, $attributes] = explode($this->equals, $rule);
        $this->classValidation('equal');
        $val = post($attributes) ?? [];
        $return = call_user_func_array([$this->classValidate, 'validate'],  [$valueAttribute, $val]);

        if ($return === false) {
            $this->addErrorByRule($attribute, 'equals', ['field' => $attributes]);
            return false;
        }

        return true;
    }


    private function isUniqueAttribute(string $rule, string $attribute): bool
    {
        $unique = 'unique' . $this->grouper_open;
        return strpos($rule, $unique) !== false && strpos($rule, $this->grouper_close) !== false;
    }


    private function extractUniqueTableName(string $rule): string
    {
        $unique = 'unique' . $this->grouper_open;
        $tableName = rtrim(explode($unique, $rule)[1], $this->grouper_close);
        return $tableName;
    }
}
