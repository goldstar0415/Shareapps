<?php

return [
    /*
     * The scheme information
     * -------------------------------------------------------------------
     *
     * The key-value paris: {name} => {value}
     *
     * Examples:
     * 'Log' => '10 backup'
     * 'SmsBao' => '100'
     * 'CustomAgent' => [
     *     '5 backup',
     *     'agentClass' => '/Namespace/ClassName'
     * ]
     *
     * Supported agents:
     * 'Log', 'YunPian', 'YunTongXun', 'SubMail', 'Luosimao',
     * 'Ucpaas', 'JuHe', 'Alidayu', 'SendCloud', 'SmsBao',
     * 'Qcloud', 'Aliyun'
     *
     */
    'scheme' => [
        'Log',
    ],

    /*
     * The configuration
     * -------------------------------------------------------------------
     *
     * Expected the name of agent to be a string.
     *
     */
    'agents' => [
        /*
         * -----------------------------------
         * YunPian
         * -----------------------------------
         * website:http://www.yunpian.com
         * support content sms.
         */
        'YunPian' => [
            'apikey' => 'your_api_key',
        ],

        /*
         * -----------------------------------
         * YunTongXun
         * -----------------------------------
         * website：http://www.yuntongxun.com/
         * support template sms.
         */
        'YunTongXun' => [
            'accountSid'    => 'your_account_sid',
            'accountToken'  => 'your_account_token',
            'appId'         => 'your_app_id',
            'serverIP'      => 'app.cloopen.com',
            'serverPort'    => '8883',
            'displayNum'    => null,
            'playTimes'     => 3,
        ],

        /*
         * -----------------------------------
         * SubMail
         * -----------------------------------
         * website:http://submail.cn/
         * support template sms.
         */
        'SubMail' => [
            'appid'     => 'your_app_id',
            'signature' => 'your app key',
        ],

        /*
         * -----------------------------------
         * luosimao
         * -----------------------------------
         * website:http://luosimao.com
         * support content sms.
         */
        'Luosimao' => [
            'apikey'        => 'your_api_key',
            'voiceApikey'   => 'your_voice_api_key',
        ],

        /*
         * -----------------------------------
         * ucpaas
         * -----------------------------------
         * website:http://ucpaas.com
         * support template sms.
         */
        'Ucpaas' => [
            'accountSid'    => 'your_account_sid',
            'accountToken'  => 'your_account_token',
            'appId'         => 'your_app_id',
        ],

        /*
         * -----------------------------------
         * JuHe
         * -----------------------------------
         * website:https://www.juhe.cn
         * support template sms.
         */
        'JuHe' => [
            'key'   => 'your_key',
            'times' => 3,
        ],

        /*
         * -----------------------------------
         * Alidayu
         * -----------------------------------
         * website:http://www.alidayu.com
         * support template sms.
         */
        'Alidayu' => [
            'sendUrl'           => 'http://gw.api.taobao.com/router/rest',
            'appKey'            => 'your_app_key',
            'secretKey'         => 'your_secret_key',
            'smsFreeSignName'   => 'your_sms_free_sign_name',
            'calledShowNum'     => null,
        ],

        /*
         * -----------------------------------
         * SendCloud
         * -----------------------------------
         * website: http://sendcloud.sohu.com/sms/
         * support template sms.
         */
        'SendCloud' => [
            'smsUser'   => 'your_SMS_USER',
            'smsKey'    => 'your_SMS_KEY',
        ],

        /*
         * -----------------------------------
         * SmsBao
         * -----------------------------------
         * website: http://www.smsbao.com
         * support content sms.
         */
        'SmsBao' => [
            'username'  => 'your_username',
            'password'  => 'your_password',
        ],

        /*
         * -----------------------------------
         * Qcloud
         * 腾讯云
         * -----------------------------------
         * website:http://www.qcloud.com
         * support template sms.
         */
        'Qcloud' => [
            'appId'     => 'your_app_id',
            'appKey'    => 'your_app_key',
        ],

        /*
         * -----------------------------------
         * Aliyun
         * -----------------------------------
         * website:https://www.aliyun.com/product/sms
         * support template sms.
         */
        'Aliyun' => [
            'accessKeyId'       => 'your_access_key_id',
            'accessKeySecret'   => 'your_access_key_secret',
            'signName'          => 'your_sms_sign_name',
            'regionId'          => 'cn-shenzhen',
        ],
    ],
];
