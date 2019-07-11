<?php

namespace PhpTheme\Core;

use PhpTheme\Core\Html;

class TableFooter extends \PhpTheme\Core\Widget
{

    const ROW = TableRow::class;

    public $tag = 'tfoot';

    public $columns = [];

    public $defaultRow = [];

    public $options = [];

    public $defaultOptions = [];

    protected function renderRow()
    {
        $options = Html::mergeOptions($this->defaultRow, [
            'columns' => $this->columns,
            'defaultColumn' => [
                'tag' => 'td'
            ]
        ]);

        return $this->theme->widget(static::ROW, $options);
    }

    public function run()
    {
        $empty = true;

        foreach($this->columns as $column)
        {
            if ($column)
            {
                $empty = false;

                break;
            }
        }

        if ($empty)
        {
            return '';
        }

        $content = $this->renderRow();

        $options = Html::mergeOptions($this->defaultOptions, $this->options);

        return Html::tag($this->tag, $content, $options);
    }   

}