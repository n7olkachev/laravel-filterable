<?php

namespace N7olkachev\LaravelFilterable\Test;

use Carbon\Carbon;
use N7olkachev\LaravelFilterable\Test\Models\Page;

class FilterableTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        Page::create([
            'title' => 'First page',
            'created_at' => Carbon::create(2017, 1, 1, 0, 0, 0),
        ]);

        Page::create([
            'title' => 'Second page',
            'created_at' => Carbon::create(2015, 1, 1, 0, 0, 0),
        ]);
    }

    /** @test */
    public function it_works_without_scopes()
    {
        $page = Page::filter(['title' => 'First page'])->first();
        $this->assertTrue($page->exists);
    }

    /** @test */
    public function it_works_with_scopes()
    {
        $pages = Page::filter(['created_after' => Carbon::create(2016, 1, 1, 0, 0, 0)])->get();
        $this->assertEquals($pages->count(), 1);
        $pages = Page::filter(['created_after' => Carbon::create(2018, 1, 1, 0, 0, 0)])->get();
        $this->assertEquals($pages->count(), 0);
    }

    /** @test */
    public function it_works_for_arrays()
    {
        $pages = Page::filter(['title' => ['First page', 'Second page']])->get();
        $this->assertEquals($pages->count(), 2);
        $pages = Page::filter(['title' => ['Third page']])->get();
        $this->assertEquals($pages->count(), 0);
    }
}