<?php
namespace moorper;

class Cache
{
    public function init(){
        $pool = new Stash\Pool();
        $pool->set('index','index');
        $pool-get('index');
    }
}
