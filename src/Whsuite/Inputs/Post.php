<?php

namespace Whsuite\Inputs;

/**
 * Interfacing class to make it easier to work with inputs.
 */
class Post implements \Whsuite\Inputs\Interfaces\InputsInterface
{
    /**
     * get a post variable
     *
     * @param   string  dot notation of the variable to get
     * @return  mixed   variable data
     */
    public static function get($var = null)
    {
        if (!empty($var)) {
            $var_key = 'post.' . $var;
        } else {
            $var_key = 'post';
        }
        return Inputs::instance()->get($var_key);
    }

    /**
     * set a post variable
     *
     * @param   string  dot notation of the variable to set
     * @param   mixed   data to set
     * @return  mixed   variable data
     */
    public static function set($var, $data)
    {
        Inputs::instance()->set('post.' . $var, $data);
    }

}
