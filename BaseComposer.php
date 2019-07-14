<?php
/**
 * @copyright Copyright (c) 2018-2019 PhpTheme Dev Team
 * @link http://getphptheme.com
 * @license MIT License
 */
namespace PhpTheme\Core;

use Exception;
use PhpTheme\Helpers\FileHelper;

abstract class BaseComposer extends \Composer\Installer\LibraryInstaller
{

    public static function postInstall($event)
    {
        echo 'post install...' . "\n";

        static::runCommands($event, 'PhpTheme\Core\Composer::postInstall');
    }

    public static function postUpdate($event)
    {
        echo 'post update...' . "\n";

        static::runCommands($event, 'PhpTheme\Core\Composer::postUpdate');
    }

    public static function postCreateProject($event)
    {
        echo 'post create project...' . "\n";
        
        static::runCommands($event, 'PhpTheme\Core\Composer::postCreateProject');
    }

    protected static function copyFiles($files)
    {
        try
        {
            echo 'copy files...' . "\n";

            foreach($files as $source => $target)
            {
                FileHelper::copy($source, $target);
            }
        }
        catch(Exception $e)
        {
            echo $e->getMessage() . "\n";
        }
    }

    protected static function setPermission($files)
    {
        try
        {
            echo 'set permissions...' . "\n";

            foreach($files as $path => $permission)
            {
                FileHelper::setPermission($path, $permission);       
            }
        
        }
        catch(Exception $e)
        {
            echo $e->getMessage() . "\n";
        }
    }

    /**
     * Special method to run tasks defined in `[extra][$extraKey]` key in `composer.json`
     *
     * @link http://www.yiiframework.com/
     * @copyright Copyright (c) 2008 Yii Software LLC
     * @license http://www.yiiframework.com/license/
     * @author Qiang Xue <qiang.xue@gmail.com>
     *
     * @param Event $event
     * @param string $extraKey
     */
    protected static function runCommands($event, $extraKey)
    {
        $params = $event->getComposer()->getPackage()->getExtra();
  
        if (isset($params[$extraKey]) && is_array($params[$extraKey]))
        {
            foreach ($params[$extraKey] as $method => $args)
            {
                call_user_func_array([__CLASS__, $method], (array) $args);
            }
        }
    }

}