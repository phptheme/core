<?php
/**
 * @copyright Copyright (c) 2018-2019 PhpTheme Dev Team
 * @link http://getphptheme.com
 * @license MIT License
 */
namespace PhpTheme\Core;

use ReflectionClass;

abstract class BaseWidget
{

    public $theme;

    public $content;

    protected $_reflection;

    abstract function run();

    public static function factory(array $params = [])
    {
        $class = get_called_class();

        $return = new $class;

        foreach($params as $key => $value)
        {
            $return->$key = $value;
        }

        return $return;
    }

    public function getReflection()
    {
        if (!$this->_reflection)
        {
            $this->_reflection = new ReflectionClass(get_class($this));
        }

        return $this->_reflection;
    }

    public function getViewPath()
    {
        $reflection = $this->getReflection();
        
        return dirname($reflection->getFileName()) . '/views';
    }

    public function findViewFile($template)
    {
        return $this->getViewPath() . '/' . $template . '.php';
    }

    public function render($template, $params = [])
    {
        $filename = $this->findViewFile($template);

        return $this->theme->renderFile($filename, $params);
    }

}