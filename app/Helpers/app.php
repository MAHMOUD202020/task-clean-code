<?php

if (! function_exists('rules')) {

    /**
     * get validator from file config/Validator.php where key
     *
     * @param string $key
     * @param array $append
     *
     */

    function rules($key , $append = [])
    {
        return  array_merge(config("rules.$key") , $append);
    }
}
