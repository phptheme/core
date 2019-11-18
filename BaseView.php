<?php
/**
 * @author PhpTheme Dev Team
 * @license MIT
 * @link http://getphptheme.com
 */
namespace PhpTheme\Core;

use Exception;
use PhpTheme\Html\HtmlHelper;
use PhpTheme\Html\FactoryTrait;

abstract class BaseView
{

    use RenderFileTrait;

    use FactoryTrait;
    
    use ReflectionTrait;

    public function __construct()
    {
    }

    public function escape($string, $encoding = 'utf-8', $specialCharsFlags = null)
    {
        return HtmlHelper::escape($string, $encoding, $specialCharsFlags);
    }

}