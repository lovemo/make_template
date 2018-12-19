<?php
/**
 * Created by PhpStorm.
 * User: lovemo
 * Date: 2018/9/10
 * Time: 11:36
 */


/**
 * 初始化
 * Class App
 */
class App {

    public static $arguments = [];

    // 初始化
    public static function init() {

    }

    // 配置参数
    public static function configure() {
        $command = key(Dispatcher::$arguments);
        App::$arguments = array_merge(Prompter::$arguments, Dispatcher::$arguments[$command]['options']);
        $moduleName = App::$arguments['moduleName'];
        $className  = App::$arguments['className'];

        switch ($command) {
            case 'controller':
            case 'model':
                $modulePath = YW_APP_PATH . 'application/' . $moduleName . '/' . $command;
                $classPath  = $modulePath . '/' . $className;
                App::$arguments['namespace'] = "app\\$moduleName\\$command";
                if (!file_exists($classPath . YW_PHP_EXT)) {
                    App::buildFile($modulePath, $classPath, $command);
                    $fileInputContent  = file_get_contents(YW_STUBS_PATH . $command . YW_STUB_EXT);
                    $fileOutPutContent = str_replace(App::buildAssignArguments(App::$arguments), App::$arguments, $fileInputContent);
                    file_put_contents($classPath . YW_PHP_EXT, $fileOutPutContent);
                }

                break;
            case 'view':

                break;
            case 'html':
                $modulePath = YW_APP_PATH . 'application/' . $moduleName . '/view/' . $className . '/';
                $fileName  = App::$arguments['actionName'];
                if (!file_exists($modulePath . $fileName . YW_HTML_EXT)) {
                    App::buildFile($modulePath, $modulePath . $fileName, $command);
                    $fileInputContent  = file_get_contents(YW_STUBS_PATH . $command . YW_STUB_EXT);
                    $fileOutPutContent = str_replace(App::buildAssignArguments(App::$arguments), App::$arguments, $fileInputContent);
                    file_put_contents($modulePath . $fileName . YW_HTML_EXT, $fileOutPutContent);
                }

                break;
            case 'css':
            case 'js':
                $modulePath = YW_STATIC_PATH. $moduleName . "/{$command}/";
                $fileName  = App::$arguments['className'];
                if (!file_exists($modulePath . $fileName. '.' . $command)) {
                    App::buildFile($modulePath, $modulePath . $fileName, $command);
                    $fileInputContent  = file_get_contents(YW_STUBS_PATH . $command . YW_STUB_EXT);
                    $fileOutPutContent = str_replace(App::buildAssignArguments(App::$arguments), App::$arguments, $fileInputContent);
                    file_put_contents($modulePath . $fileName . '.' . $command, $fileOutPutContent);
                }
                break;
            default:

        }
    }

    // 执行
    public static function run() {

    }

    private static function buildAssignArguments($arguments = []) {
        $assignArguments = [];
        foreach ($arguments as $key => $value) {
            $assignArguments[] = "{%{$key}%}";
        }
        return $assignArguments;
    }

    private static function buildFile($dir = '', $file = '', $commond = '') {

        $phpCommandExts = [
            'controller', 'model'
        ];

        $fileExt = '';
        if (in_array($commond, $phpCommandExts)) {
            $fileExt = YW_PHP_EXT;
        } else {
            $fileExt = '.' . $commond;
        }

        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        if (!file_exists($file . $fileExt)) {
            file_put_contents($file . $fileExt, '');
        }

    }

}