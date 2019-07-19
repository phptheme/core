<?php
/**
 * @copyright Copyright (c) 2018-2019 PhpTheme Dev Team
 * @link http://getphptheme.com
 * @license MIT License
 */
namespace PhpTheme\Html;

use PhpTheme\Helpers\Html;

abstract class BaseMenuItem extends \PHPTheme\Core\Widget
{

    protected $submenuClass = Menu::class;

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

    public $defaultSubmenu = [];

    public $submenu = [];

    public $items = [];

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

        $content .= $this->renderSubmenu();

        return Html::tag($this->tag, $content, $options);
    }

    protected function renderSubmenu()
    {
        if (!$this->items)
        {
            return '';
        }

        $options = Html::mergeOptions(
            $this->defaultSubmenu, 
            $this->submenu,
            [
                'items' => $this->items
            ]
        );
        
        return $this->theme->widget($this->submenuClass, $options);
    }

}