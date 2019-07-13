<?php

namespace PhpTheme\Core;

use PhpTheme\Core\Html;
use Closure;

class Table extends Widget
{

    const ROW = Tag::class;

    const HEADER = TableHeader::class;

    const FOOTER = TableFooter::class;

    const BODY = TableBody::class;

    const COLUMN = TableColumn::class;

//    const ATTRIBUTE_COLUMN = TableAttributeColumn::class;

    public $defaultRow = ['tag' => 'tr'];

    public $rows = [];

    public $emptyRow;

    public $columns = [];

    public $options = [];

    public $defaultOptions = [];

    public $header = [];

    public $defaultHeader = [];

    public $footer = [];

    public $defaultFooter = [];

    public $body = [];

    public $defaultBody = [];

//    public $defaultAttributeColumn = [];

    public $defaultColumn = [];

    public function renderRow($content)
    {
        $options = Html::mergeOptions($this->defaultRow, ['content' => $content]);

        return $this->theme->widget(static::ROW, $options);
    }    

    public function getRowColumns($row)
    {
        $columns = $this->columns;

        if ($columns instanceof Closure)
        {
            $columns = $columns->bindTo($this);

            $columns = $columns($row);
        }

        return $columns;
    }

    /*

    public function attributeColumn($options = [])
    {
        $options = Html::mergeOptions($this->defaultAttributeColumn, $options);

        return $this->theme->createWidget(static::ATTRIBUTE_COLUMN, $options);
    }

    */

    protected function renderHeader()
    {
        $options = Html::mergeOptions(
            $this->defaultHeader, 
            $this->header,
            [
                'table' => $this
            ]
        );

        return $this->theme->widget(static::HEADER, $options);
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

        return $this->theme->widget(static::FOOTER, $options);
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

        return $this->theme->widget(static::BODY, $options);
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
            $class = static::COLUMN;
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