<?php
/**
 * @author PhpTheme Dev Team <dev@getphptheme.com>
 * @license MIT
 * @link http://getphptheme.com
 */
namespace PhpTheme\Core;

abstract class BaseThemeWidget extends Widget
{

    protected $_theme;

    abstract public function toString() : string;

    public function __construct(Theme $theme, array $params = [])
    {
        $this->_theme = $theme;

        parent::__construct($params);
    }

    public function __get(string $name)
    {
        if ($name == 'theme')
        {
            return $this->getTheme();
        }

        return parent::__get($name);
    }

    public function getTheme()
    {
        return $this->_theme;
    }

}