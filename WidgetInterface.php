<?php

namespace PhpTheme\Core;

interface WidgetInterface
{

    public static function factory(array $params = []);

    public function run();

}