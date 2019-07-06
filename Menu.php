<?php
/**
 * @copyright Copyright (c) 2018-2019 getphptheme.com
 * @link http://getphptheme.com
 * @license MIT License
 */
namespace PHPTheme\Core;

use PHPTheme\Core\Html;

class Menu extends \PHPTheme\Core\Widget
{

    const MENU_ITEM = MenuItem::class;

    public $items = [];

    public $options = [];

    public $defaultOptions = [];

    public $tag;

    public $itemTag;

    public $activeItemTag;

    public $itemOptions = [];

    public $defaultItemOptions = [];

    public $itemLinkOptions = [];

    public $defaultItemLinkOptions = [];

    protected function createItem(array $params = [])
    {
        $params['menu'] = $this;

        if (!array_key_exists('tag', $params))
        {
            $params['tag'] = $this->itemTag;
        }

        if (!array_key_exists('activeTag', $params))
        {
            $params['activeTag'] = $this->activeItemTag;
        }

        $options = Html::mergeOptions($this->defaultItemOptions, $this->itemOptions);

        if (array_key_exists('options', $params))
        {
            $params['options'] = Html::mergeOptions($options, $params['options']);
        }
        else
        {
            $params['options'] = $options;
        }

        $linkOptions = Html::mergeOptions($this->defaultItemLinkOptions, $this->itemLinkOptions);

        if (array_key_exists('linkOptions', $params))
        {
            $params['linkOptions'] = Html::mergeOptions($linkOptions, $params['linkOptions']);
        }
        else
        {
            $params['linkOptions'] = $linkOptions;
        }

        $theme = $this->theme;        

        $item = $theme->createWidget(static::MENU_ITEM, $params);

        return $item;
    }

    public function run()
    {
        $items = [];

        foreach($this->items as $key => $item)
        {
            $items[$key] = $this->createItem($item);
        }

        $content = '';

        foreach($items as $item)
        {
            $content .= $item->run();
        }

        $options = Html::mergeOptions($this->defaultOptions, $this->options);

        return Html::tag($this->tag, $content, $options);
    }

}