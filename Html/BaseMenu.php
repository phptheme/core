<?php
/**
 * @copyright Copyright (c) 2018-2019 PhpTheme Dev Team
 * @link http://getphptheme.com
 * @license MIT License
 */
namespace PhpTheme\Html;

use PhpTheme\Helpers\Html;

abstract class BaseMenu extends \PhpTheme\Core\Widget
{

    protected $menuItemClass = MenuItem::class;

    public $items = [];

    public $options = [];

    public $defaultOptions = [];

    public $tag;

    public $defaultItem = [];

    public $renderEmpty = false;

    protected function createItem(array $params = [])
    {
        $params = Html::mergeOptions($this->defaultItem, $params);

        return $this->theme->createWidget($this->menuItemClass, $params);
    }

    protected function itemIsActive($item)
    {
        if (array_key_exists('active', $item))
        {
            return $item['active'];
        }

        if (array_key_exists('items', $item))
        {
            foreach($item['items'] as $k => $v)
            {
                if ($this->itemIsActive($v))
                {
                    return true;
                }
            }
        }

        return false;
    }

    protected function prepareItem(array $item)
    {
        if ($this->itemIsActive($item))
        {
            $item['active'] = true;
        }

        return $item;
    }

    public function run()
    {
        $items = [];

        foreach($this->items as $key => $item)
        {
            $item = $this->prepareItem($item);

            $items[$key] = $this->createItem($item);
        }

        if (!$this->renderEmpty && !$items)
        {
            return '';
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