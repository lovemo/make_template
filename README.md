# make_template
命令自动化根据make/stubs中的模板文件生成php_controller/php_model/html/css/js规范化文件代码

### core code
```php
#!/usr/bin/env php
<?php
/**
 * 命令自动化根据make/stubs中的模板文件生成php_controller/php_model/html/css/js规范化文件代码
 */
header('content-type:text/html;charset=utf-8');

require 'yw_base.php';

require __DIR__ . '/' . 'Validator.php';
require __DIR__ . '/' . 'Dispatcher.php';
require __DIR__ . '/' . 'Prompter.php';
require __DIR__ . '/' . 'App.php';


// 验证参数
Validator::valid($argv);

// 提示选项
Prompter::prompt();

// 分发参数
Dispatcher::dispatch();

// 初始化
App::init();

// 配置参数
App::configure();

// 执行
App::run();
```
