<?php
/**
 * Created by PhpStorm.
 * User: lovemo
 * Date: 2018/9/10
 * Time: 11:36
 */

/**
 * 提示选项
 * Class Prompter
 */
class Prompter {


    public static $arguments = [];

    public static $defaultArguments  = [
        'Date'  => '',
        'Time'  => ''
    ];

    public static $promptArguments  = [
        'controller' => [
            'Author' => '',
        ],
        'model' => [
            'Author' => '',
        ],
        'css' => [
            'Author' => '',
        ],
        'js' => [
            'Author' => '',
        ],
        'html' => [
            'Title' => '',
        ],
    ];

    // 提示选项
    public static function prompt() {

        $commandArguments = explode(':', Validator::$arguments[1])[1];
        $currentInputKey = '';
        do {
            foreach (Prompter::$promptArguments[$commandArguments] as $key => $value) {
                fwrite(STDOUT, ' 请输入 ' . $key . ' : ');
                $currentInputKey = $key;
            }
            Prompter::$promptArguments[$commandArguments][$currentInputKey] = trim(fgets(STDIN));

        } while (Prompter::checkEmptyValueArray(Prompter::$promptArguments[$commandArguments]));


        Prompter::$defaultArguments['Date'] = ': ' . date('Y/m/d');
        Prompter::$defaultArguments['Time'] = ': ' . date('H:i');

        Prompter::$arguments = array_merge(Prompter::$defaultArguments, Prompter::$promptArguments[$commandArguments]);
    }

    private static function checkEmptyValueArray($array) {
        $isEmpty = false;

        foreach ($array as $value) {
            if (empty($value)) {
                $isEmpty = true;
                break;
            }
        }
        return $isEmpty;
    }
}