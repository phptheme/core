<?php
/**
 * @copyright Copyright (c) 2018-2019 getphptheme.com
 * @link http://getphptheme.com
 * @license MIT License
 */
namespace PHPTheme\Core;

abstract class BaseHtml
{

    public static function escape($string, $encoding = 'utf-8', $specialCharsFlags = null)
    {
        if (!$specialCharsFlags)
        {
            $specialCharsFlags = ENT_QUOTES | ENT_SUBSTITUTE;
        }

        return htmlspecialchars($string, $specialCharsFlags, $encoding);
    }

    public static function mergeClass($class1, $class2)
    {
        if (is_array($class2))
        {
            if (!is_array($class1))
            {
                $class1 = explode(' ', $class1);
            }

            foreach($class2 as $class)
            {
                if (array_search($class, $class1) === false)
                {
                    $class1[] = $class;
                }
            }

            return $class1;
        }

        return $class2;
    }

    public static function mergeOptions(array $array1, array $array2)
    {
        $args = func_get_args();

        $return = array_shift($args);

        if (count($args) > 1)
        {
            foreach($args as $array)
            {
                $return = static::mergeOptions($return, $array);
            }

            return $return;
        }

        foreach($array2 as $key => $value)
        {
            if (($key == 'class') && array_key_exists($key, $return))
            {
                $return[$key] = static::mergeClass($return[$key], $value);
            }
            else
            {
                $return[$key] = $value;
            }
        }

        return $return;
    }

    public static function renderOptions($options) : string
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

    public static function openTag(string $tag, array $options = [])
    {
        if ($tag)
        {
            return '<' . $tag . static::renderOptions($options) . '>';
        }

        return '';
    }

    public static function closeTag(string $tag)
    {
        if ($tag)
        {
            return '</' . $tag . '>';
        }

        return '';
    }

    public static function tag(string $tag, string $content, array $options = [])
    {
        $return = static::openTag($tag, $options);

        $return .= $content;

        $return .= static::closeTag($tag);

        return $return;
    }

    public static function shortTag(string $tag, array $options = [])
    {
        return '<' . $tag . static::renderOptions($options) . ' />';
    }

}