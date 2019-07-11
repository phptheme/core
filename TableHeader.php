<?php

namespace PhpTheme\Core;

use PhpTheme\Core\Html;

class TableHeader extends \PhpTheme\Core\Widget
{

    const ROW = Tag::class;

    public $tag = 'thead';

    public $columns = [];

    public $defaultRow = ['tag' => 'tr'];

    public $options = [];

    public $defaultOptions = [];    

    protected function renderRow($content)
    {
        $options = Html::mergeOptions($this->defaultRow, ['content' => $content]);

        return $this->theme->widget(static::ROW, $options);
    }

    public function run()
    {
        $content = '';

        $empty = true;

        foreach($this->columns as $column)
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

        $content = $this->renderRow($content);

        $options = Html::mergeOptions($this->defaultOptions, $this->options);

        return Html::tag($this->tag, $content, $options);
    }    

}