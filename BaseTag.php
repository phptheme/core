<?php
/**
 * @author PhpTheme Dev Team <dev@getphptheme.com>
 * @license MIT
 * @link http://getphptheme.com
 */
namespace PhpTheme\Core;

use PhpTheme\Html\HtmlHelper;

abstract class BaseTag
{

    public $tag;

    public $attributes = [];

    public $renderEmpty = true;

    public $content;

    public function __construct(array $params = [])
    {
        foreach($params as $key => $value)
        {
            $this->$key = $value;
        }
    }

    public static function factory(array $params = [])
    {
        $class = static::class;

        $return = new $class($params);

        return $return;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function toString() : string
    {
        $content = $this->getContent();

        if (!$content && !$this->renderEmpty)
        {
            return '';
        }

        return HtmlHelper::tag($this->tag, $content, $this->attributes);        
    }

    public function __toString()
    {
        return $this->toString();
    }

}