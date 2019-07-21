<?php
/**
 * @copyright Copyright (c) 2018-2019 PhpTheme Dev Team
 * @link http://getphptheme.com
 * @license MIT License
 */
namespace PhpTheme\Html;

use PhpTheme\Helpers\Html;
use Closure;

abstract class BaseTableColumn extends TableColumnAbstract
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

    public $attribute;

    public function getAttributeValue()
    {
        if (is_object($this->row))
        {
            return $this->row->{$this->attribute};
        }
        else
        {
            return $this->row[$this->attribute];
        }        
    }

    public function renderAttribute()
    {
        $return = parent::renderAttribute();

        if ($return !== null)
        {
            return $return;
        }

        $return = $this->getAttributeValue();

        return $return;
    }

    public function renderContent()
    {
        $return = parent::renderContent();

        if ($return !== null)
        {
            return $return;
        }

        $content = $this->content;

        if ($content instanceof Closure)
        {
            return $content($this->row);
        }

        if ($content !== null)
        {
            return $content;
        }

        if ($this->attribute)
        {
            return $this->renderAttribute($this->attribute);
        }

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
        $return = parent::renderHeader();

        if ($return !== null)
        {
            return $return;
        }

        $options = Html::mergeOptions($this->defaultHeaderOptions, $this->headerOptions);
    
        return Html::tag($this->headerTag, $this->getHeader(), $options);
    }

    public function renderFooter()
    {
        $return = parent::renderFooter();

        if ($return !== null)
        {
            return $return;
        }

        $options = Html::mergeOptions($this->defaultFooterOptions, $this->footerOptions);
    
        return Html::tag($this->footerTag, $this->getFooter(), $options);
    }

    public function getHeader()
    {
        $return = parent::getHeader();

        if ($return !== null)
        {
            return $return;
        }

        return $this->header;
    }

    public function getFooter()
    {
        $return = parent::getFooter();

        if ($return !== null)
        {
            return $return;
        }

        return $this->footer;
    }

}