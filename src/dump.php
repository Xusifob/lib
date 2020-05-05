<?php

if(!function_exists('dump')) {

    /**
     *
     * This function allows you to dump some vars nicely when not using XDEBUG
     *
     * @param mixed ...$vars
     */
    function dump(...$vars)
    {

        echo '<pre>';
        ob_start();
        foreach($vars as $var) {
            var_dump($var);
            $data = ob_get_clean();
            echo htmlentities($data);
        }
        echo '</pre>';
    }

}
