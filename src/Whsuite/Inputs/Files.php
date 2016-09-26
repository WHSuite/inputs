<?php

namespace Whsuite\Inputs;

/**
 * Interfacing class to make it easier to work with inputs.
 */
class Files implements \Whsuite\Inputs\Interfaces\InputsInterface
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
            $var_key = 'files.' . $var;
        } else {
            $var_key = 'files';

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
        Inputs::instance()->set('files.' . $var, $data);
    }

}
