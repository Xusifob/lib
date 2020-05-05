<?php

if(!function_exists('uc_first')) {

    /**
     *
     * This function allows you to add a capitalize letter to every letter of a word.
     *
     * @Exemple : "Jean-MARIE De la rue" will become "Jean-Marie De La Rue"
     *
     * @param string|null $name
     * @param string $delimiters
     *
     * @return string|null
     */
    function uc_first($name,$delimiters = " -")
    {
        // Return null name is not defined
        if(null === $name) {
            return $name;
        }

        // Here we use "-" and " " as separators. You can add every separator you want
        $pattern = "#([$delimiters])#";

        // Explode the string linked according to the pattern
        $chunks = preg_split($pattern, $name,-1, PREG_SPLIT_DELIM_CAPTURE);

        // On every chunk, we first put everything lowercase then uppercase the 1st character
        foreach ($chunks as &$n) {
            $n = ucfirst(strtolower($n));
        }

        // We re-link everything together
        $name = implode('',$chunks);

        return $name;
    }

}
