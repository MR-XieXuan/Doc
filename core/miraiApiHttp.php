<?php

namespace MiraiTravel\MiraiApi;

use function MiraiTravel\HttpAdapter\http_adapter;
use function MiraiTravel\WebhookAdapter\webhook_adapter;

/**
 * adapter_manager 适配器函数
 * @brief 适配器函数
 * @param string $type 适配器类型 
 * @property $type "auto" -> webhook > http ;
 */
function adapter_manager($type, $command, $content, $other = array())
{
    switch ($type) {
        case "auto":
        case "webhook":
            $flag = webhook_adapter($command, $content);
            if ($flag !== false) {
                return $flag;
            }
        case "http":
            $flag = http_adapter($other['httpApi'] ?? $other['qqbot']->get_http_api(), $command, $content, $other);
            if ($flag !== false) {
                return $flag;
            }
        default:
            return false;
    }
}

/**
 * <H1> 
 * 以下的是认证与会话 >>>
 */
function verify($verifyKey, $other = array())
{
    $funcName = basename(str_replace('\\', '/', __FUNCTION__));
    return http_adapter(
        $other['httpApi'] ?? $other['qqbot']->get_http_api(),
        $funcName,
        array("verifyKey" => $verifyKey)
    );
}

function bind($sessionKey, $qq, $other = array())
{
    $funcName = basename(str_replace('\\', '/', __FUNCTION__));
    return http_adapter(
        $other['httpApi'] ?? $other['qqbot']->get_http_api(),
        $funcName,
        array(
            "sessionKey" => $sessionKey,
            "qq" => $qq
        )
    );
}

/**
 * <H1> 
 * 以下的是消息发送与撤回函数 >>>
 */

/**
 * send_friend_message 
 * 发送好友消息
 * @param string    $sessionKey    已经激活的Session
 * @param int       $target        发送消息目标好友的QQ号
 * @param int       $qq            target与qq中需要有一个参数不为空，当target不为空时qq将被忽略，同target
 * @param int       $quote         引用一条消息的messageId进行回复
 * @param array     $messageChain  消息链，是一个消息对象构成的数组
 */
function send_friend_message($sessionKey = "", $target = null, $qq = null, $quote = null, $messageChain, $other = array())
{
    $content = array();
    if (!empty($sessionKey)) {
        $content["sessionKey"] = (string)$sessionKey;
    }
    if (!empty($target)) {
        $content["target"] = (int)$target;
    }
    if (!empty($qq)) {
        $content["qq"] = (int)$qq;
    }
    if (!empty($quote)) {
        $content["quote"] = (int)$quote;
    }
    $content["messageChain"] = (array)$messageChain;
    $funcName = basename(str_replace('\\', '/', __FUNCTION__));
    return adapter_manager("auto", $funcName, $content, $other);
}

/**
 * send_group_message
 * 发送群消息
 * @param string    $sessionKey    已经激活的Session
 * @param int       $target        发送消息目标群的群号
 * @param int       $group         target与group中需要有一个参数不为空，当target不为空时group将被忽略，同target
 * @param int       $quote         引用一条消息的messageId进行回复
 * @param array     $messageChain  消息链，是一个消息对象构成的数组    
 */
function send_group_message($sessionKey = "", $target = null, $group = null, $quote = null, $messageChain, $other = array())
{
    $content = array();
    if (!empty($sessionKey)) {
        $content["sessionKey"] = (string)$sessionKey;
    }
    if (!empty($target)) {
        $content["target"] = (int)$target;
    }
    if (!empty($group)) {
        $content["group"] = (int)$group;
    }
    if (!empty($quote)) {
        $content["quote"] = (int)$quote;
    }
    $content["messageChain"] = (array)$messageChain;
    $funcName = basename(str_replace('\\', '/', __FUNCTION__));

    return adapter_manager("auto", $funcName, $content, $other);
}

/**
 * send_temp_message
 * 发送临时会话消息
 * @param string    $sessionKey    已经激活的Session
 * @param int       $qq            临时会话对象QQ号
 * @param int       $group         临时会话群号
 * @param int       $quote         引用一条消息的messageId进行回复
 * @param array     $messageChain  消息链，是一个消息对象构成的数组  
 * 
 * @return 
 */
function send_temp_message($sessionKey = "", $qq, $group, $quote = null, $messageChain, $other = array())
{
    $content = array();
    if (!empty($sessionKey)) {
        $content["sessionKey"] = (string)$sessionKey;
    }
    $content["qq"] = (int)$qq;
    $content["group"] = (int)$group;
    if (!empty($quote)) {
        $content["quote"] = (int)$quote;
    }
    $content["messageChain"] = (array)$messageChain;
    $funcName = basename(str_replace('\\', '/', __FUNCTION__));

    return adapter_manager("auto", $funcName, $content);
}

/**
 * send_nudge
 * 发送头像戳一戳消息
 */
function send_nudge()
{
}

/**
 * recall
 * 撤回消息
 */
function recall()
{
}

/**
 * <H1> 
 * 以下的是账号管理函数 >>>
 */

/**
 * delete_friend
 * 删除好友
 */
function delete_friend()
{
}

/**
 * <H1> 
 * 以下的是群管理函数 >>>
 */

/**
 * mute
 * 禁言群成员
 */
function mute()
{
}

/**
 * unmute
 * 解除群成员禁言
 */
function unmute()
{
}

/**
 * kick
 * 移除群成员
 */
function kick()
{
}

/**
 * quit
 * 使Bot退出群聊
 */
function quit()
{
}

/**
 * mute_all
 * 全体禁言
 */
function mute_all()
{
}

/**
 * mute_all
 * 解除全体禁言
 */
function unmute_all()
{
}

/**
 * set_essence
 * 设置群精华消息
 */
function set_essence()
{
}


/**
 * <H1> 
 * 以下的是事件处理函数 >>>
 */

/**
 * resp__new_friend_request_event
 * 添加好友申请
 */
function resp__new_friend_request_event()
{
}

/**
 * resp__member_join_request_event
 * 用户入群申请
 */
function resp__member_join_request_event()
{
}

/**
 * resp__bot_invited_join_group_request_event
 * Bot被邀请入群申请
 */
function resp__bot_invited_join_group_request_event()
{
}
