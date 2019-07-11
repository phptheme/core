<?php

namespace PhpTheme\Core;

use PhpTheme\Core\Html;
use Closure;

class TableColumn extends Widget
{

    public $row = [];

    public $tag = 'td';

    public $options = [];

    public $defaultOptions = [];

    public $header = null;

    public $defaultHeaderOptions = [];

    public $headerTag = 'th';

    public $headerOptions = [];

    public $footer = null;

    public $footerTag = 'td';

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

    public function renderHeader()
    {
        $options = Html::mergeOptions($this->defaultHeaderOptions, $this->headerOptions);
    
        return Html::tag($this->headerTag, $this->header, $options);
    }

    public function renderFooter()
    {
        $options = Html::mergeOptions($this->defaultFooterOptions, $this->footerOptions);
    
        return Html::tag($this->footerTag, $this->footer, $options);
    }

}