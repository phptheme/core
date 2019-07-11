<?php

namespace PhpTheme\Core;

use PhpTheme\Core\Html;

class TableBody extends Widget
{

    const ROW = TableRow::class;

    public $rows = [];

    public $tag = 'tbody';

    public $options = [];

    public $defaultOptions = [];

    public $columns = [];

    public $defaultRow = [
        'tag' => 'tr'
    ];

    protected function renderRow($row)
    {
        $options = Html::mergeOptions($this->defaultRow, [
            'columns' => $this->columns,
            'data' => $row
        ]);

        return $this->theme->widget(static::ROW, $options);
    }

    public function run()
    {
        $content = '';

        foreach($this->rows as $row)
        {
            $content .= $this->renderRow($row);
        }

        $options = Html::mergeOptions($this->defaultOptions, $this->options);

        return Html::tag($this->tag, $content, $options);
    }

}