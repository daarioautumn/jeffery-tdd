<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class FavoriteTest extends TestCase
{

	use DatabaseMigrations;

	/** @test */
	function guests_can_not_favorite_anything()
	 {
	 	$this->withExceptionHandling()
	 	->post('replies/1/favorites')
	  	->assertRedirect('/login');

	 }

	 /** @test */
	function an_authenticated_user_can_favorite_any_reply()
	 {
	 	$this->signIn();

	  	$reply=create('App\Reply');

	  	$this->post('replies/'.$reply->id.'/favorites');

	  	$this->assertCount(1,$reply->favorites);
	 }

	 /** @test */
	 function an_authenticated_user_may_only_favorite_a_reply_once()
	 {
	 	$this->signIn();

	  	$reply=create('App\Reply');

	  	try {

	  		$this->post('replies/'.$reply->id.'/favorites');

	  		$this->post('replies/'.$reply->id.'/favorites');

	  	} catch (\Exception $e) {

	  		$this->fail('Did not expect to insert same record twice');

	  	}

	  	$this->assertCount(1,$reply->favorites);
	 }

}
