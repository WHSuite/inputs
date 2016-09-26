<?php

namespace Whsuite\Inputs\Interfaces;

interface InputsInterface
{

    /**
     * get a variable
     *
     * @param   string  dot notation of the variable to get
     * @return  mixed   variable data
     */
    public static function get($var);

    /**
     * set a variable
     *
     * @param   string  dot notation of the variable to set
     * @param   mixed   data to set
     * @return  mixed   variable data
     */
    public static function set($var, $value);

}