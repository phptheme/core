<?php
/**
 * @author PhpTheme Dev Team
 * @license MIT
 * @link http://getphptheme.com
 */
namespace PhpTheme\Core;

use ReflectionClass;

trait ReflectionTrait
{

    public function getReflection()
    {
        static $_reflection;

        if (!$_reflection)
        {
            $_reflection = new ReflectionClass(get_class($this));
        }

        return $_reflection;
    }

}