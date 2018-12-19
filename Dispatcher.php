<?php
/**
 * Created by PhpStorm.
 * User: lovemo
 * Date: 2018/9/10
 * Time: 11:36
 */

/**
 * 分发参数
 * Class Dispatcher
 */
class Dispatcher {

    public static $arguments = [];

    // 分发参数
    public static function dispatch() {
        $arguments = explode(':', Validator::$arguments[1]);
        $options = [];
        switch ($arguments[1]) {
            case 'controller':
            case 'model':
                if (strpos(Validator::$arguments[2],'/')) {
                    list($module, $controller) = explode('/',Validator::$arguments[2]);
                    $options['moduleName'] = $module;
                    $options['className']  = $controller;
                    $options['fileName']   = $controller;
                } else {
                    $options['moduleName'] = strtolower(Validator::$arguments[2]);
                    $options['className']  = Validator::$arguments[2];
                    $options['fileName']   = Validator::$arguments[2];
                }
                break;
            case 'view':

                break;
            case 'html':
                if (strpos(Validator::$arguments[2],'/')) {
                    list($module, $controller, $action) = explode('/',Validator::$arguments[2]);
                    $options['moduleName'] = $module;
                    $options['className']  = $controller;
                    $options['actionName'] = $action;
                } else {
                    $options['moduleName'] = strtolower(Validator::$arguments[2]);
                    $options['className']  = Validator::$arguments[2];
                    $options['actionName'] = Validator::$arguments[2];
                }
                break;
            case 'css':
            case 'js':
                if (strpos(Validator::$arguments[2],'/')) {
                    list($module, $controller,) = explode('/',Validator::$arguments[2]);
                    $options['moduleName'] = $module;
                    $options['className']  = $controller;
                } else {
                    $options['moduleName'] = strtolower(Validator::$arguments[2]);
                    $options['className']  = Validator::$arguments[2];
                }
                break;
            default:

        }

        Dispatcher::$arguments[$arguments[1]]['options'] = $options;

    }

}