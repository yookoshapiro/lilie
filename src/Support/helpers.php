<?php

if( ! function_exists('lilie_path'))
{
    /**
     * Get the path to the Lilie-Package.
     *
     * @param   string  $path
     * @return  string
     */
    function lilie_path($path = '')
    {
        return Config::get('lilie.path') . ($path ?  DIRECTORY_SEPARATOR . $path : $path);
    }
}


if( ! function_exists('array_undot'))
{
    /**
     * The reverse to array_dot.
     *
     * @param   array   $data
     * @return  array
     */
    function array_undot(array $data)
    {
        $res = array();

        foreach($data as $key => $item)
        {
            array_set($res, $key, $item);
        }

        return $res;
    }
}