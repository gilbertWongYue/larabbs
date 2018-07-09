<?php

namespace APP\Handlers;
use GuzzleHttp\Client;
use Overtrue\Pinyin\Pinyin;

class SlugTranslateHandler
{
    public function translate($text)
    {
        //实例化http客户端
        $http = new Client;

        //初始化配置信息
        $api = 'http://api.fanyi.baidu.com/api/trans/vip/translate?';
        $appid = config('services.baidu_translate.appid');
        $key = config('services.baidu_translate.key');
        $salt = time();

        if (empty($appid) || empty($key)) {
            return $this->pinyin($text);
        }

        $sign = md5($appid . $text . $salt . $key);

        //构建请求参数
        $query = http_build_query([
            'q'  => $text,
            'form' => 'zh',
            'to'  => 'en',
            'appid' => $appid,
            'salt'  => $salt,
            'sign'  => $sign,
        ]);
        //发送http get 请求
        $response = $http->get($api.$query);

        $result  = json_decode($response->getBody(), true);

        if (isset($result['trans_result'][0]['dst'])){
            return str_slug($result['trans_result'][0]['dst']);
        } else {
            return $this->pinyin($text);
        }
    }

    public function pinyin($text)
    {
        return str_slug(app(Pinyin::class)->permalink($text));
    }
}