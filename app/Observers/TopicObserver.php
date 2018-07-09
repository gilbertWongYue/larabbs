<?php

namespace App\Observers;

use App\Models\Topic;
use App\Handlers\SlugTranslateHandler;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{
    public function creating(Topic $topic)
    {
        //
    }

    public function updating(Topic $topic)
    {
        //
    }
    //在保存数据之前处理数据
    public function saving(Topic $topic)
    {

        //XSS过滤
        $topic->body = clean($topic->body, 'user_topic_body');
        //生成话题摘录
        $topic->excerpt = make_excerpt($topic->body);

        //如果slug有内容，进行翻译
        if (! $topic->slug) {
            $topic->slug = app(SlugTranslateHandler::class)->translate($topic->title);
        }
    }
}