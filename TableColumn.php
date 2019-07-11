<?php

namespace PhpTheme\Core;

use PhpTheme\Core\Html;
use Closure;

class TableColumn extends Widget
{

    public $tag = 'td';

    public $options = [];

    public $defaultOptions = [];

    public $attribute;

    public $data = [];

    protected function renderContent()
    {
        $content = $this->content;

        if ($content instanceof Closure)
        {
            return $content();
        }

        if ($content !== null)
        {
            return $content;
        }

        if ($this->attribute && $this->data && array_key_exists($this->attribute, $this->data))
        {
            return $this->data[$this->attribute];
        }

        return '';
    }

    public function run()
    {
        $content = $this->renderContent();

        $options = Html::mergeOptions($this->defaultOptions, $this->options);

        return Html::tag($this->tag, $content, $options);
    }

}