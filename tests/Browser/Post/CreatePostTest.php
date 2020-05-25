<?php

namespace Tests\Browser\Post;

use App\Advertisement;
use App\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class CreatePostTest extends DuskTestCase
{
    /**
     * @test
     * @throws Throwable
     */
    public function testCreatePost()
    {
        $admin = factory(User::class)->create([
            'is_approved' => true,
            'is_admin' => true
        ]);

        $image = public_path('imgs/logo.png');

        $this->browse(function (Browser $browser) use ($admin, $image) {
            $browser->loginAs($admin)
                ->visit('/posts/create')
                ->type('title', 'This is a title for a post')
                ->type('content', 'This is content for the content and it needs a certain length or this test will fail so I will need to keep typing until it doesnt')
                ->attach('header', $image)
                ->press('create')
                ->assertPathIs('/');
        });

        $this->assertDatabaseHas('posts', [
            'title' => 'This is a title for a post',
            'content' => 'This is content for the content and it needs a certain length or this test will fail so I will need to keep typing until it doesnt',
            'author_id' => $admin->id
        ]);
    }
}
