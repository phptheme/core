<?php

namespace PhpTheme\Core;

use PhpTheme\Core\Html;

class Tag extends Widget
{

    public $tag;

    public $options = [];

    public $defaultOptions = [];

    public $renderEmpty = true;

    public function run()
    {
        if (!$this->content && !$this->renderEmpty)
        {
            return '';
        }

        $options = Html::mergeOptions($this->defaultOptions, $this->options);

        return Html::tag($this->tag, $this->content, $options);
    }

}