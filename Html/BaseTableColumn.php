<?php
/**
 * @copyright Copyright (c) 2018-2019 PhpTheme Dev Team
 * @link http://getphptheme.com
 * @license MIT License
 */
namespace PhpTheme\Html;

use PhpTheme\Helpers\Html;
use Closure;

abstract class BaseTableColumn extends \PhpTheme\Core\Widget
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

    public $renderContent;

    protected function getAttributeValue()
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

    protected function renderAttribute($attribute)
    {
        $return = $this->getAttributeValue();

        return $return;
    }

    public function run()
    {
        $renderContent = $this->renderContent;

        if (!$renderContent)
        {
            $renderContent = function()
            {
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
            };
        }

        $renderContent->bindTo($this);

        $content = $renderContent();

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