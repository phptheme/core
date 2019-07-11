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

    public $defaultColumn = [
        //'header' => null,
        //'content' => null,
        //'footer' => null,
        //'attribute' => null
    ];

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
            $content .= $this->renderColumn($column);
        }

        $options = Html::mergeOptions($this->defaultOptions, $this->options);

        return Html::tag($this->tag, $content, $options);
    }

}