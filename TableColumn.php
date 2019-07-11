<?php

namespace PhpTheme\Core;

use PhpTheme\Core\Html;
use Closure;

class TableColumn extends Widget
{

    public $tag = 'td';

    public $options = [];

    public $defaultOptions = [];

    /*

    // header

    public $headerTag = 'th';

    public $header = null;

    public $headerOptions = [];

    public $defaultHeaderOptions = [];

    // footer

    public $footerTag = 'td';

    public $footer = null;

    public $footerOptions = [];

    public $defaultOptionsFooter = [];

    */

    public $header = null;

    public $defaultHeaderOptions = [];

    public $headerOptions = [];

    public $footer = null;

    public $defaultFooterOptions = [];

    public $footerOptions = [];

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

        return $this->renderDefaultContent();
    }

    protected function renderDefaultContent()
    {
        return '';
    }

    public function run()
    {
        $content = $this->renderContent();

        $options = Html::mergeOptions($this->defaultOptions, $this->options);

        return Html::tag($this->tag, $content, $options);  
    }

    public function getHeaderOptions()
    {
        return Html::mergeOptions($this->defaultHeaderOptions, $this->headerOptions);
    }

    public function getFooterOptions()
    {
        return Html::mergeOptions($this->defaultFooterOptions, $this->footerOptions);
    }

}