<?php

namespace Tests\Browser\Favorite;

use App\Advertisement;
use App\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class FormRemoveFromFavorites extends DuskTestCase
{
    /**
     * @test
     * @throws Throwable
     */
    public function testRemoveFromFavorites()
    {
        $owner = factory(User::class)->create([
            'is_approved' => true
        ]);

        $user = factory(User::class)->create([
            'is_approved' => true
        ]);

        /** @var Advertisement $advertisement */
        $advertisement = factory(Advertisement::class)->make();
        $advertisement->user()->associate($owner)->save();
        $advertisement->favoritedBy()->save($user);

        $this->assertDatabaseHas('user_favorites', [
            'user_id' => $user->id,
            'advertisement_id' => $advertisement->id
        ]);

        $this->browse(function (Browser $browser) use ($advertisement, $user) {
            $browser->loginAs($user)
                ->visit("/advertisements/$advertisement->id")
                ->press('@favorite_button');
        });

        $this->assertDatabaseMissing('user_favorites', [
            'user_id' => $user->id,
            'advertisement_id' => $advertisement->id
        ]);
    }
}
