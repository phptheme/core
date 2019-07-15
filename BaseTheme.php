<?php
/**
 * @copyright Copyright (c) 2018-2019 PhpTheme Dev Team
 * @link http://getphptheme.com
 * @license MIT License
 */
namespace PhpTheme\Core;

use PhpTheme\Helpers\Html;

abstract class BaseTheme extends View
{

    const TABLE = Table::class;

    public $baseUrl = '';

    public $defaultTable = [];

    public $defaultForm = [];

    public $head = '';

    public $beginBody = '';

    public $endBody = '';

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

    public function createTable(array $options = [])
    {
        $options = Html::mergeOptions($this->defaultTable, $options);

        return $this->createWidget(static::TABLE, $options);
    }

    public function table(array $options = [])
    {
        $table = $this->createTable($options);

        return $table->run();
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