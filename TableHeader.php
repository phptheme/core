<?php

namespace PhpTheme\Core;

use PhpTheme\Core\Html;

class TableHeader extends \PhpTheme\Core\Widget
{

    public $table; // parent table

    public $tag = 'thead';

    public $options = [];

    public $defaultOptions = [];

    public function run()
    {
        $content = '';

        $empty = true;

        foreach($this->table->getRowColumns($this->table->emptyRow) as $column)
        {
            if ($column->header)
            {
                $empty = false;
            }

            $content .= $column->renderHeader();
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