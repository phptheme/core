<?php

namespace PhpTheme\Core;

use PhpTheme\Core\Html;

class TableBody extends Widget
{

    public $table; // parent table

    public $tag = 'tbody';

    public $options = [];

    public $defaultOptions = [];

    public function run()
    {
        $content = '';

        foreach($this->table->rows as $row)
        {
            $rowContent = '';

            foreach($this->table->getRowColumns($row) as $column)
            {
                $column->row = $row;

                $rowContent .= $column->run();
            }

            $content .= $this->table->renderRow($rowContent);
        }

        $options = Html::mergeOptions($this->defaultOptions, $this->options);

        return Html::tag($this->tag, $content, $options);
    }

}