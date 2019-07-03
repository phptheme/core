<?php
/**
 * @copyright Copyright (c) 2018-2019 getphptheme.com
 * @link http://getphptheme.com
 * @license MIT License
 */
namespace PHPTheme\Core;

abstract class BaseHtml
{

    public function renderOptions($options) : string
    {
        $return = '';

        if (array_key_exists('class', $options))
        {
            if (is_array($options['class']))
            {
                $options['class'] = implode(' ', $options['class']);
            }
        }

        foreach($options as $key => $value)
        {
            $return .= ' ' . $key . '="' . $value . '"';
        }

        return $return;
    }

    public function tag(string $tag, string $content, array $options = [])
    {
        $return = '';

        if ($tag)
        {
            $return .= '<' . $this->tag . $this->renderOptions($options) . '>';
        }

        $return .= $content;

        if ($tag)
        {
            $return .= '</' . $tag . '>';
        }

        return $return;
    }

    public function shortTag(string $tag, array $options = [])
    {
        return '<' . $tag . $this->renderOptions($options) . ' />';
    }

}