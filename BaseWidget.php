<?php
/**
 * @author PhpTheme Dev Team
 * @license MIT
 * @link http://getphptheme.com
 */
namespace PhpTheme\Core;

use ReflectionClass;
use PhpTheme\Html\HtmlHelper;

abstract class BaseWidget implements WidgetInterface
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

    public function escape($string, $encoding = 'utf-8', $specialCharsFlags = null)
    {
        return HtmlHelper::escape($string, $encoding, $specialCharsFlags);
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
        
        return dirname($reflection->getFileName()) . '/Views';
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