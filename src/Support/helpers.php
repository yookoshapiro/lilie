<?php

if( ! function_exists('lilie_path'))
{
    /*
     * Get the path to the Lilie-Package.
     *
     * @param   string  $path
     * @return  string
     */
    function lilie_path($path = '')
    {
        return Config::get('packages.lilie.path') . ($path ?  DIRECTORY_SEPARATOR . $path : $path);
    }
}