<?php
/**
 * Created by PhpStorm.
 * User: lovemo
 * Date: 2018/9/10
 * Time: 11:36
 */

include_once 'yw_base.php';
/**
 * 验证参数
 * Class Validator
 */
class Validator {

    public static $supportCommands = [
        'make'
    ];

    public static $supportCommandArguments = [
        'controller',
        'model',
        'view',
        'html',
        'css',
        'js'
    ];

    public static $arguments  = [];

    // 验证参数
    public static function valid($argv = []) {

        if (count($argv) <= 1) {
            exit('命令不能为空' . YW_NEWLINE);
        }

        if (count($argv) <= 2) {
            exit('模块参数不能为空' . YW_NEWLINE);
        }

        list($supportCommand, $supportCommandArgument) = explode(':', $argv[1]);

        if (!in_array($supportCommand, Validator::$supportCommands)) {
            exit('不支持的命令' . YW_NEWLINE);
        }

        if (!in_array($supportCommandArgument, Validator::$supportCommandArguments)) {
            exit('不支持的命令参数' . YW_NEWLINE);
        }

        Validator::$arguments = $argv;
    }
}