<?php


return [
    /*
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    |
    |
    */
    'route' => [
        'enable'     => true,
        'prefix'     => 'laravel-sms',
        'middleware' => ['web'],
    ],

    /*
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    |
    |
    */
    'interval' => 60,

    /*
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    |
    |
    |
    */
    'validation' => [
        'mobile' => [
            'isMobile'    => true,
            'enable'      => true,
            'default'     => 'mobile_required',
            'staticRules' => [
                'mobile_required'     => 'required|zh_mobile',
                'check_mobile_unique' => 'required|zh_mobile|unique:users,mobile',
                'check_mobile_exists' => 'required|zh_mobile|exists:users',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    |
    |
    */
    'code' => [
        'length'        => 5,
        'validMinutes'  => 5,
        'repeatIfValid' => false,
        'maxAttempts'   => 0,
    ],

    /*
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    |
    */
    'Content '  =>  function ( $code , $minutes , $input ) {
    return ' [signature] Your verification code is ' . $Code . ' , Valid for ' . $Minutes . ' Minutes, please verify as soon as possible' ;},

    /*
    |--------------------------------------------------------------------------
    | 验证码短信模版
    |--------------------------------------------------------------------------
    |
    | 每项数据的值可以为以下三种之一:
    |
    | - 字符串/数字
    |   如: 'YunTongXun' => '短信模版id'
    |
    | - 数组
    |   如: 'Alidayu' => ['短信模版id', '语音模版id'],
    |
    | - 匿名函数
    |   如: 'YunTongXun' => function ($input, $type) {
    |           return $input['isRegister'] ? 'registerTempId' : 'commonId';
    |       }
    |
    | 如需缓存配置，则需使用 `Toplan\Sms\SmsManger::closure($closure)` 方法对匿名函数进行配置
    |
    */
    'templates' => [
    ],

    /*
    |--------------------------------------------------------------------------
    | 模版数据管理
    |--------------------------------------------------------------------------
    |
    | 每项数据的值可以为以下两种之一:
    |
    | - 基本数据类型
    |   如: 'minutes' => 5
    |
    | - 匿名函数（如果该函数不返回任何值，即表示不使用该项数据）
    |   如: 'serialNumber' => function ($code, $minutes, $input, $type) {
    |           return $input['serialNumber'];
    |       }
    |   如: 'hello' => function ($code, $minutes, $input, $type) {
    |           //不返回任何值，那么hello将会从模版数据中移除 :)
    |       }
    |
    | 如需缓存配置，则需使用 `Toplan\Sms\SmsManger::closure($closure)` 方法对匿名函数进行配置
    |
    */
    'data' => [
        'code' => function ($code) {
            return $code;
        },
        'minutes' => function ($code, $minutes) {
            return $minutes;
        },
    ],

    /*
    |--------------------------------------------------------------------------
    | 存储系统配置
    |--------------------------------------------------------------------------
    |
    | driver:
    | 存储方式,是一个实现了'Toplan\Sms\Storage'接口的类的类名,
    | 内置可选的值有'Toplan\Sms\SessionStorage'和'Toplan\Sms\CacheStorage',
    | 如果不填写driver,那么系统会自动根据内置路由的属性(route)中middleware的配置值选择存储器driver:
    | - 如果中间件含有'web',会选择使用'Toplan\Sms\SessionStorage'
    | - 如果中间件含有'api',会选择使用'Toplan\Sms\CacheStorage'
    |
    | prefix:
    | 存储key的prefix
    |
    | 内置driver的个性化配置:
    | - 在laravel项目的'config/session.php'文件中可以对'Toplan\Sms\SessionStorage'进行更多个性化设置
    | - 在laravel项目的'config/cache.php'文件中可以对'Toplan\Sms\CacheStorage'进行更多个性化设置
    |
    */
    'storage' => [
        'driver' => '',
        'prefix' => 'laravel_sms',
    ],

    /*
    |--------------------------------------------------------------------------
    | 是否数据库记录发送日志
    |--------------------------------------------------------------------------
    |
    | 若需开启此功能,需要先生成一个内置的'laravel_sms'表
    | 运行'php artisan migrate'命令可以自动生成
    |
    */
    'dbLogs' => false,

    /*
    |--------------------------------------------------------------------------
    | 队列任务
    |--------------------------------------------------------------------------
    |
    */
    'queueJob' => 'Toplan\Sms\SendReminderSms',

    /*
    |--------------------------------------------------------------------------
    | 验证码模块提示信息
    |--------------------------------------------------------------------------
    |
    */
    'notifies' => [
        // 频繁请求无效的提示
        'request_invalid' => '请求无效，请在%s秒后重试',

        // 验证码短信发送失败的提示
        'sms_sent_failure' => '短信验证码发送失败，请稍后重试',

        // 语音验证码发送发送成功的提示
        'voice_sent_failure' => '语音验证码请求失败，请稍后重试',

        // 验证码短信发送成功的提示
        'sms_sent_success' => '短信验证码发送成功，请注意查收',

        // 语音验证码发送发送成功的提示
        'voice_sent_success' => '语音验证码发送成功，请注意接听',
    ],
];
