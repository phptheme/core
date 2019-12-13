<?php
/**
 * @author PhpTheme Dev Team <dev@getphptheme.com>
 * @license MIT
 * @link http://getphptheme.com
 */
namespace PhpTheme\Core;

interface ThemeWidgetInterface
{

    public function __construct(Theme $theme, array $params = []);

}