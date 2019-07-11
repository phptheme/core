<?php

namespace PhpTheme\Core;

use PhpTheme\Core\Html;

class Table extends Widget
{

    const HEADER = TableHeader::class;

    const FOOTER = TableFooter::class;

    const BODY = TableBody::class;

    const COLUMN = TableColumn::class;

    const ATTRIBUTE_COLUMN = TableAttributeColumn::class;

    public $columns = [];

    public $options = [];

    public $defaultOptions = [];

    public $header = [];

    public $defaultHeader = [];

    public $footer = [];

    public $defaultFooter = [];

    public $body = [];

    public $defaultBody = [];

    public $defaultAttributeColumn = [];

    public $defaultColumn = [];

    public function createAttributeColumn($options = [])
    {
        $options = Html::mergeOptions($this->defaultAttributeColumn, $options);

        return $this->theme->createWidget(static::ATTRIBUTE_COLUMN, $options);
    }    

    protected function renderHeader()
    {
        $options = Html::mergeOptions($this->defaultHeader, $this->header);

        if (empty($options['columns']))
        {
            foreach($this->columns as $i => $column)
            {
                $options['columns'][$i] = $column->getHeaderOptions();

                $options['columns'][$i]['content'] = $column->header;
            }
        }

        return $this->theme->widget(static::HEADER, $options);
    }

    protected function renderFooter()
    {
        $options = Html::mergeOptions($this->defaultFooter, $this->footer); 

        if (empty($options['columns']))
        {
            foreach($this->columns as $i => $column)
            {
                $options['columns'][$i] = $column->getFooterOptions();
                
                $options['columns'][$i]['content'] = $column->footer;
            }
        }

        return $this->theme->widget(static::FOOTER, $options);
    }

    protected function renderBody()
    {
        $options = Html::mergeOptions(
            $this->defaultBody, 
            $this->body, 
            [
                'columns' => $this->columns,
                'rows' => $this->rows
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

        return Html::tag(
            'table', 
            $this->renderHeader() . $this->renderBody() . $this->renderFooter(), 
            Html::mergeOptions(
                $this->defaultOptions, 
                $this->options
            )
        );
    }    

}