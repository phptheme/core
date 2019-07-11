<?php

namespace PhpTheme\Core;

use PhpTheme\Core\Html;

class TableRow extends Widget
{

    const COLUMN = TableColumn::class;

    public $tag = 'tr';

    public $data = [];

    public $columns = [];

    public $options = [];

    public $defaultOptions = [];

    public $defaultColumn = [];

    protected function renderColumn($column)
    {
        $column = Html::mergeOptions(
            $this->defaultColumn, 
            $column,
            [
                'data' => $this->data
            ]
        );
        
        return $this->theme->widget(static::COLUMN, $column);
    }

    public function run()
    {
        if (!$this->columns)
        {
            return '';
        }

        $content = '';

        foreach($this->columns as $column)
        {
            if (is_object($column))
            {
                $column->data = $this->data;

                $content .= $column->run();

                continue;
            }

            $content .= $this->renderColumn($column);
        }

        $options = Html::mergeOptions($this->defaultOptions, $this->options);

        return Html::tag($this->tag, $content, $options);
    }

}