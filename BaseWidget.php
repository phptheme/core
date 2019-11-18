<?php
/**
 * @author PhpTheme Dev Team
 * @license MIT
 * @link http://getphptheme.com
 */
namespace PhpTheme\Core;

abstract class BaseWidget extends View
{

    public $theme;

    const VIEWS_DIR = 'Views';

    abstract public function toString() : string;

    public function __toString()
    {
        return $this->toString();
    }

    public function getViewPath()
    {    
        return dirname($this->getReflection()->getFileName()) . (static::VIEWS_DIR ? ('/' . static::VIEWS_DIR) : '');
    }

    public function render($template, $params = [])
    {
        return $this->renderFile($this->getViewPath() . '/' . $template . '.php', $params);
    }

}