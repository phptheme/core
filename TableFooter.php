<?php

namespace PhpTheme\Core;

use PhpTheme\Core\Html;

class TableFooter extends \PhpTheme\Core\Widget
{

    public $table; // parent table

    public $tag = 'tfoot';

    public $options = [];

    public $defaultOptions = [];

    public function run()
    {
        $content = '';

        $empty = true;

        foreach($this->table->getRowColumns($this->table->emptyRow) as $column)
        {
            if ($column->footer)
            {
                $empty = false;
            }

            $content .= $column->renderFooter();
        }

        if ($empty)
        {
            return '';
        }

        $content = $this->table->renderRow($content);

        $options = Html::mergeOptions($this->defaultOptions, $this->options);

        return Html::tag($this->tag, $content, $options);
    }

}