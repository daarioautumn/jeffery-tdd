<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;


    function unauthenticated_user_may_not_add_replies(){

        $this->expectException('Illuminate\Auth\AuthenticationException');
        
        $thread=factory('App\Thread')->create();

        $reply=factory('App\Reply')->create();

        $this->post('/thread/1/replies',[]);
    }

    public function test_an_authenticated_user_may_participate_in_forum_threads()
    {
        $this->be($user=factory('App\User')->create());

        $thread=factory('App\Thread')->create();

        $reply=factory('App\Reply')->create();

        $this->post($thread->path().'/replies',$reply->toArray());

        $this->get($thread->path())
        ->assertSee($reply->body);
    }
}
