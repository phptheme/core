<?php
/**
 * @copyright Copyright (c) 2018-2019 getphptheme.com
 * @link http://getphptheme.com
 * @license MIT License
 */
namespace PhpTheme\Core;

use PhpTheme\View\RenderFileTrait;

abstract class BaseTheme
{

    use RenderFileTrait;

    const TABLE = Table::class;

    const FORM = Form::class;

    public $defaultTable = [];

    public $defaultForm = [];

    public $baseUrl = '';

    public function escape($string, $encoding = 'utf-8', $specialCharsFlags = null)
    {
        return Html::escape($string, $encoding, $specialCharsFlags);
    }

    public function beginContent()
    {
        ob_start();
    }

    public function endContent()
    {
        return ob_get_clean();
    }

    public function widget(string $class, array $params = [])
    {
        $widget = $this->createWidget($class, $params);
        
        return $widget->run();
    }

    public function table($table)
    {
        $table = Html::mergeOptions($this->defaultTable, $table);

        return $this->widget(static::TABLE, $table);
    }

    public function form($form)
    {
        $form = Html::mergeOptions($this->defaultForm, $form);

        return $this->widget(static::FORM, $form);
    }

    public function createWidget(string $class, array $params = [])
    {
        $params['theme'] = $this;

        $widget = $class::factory($params);

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