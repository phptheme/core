<?php
/**
 * @copyright Copyright (c) 2018-2019 getphptheme.com
 * @link http://getphptheme.com
 * @license MIT License
 */
namespace PHPTheme\Core;

use PHPTheme\View\RenderFileTrait;

abstract class BaseTheme
{

    public $baseUrl;

    public function widget(string $class, array $params = [])
    {
        $widget = $this->createWidget($class, $params);
        
        return $widget->run();
    }

    public function createWidget(string $class, array $params = [])
    {
        $params['theme'] = $this;

        $widget = $class::factory($this, $params);

        return $widget;
    }

    public function beginWidget(string $class, array $params = [])
    {
        $widget = $class::factory($this, $params);

        ob_start();

        return $widget;
    }

    public function endWidget($widget)
    {
        $content = ob_get_clean();

        $widget->content = $content;

        return $widget->run();
    }

}