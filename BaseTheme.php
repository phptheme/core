<?php
/**
 * @author PhpTheme Dev Team <dev@getphptheme.com>
 * @license MIT
 * @link http://getphptheme.com
 */
namespace PhpTheme\Core;

abstract class BaseTheme
{

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
        
        return $widget->toString();
    }

    public function createWidget(string $class, array $params = [])
    {
        if (is_subclass_of($class, ThemeWidget::class, true))
        {
            $widget = new $class($this, $params);
        }
        else
        {
            $widget = new $class($params);
        }

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

        $return = $widget->toString();

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