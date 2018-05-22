<?php

    function __autoload($class)
    {
        $locais = ['classes', 'controllers'];
        
        foreach($locais as $local)
        {
            if(file_exists(ROOT.'/'.$local.'/'.$class.'.class.php'))
            {
                require_once ROOT.'/'.$local.'/'.$class.'.class.php';
                return true;
            }
        }

        return false;
    }

    spl_autoload_register('__autoload');

?>