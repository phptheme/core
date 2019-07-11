<?php

namespace PhpTheme\Core;

use PhpTheme\Core\Html;

class Table extends Widget
{

    const HEADER = TableHeader::class;

    const FOOTER = TableFooter::class;

    const BODY = TableBody::class;

    public $columns = [];

    public $options = [];

    public $defaultOptions = [];

    public $header = [];

    public $defaultHeader = [];

    public $footer = [];

    public $defaultFooter = [];

    public $body = [];

    public $defaultBody = [];

    protected function renderHeader()
    {
        $options = Html::mergeOptions(
            $this->defaultHeader, 
            $this->header
        );

        if (empty($options['columns']))
        {
            foreach($this->columns as $i => $column)
            {
                if (array_key_exists('header', $column))
                {
                    $options['columns'][$i] = $column['header'];
                }
                else
                {
                    $options['columns'][$i] = [];
                }
            }
        }

        return $this->theme->widget(static::HEADER, $options);
    }

    protected function renderFooter()
    {
        $options = Html::mergeOptions(
            $this->defaultFooter, 
            $this->footer
        );

        if (empty($options['columns']))
        {
            foreach($this->columns as $i => $column)
            {
                if (array_key_exists('footer', $column))
                {
                    $options['columns'][$i] = $column['footer'];
                }
                else
                {
                    $options['columns'][$i] = [];
                }
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

    public function run()
    {
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