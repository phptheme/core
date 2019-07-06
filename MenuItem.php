<?php
/**
 * @copyright Copyright (c) 2018-2019 getphptheme.com
 * @link http://getphptheme.com
 * @license MIT License
 */
namespace PHPTheme\Core;

use PHPTheme\Core\Html;

class MenuItem extends \PHPTheme\Core\Widget
{

    public $menu;

    public $options = [];

    public $activeOptions = [];

    public $linkOptions = [];

    public $activeLinkOptions = [];

    public $url;

    public $label;

    public $tag;

    public $activeTag;

    public $active;

    public function run()
    {
        $options = $this->options;

        if ($this->active)
        {
            $options = Html::mergeOptions($options, $this->activeOptions);
        }

        $linkOptions = $this->linkOptions;

        if ($this->active)
        {
            $linkOptions = Html::mergeOptions($linkOptions, $this->activeLinkOptions);
        }

        if ($this->active)
        {
            $content = Html::tag($this->linkTag, $this->label, $linkOptions);
        }
        else
        {
            $content = Html::tag($this->activeLinkTag, $this->label, $linkOptions);
        }

        return Html::tag($this->tag, $this->content, $options);
    }

}