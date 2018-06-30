<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CodeSampleTest extends DuskTestCase
{
    public function testWelcomePage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Code Sample');
        });
    }

    public function testHomeRequiresAuthentication()
    {
        $this->browse(function(Browser $browser){
            //** Intentionally NOT logging in */

            $browser->visit(route('home'))
                ->assertRouteIs('login');
        });
    }

    public function testBlogsRequireAuthentication()
    {
        $this->browse(function(Browser $browser){
            //** Intentionally NOT logging in */

            $browser->visit(route('blogs.index'))
                ->assertRouteIs('login');
        });
    }

    public function testShouldSeeBlogNavLinks()
    {
        $this->browse(function(Browser $browser){
            $user = \App\User::first();

            $browser->loginAs($user)
                ->visit(route('blogs.index'))
                ->assertPresent('@blogs-link')
                ->assertPresent('@blogs-create-link');
        });
    }

    public function testShouldShowBlogList()
    {
        $this->browse(function(Browser $browser){
            $user = \App\User::first();

            $browser->loginAs($user)
                    ->visit(route('blogs.index'))
                    ->assertPresent('@blogs');
        });
    }

    public function testShouldShowCreateBlogForm()
    {
        $this->browse(function(Browser $browser){
            $user = \App\User::first();

            $browser->loginAs($user)
                ->visit(route('blogs.create'))
                ->assertVisible('@create-button');
        });
    }

    public function testShouldFailValidationOnCreatingInvalidBlog()
    {
        $this->browse(function(Browser $browser){
            $user = \App\User::first();

            $browser->loginAs($user)
                ->visit(route('blogs.create'))
                ->assertVisible('@create-button')

                // Required fields left empty intentionally

                ->click('@create-button')
                ->assertRouteIs('blogs.create');
        });
    }

    public function testShouldCreateBlog()
    {
        $this->browse(function(Browser $browser){

            $title = 'Test Title: ' . \Carbon\Carbon::now();

            $user = \App\User::first();

            $browser->loginAs($user)
                ->visit(route('blogs.index'))
                ->assertDontSeeIn('@blogs', $title);

            $browser->visit(route('blogs.create'))
                ->assertVisible('@create-button')
                ->type('title', $title)
                ->type('description', 'Test Description')
                ->click('@create-button')
                ->assertRouteIs('blogs.index')
                ->assertSeeIn('@blogs', $title);
        });
    }

    public function testShouldShowBlogDetails()
    {
        $this->browse(function(Browser $browser){

            $firstBlogLinkSelector = '.blog:first-child .blog-link';

            $user = \App\User::first();

            $browser->loginAs($user)
                ->visit(route('blogs.index'));

            $firstBlogTitle = $browser->text($firstBlogLinkSelector);

            $browser->click($firstBlogLinkSelector)
                ->assertPathBeginsWith('/blogs/')  //tailing slash is important
                ->assertSeeIn('@blog-title', $firstBlogTitle);

        });
    }

    public function testShouldShowUpdateBlogForm()
    {
        $this->browse(function(Browser $browser){

            $firstBlogLinkSelector = '.blog:first-child .blog-link';

            $user = \App\User::first();

            $browser->loginAs($user)
                ->visit(route('blogs.index'));

            $firstBlogTitle = $browser->text($firstBlogLinkSelector);

            $browser->click($firstBlogLinkSelector)
                ->assertVisible('@blog-edit-link');

            $browser->click('@blog-edit-link')
                ->assertVisible('@update-button');
        });
    }

    public function testShouldFailValidationOnUpdatingInvalidBlog()
    {
        $this->browse(function(Browser $browser){

            $firstBlogLinkSelector = '.blog:first-child .blog-link';

            $user = \App\User::first();

            $browser->loginAs($user)
                    ->visit(route('blogs.index'));

            $firstBlogTitle = $browser->text($firstBlogLinkSelector);

            $browser->click($firstBlogLinkSelector)
                ->assertVisible('@blog-edit-link');

            $browser->click('@blog-edit-link')
                ->assertVisible('@update-button');

            $browser

                //** Required fields intentionally left blank */

                ->click('@update-button')
                ->assertPathIsNot(route('blogs.index'));

        });
    }

    public function testShouldShowUpdateBlog()
    {
        $this->browse(function(Browser $browser){

            $firstBlogLinkSelector = '.blog:first-child .blog-link';

            $user = \App\User::first();

            $browser->loginAs($user)
                    ->visit(route('blogs.index'));

            $firstBlogTitle = $browser->text($firstBlogLinkSelector);

            $browser->click($firstBlogLinkSelector)
                ->assertVisible('@blog-edit-link');

            $browser->click('@blog-edit-link')
                ->assertVisible('@update-button');


            $updatedTitle = $firstBlogTitle . ' UPDATED';

            $browser
                ->type('title', $updatedTitle)
                ->type('description', 'Test Description UPDATED')
                ->click('@update-button')
                ->assertRouteIs('blogs.index')
                ->assertSeeIn('@blogs', $updatedTitle);

        });
    }

    public function testShouldShowDeleteBlogButton()
    {
        $this->browse(function(Browser $browser){

            $firstBlogLinkSelector = '.blog:first-child .blog-link';

            $user = \App\User::first();

            $browser->loginAs($user)
                    ->visit(route('blogs.index'));

            $firstBlogTitle = $browser->text($firstBlogLinkSelector);

            $browser->click($firstBlogLinkSelector)
                ->assertVisible('@blog-delete-link');

        });
    }

    public function testShouldDeleteBlog()
    {
        $this->browse(function(Browser $browser){

            $firstBlogLinkSelector = '.blog:first-child .blog-link';

            $user = \App\User::first();

            $browser->loginAs($user)
                    ->visit(route('blogs.index'));

            $firstBlogTitle = $browser->text($firstBlogLinkSelector);

            $browser->click($firstBlogLinkSelector)
                ->assertVisible('@blog-delete-link');

            $browser->click('@blog-delete-link');

//            $browser->driver->switchTo()->alert()->accept(); //click 'Yes' in confirmation alert

            $browser->click('.swal-button--continue')
                    ->waitFor('@blogs');

            $browser->assertRouteIs('blogs.index')
                ->assertDontSeeIn('@blogs', $firstBlogTitle);

        });
    }
}
