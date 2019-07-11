<?php

namespace PhpTheme\Core;

use PhpTheme\Core\Html;

class TableBody extends Widget
{

    const ROW = Tag::class;

    public $rows = [];

    public $tag = 'tbody';

    public $options = [];

    public $defaultOptions = [];

    public $columns = [];

    public $defaultRow = ['tag' => 'tr'];

    protected function renderRow($content)
    {
        $options = Html::mergeOptions($this->defaultRow, [
            'content' => $content
        ]);

        return $this->theme->widget(static::ROW, $options);
    }

    public function run()
    {
        $content = '';

        foreach($this->rows as $row)
        {
            $rowContent = '';

            foreach($this->columns as $column)
            {
                $column->row = $row;

                $rowContent .= $column->run();
            }

            $content .= $this->renderRow($rowContent);
        }

        $options = Html::mergeOptions($this->defaultOptions, $this->options);

        return Html::tag($this->tag, $content, $options);
    }

}