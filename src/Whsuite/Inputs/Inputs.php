<?php

namespace Whsuite\Inputs;

use Dflydev\DotAccessData\Data;

/**
 * Input helper to handle post / get / file array
 *
 */
class Inputs
{
    /**
     * data storage
     *
     */
    protected $data;

    /**
     * input instance
     *
     */
    protected static $instance;

    /**
     * initiate and setup the instance
     *
     * @param   bool    wheher to clean the inputs or not
     */
    public static function init($clean = true)
    {
        self::$instance = new Inputs($clean);
    }

    /**
     * get the instance
     *
     */
    public static function instance()
    {
        return self::$instance;
    }

    /**
     * constructor
     *
     * setup the post / get / file variables
     *
     * @param   bool    wheher to clean the inputs or not
     */
    public function __construct($clean = true)
    {
        $this->data = new Data;

        $post = ($clean) ? $this->clean($_POST) : $_POST;
        $get = ($clean) ? $this->clean($_GET) : $_GET;

        if (isset($post) && ! empty($post)) {
            try {
                if (! isset($post['__csrf_value'])) {
                    throw new \Core\Exceptions\CsrfValidationErrorException;
                } else {
                    $csrf_value = $post['__csrf_value'];
                    $validToken = \App::get('session')->getCsrfToken()->isValid($csrf_value);

                    if (! $validToken) {
                        throw new \Core\Exceptions\CsrfValidationErrorException;
                    }
                }
            } catch (\Core\Exceptions\CsrfValidationErrorException $e) {
                \App\Libraries\Message::set(
                    'There was a problem determining the validity of the form request, please try again.',
                    'fail',
                    \App\Libraries\Message::PROTECT
                );
                return false;
            }
        }

        $this->data->set('post', $post);
        $this->data->set('get', $get);
        $this->data->set('files', $_FILES);
    }

    /**
     * clean the input data
     *
     * @param   array|string   data to clean
     * @return  array|string   cleaned data
     */
    public function clean($data)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                if (is_array($value)) {
                    $data[$key] = $this->clean($value);
                } else {
                    $data[$key] = Filter::f($value, 'escapeAll');
                }
            }
        } else {
            $data = Filter::f($data, 'escapeAll');
        }

        return $data;
    }

    /**
     * function overloading to use the data functions
     *
     * @param   string  method name we are trying to load
     * @param   array   array of params to pass to the method
     * @retun   mixed   return of the method
     */
    public function __call($name, $params)
    {
        if (method_exists($this->data, $name)) {
            $method_reflection = new \ReflectionMethod($this->data, $name);

            return $method_reflection->invokeArgs($this->data, $params);
        } else {
            throw new \Exception('Fatal Error: Function '.$name.' does not exist in Inputs->data!');
        }
    }
}
