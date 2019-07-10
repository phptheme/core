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

    public $defaultOptions = [];

    public $activeOptions = [];

    public $linkOptions = [];

    public $defaultLinkOptions = [];

    public $activeLinkOptions = [];

    public $linkTag = 'a';

    public $activeLinkTag = 'a';

    public $url;

    public $label;

    public $tag;

    public $activeTag;

    public $active;

    public $icon;

    public $iconTemplate = '<i class="{icon}"></i>{label}';

    protected function renderLabel()
    {
        $return = $this->label;

        if ($this->icon)
        {
            $return = strtr($this->iconTemplate, [
                '{label}' => $this->label,
                '{icon}' => $this->icon
            ]);
        }

        return $return;
    }

    protected function renderLink()
    {
        $linkOptions = Html::mergeOptions($this->defaultLinkOptions, $this->linkOptions);

        if ($this->active)
        {
            $linkOptions = Html::mergeOptions($linkOptions, $this->activeLinkOptions);
        }

        $label = $this->renderLabel();

        if ($this->active)
        {
            $tag = $this->activeLinkTag;
        }
        else
        {
            $tag = $this->linkTag;
        }

        if ($this->url && ($tag == 'a'))
        {
            $linkOptions['href'] = $this->url;
        }

        return Html::tag($tag, $label, $linkOptions);
    }

    public function run()
    {
        $options = Html::mergeOptions($this->defaultOptions, $this->options);

        if ($this->active)
        {
            $options = Html::mergeOptions($options, $this->activeOptions);
        }

        $content = $this->renderLink();

        return Html::tag($this->tag, $content, $options);
    }

}