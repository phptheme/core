<?php
/**
 * @author PhpTheme Dev Team <dev@getphptheme.com>
 * @license MIT
 * @link http://getphptheme.com
 */
namespace PhpTheme\Core;

abstract class BaseThemeWidget extends Widget implements ThemeWidgetInterface
{

    protected $_theme;

    public $content;

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

        return null;
    }

    public function getTheme()
    {
        return $this->_theme;
    }

}