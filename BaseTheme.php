<?php
/**
 * @author PhpTheme Dev Team
 * @license MIT
 * @link http://getphptheme.com
 */
namespace PhpTheme\Core;

use PhpTheme\Html\HtmlHelper;
use PhpTheme\Html\Table;

abstract class BaseTheme
{

    public $baseUrl = '';

    public $head = '';

    public $beginBody = '';

    public $endBody = '';

    public function __construct()
    {
    }

    public function beginContent()
    {
        ob_start();
    }

    public function endContent()
    {
        return ob_get_clean();
    }

    public function widget($class, $params = [])
    {
        if (!is_array($params) && !$params)
        {
            return '';
        }

        $widget = $this->createWidget($class, $params);
        
        return $widget->run();
    }

    public function createWidget(string $class, array $params = [])
    {
        $widget = $class::factory($this, $params);

        return $widget;
    }

    public function beginWidget(string $class, array $params = [])
    {
        $widget = $this->createWidget($class, $params);

        $this->beginContent();

        return $widget;
    }

    public function endWidget($widget, $display = true)
    {
        $content = $this->endContent();

        $widget->content = $content;

        $return = $widget->run();

        if ($display)
        {
            echo $return;
        }
        else
        {
            return $return;
        }
    }

}