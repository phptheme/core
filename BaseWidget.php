<?php
/**
 * @author PhpTheme Dev Team <dev@getphptheme.com>
 * @license MIT
 * @link http://getphptheme.com
 */
namespace PhpTheme\Core;

use ReflectionClass;

abstract class BaseWidget extends Tag
{

    use RenderFileTrait;

    const VIEWS_DIR = 'Views';

    protected $_viewPath;

    public function getViewPath() : string
    {
        if (!$this->_viewPath)
        {
            $reflection = new ReflectionClass($this);

            $this->_viewPath = dirname($reflection->getFileName()) . (static::VIEWS_DIR ? (DIRECTORY_SEPARATOR . static::VIEWS_DIR) : '');
        }
    
        return $this->_viewPath;
    }

    public function render($template, $params = []) : string
    {
        return $this->renderFile($this->getViewPath() . DIRECTORY_SEPARATOR . $template . '.php', $params);
    }

}