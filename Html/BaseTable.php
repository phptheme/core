<?php
/**
 * @copyright Copyright (c) 2018-2019 PhpTheme Dev Team
 * @link http://getphptheme.com
 * @license MIT License
 */
namespace PhpTheme\Html;

use PhpTheme\Helpers\Html;
use Closure;

abstract class BaseTable extends \PhpTheme\Core\Widget
{

    const TABLE_ROW = Tag::class;

    const TABLE_HEADER = TableHeader::class;

    const TABLE_FOOTER = TableFooter::class;

    const TABLE_BODY = TableBody::class;

    const TABLE_COLUMN = TableColumn::class;

    public $defaultRow = ['tag' => 'tr'];

    public $rows = [];

    public $columns = [];

    public $options = [];

    public $defaultOptions = [];

    public $header = [];

    public $defaultHeader = [];

    public $footer = [];

    public $defaultFooter = [];

    public $body = [];

    public $defaultBody = [];

    public $defaultColumn = [];

    public function renderRow($content)
    {
        $options = Html::mergeOptions($this->defaultRow, ['content' => $content]);

        return $this->theme->widget(static::TABLE_ROW, $options);
    }    

    public function rowColumns($row)
    {
        $columns = $this->columns;

        if ($columns instanceof Closure)
        {
            $columns = $columns->bindTo($this);

            $columns = $columns($row);
        }

        return $columns;
    }

    protected function renderHeader()
    {
        $options = Html::mergeOptions(
            $this->defaultHeader, 
            $this->header,
            [
                'table' => $this
            ]
        );

        return $this->theme->widget(static::TABLE_HEADER, $options);
    }

    protected function renderFooter()
    {
        $options = Html::mergeOptions(
            $this->defaultFooter, 
            $this->footer,
            [
                'table' => $this
            ]
        ); 

        return $this->theme->widget(static::TABLE_FOOTER, $options);
    }

    protected function renderBody()
    {
        $options = Html::mergeOptions(
            $this->defaultBody, 
            $this->body, 
            [
                'table' => $this
            ]
        );

        return $this->theme->widget(static::TABLE_BODY, $options);
    }

    public function createColumn($options = [])
    {
        $options = Html::mergeOptions($this->defaultColumn, $options);

        if (array_key_exists('class', $options))
        {
            $class = $options['class'];

            unset($options['class']);
        }
        else
        {
            $class = static::TABLE_COLUMN;
        }

        return $this->theme->createWidget($class, $options);
    }

    protected function prepareColumns()
    {
        foreach($this->columns as $key => $column)
        {
            if (is_string($column))
            {
                $column = ['content' => $column];
            }

            if (is_array($column))
            {
                $column = $this->createColumn($column);
            }

            $this->columns[$key] = $column;
        }
    }

    public function run()
    {
        $this->prepareColumns();

        $content = $this->renderHeader() . $this->renderBody() . $this->renderFooter();

        $options = Html::mergeOptions($this->defaultOptions, $this->options);

        return Html::tag('table', $content, $options);
    }

}