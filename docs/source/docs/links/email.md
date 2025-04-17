---
title: links email
description: 
extends: _layouts.documentation
section: content
---

# links email

Mail::raw('This is  a queued job email', function($message){
    $message->to('queueexample@gmail.com')->subject('queued job ');
});

https://medium.com/@hammada.reda.dev/queues-in-laravel-c2d0d4535e55



