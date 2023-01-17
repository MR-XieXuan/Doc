<?php

/**
 * QQObj 
 * 命名空间一定得是 MiraiEzT\QQObj\Script ,否则将会报错
 */

namespace MiraiTravel\QQObj\Script;

use MiraiTravel\LogSystem\LogSystem;
use MiraiTravel\MessageChain\MessageChain;
use MiraiTravel\QQObj\QQObj;

/**
 * QQObj 
 * 必须继承于 QQObj 否则将无法运行
 */
class Q2771717841 extends QQObj
{
    const HTTP_API = "http://localhost:60"; //http api
    const VERIFY_KEY = "verifyKey"; //http api verifyKey
    const AUTHORIZATION = ""; //webhook Authorization
    /**
     * init 初始化函数用来配置组件或者其他初始值
     */
    function init()
    {
    }

    /**
     * 该函数是QQBot接到webhook后的处理函数
     * $webhookMessage 中接到的数据具体可以参照 Mirai-api-http 文档
     * 
     */
    function webhook_all($webhookMessage)
    {
        $logSystem = new LogSystem($this->get_qq(), "QQBot");
        $logSystem->write_log("Script", "webhook", json_encode($webhookMessage) . " receive.");
        $this->set_focus($webhookMessage);
        $messageChain = new MessageChain();
        $messageChain->push_plain("Hello MiraiTravel!");
        $this->reply_message($messageChain->get_message_chain());
    }
}
