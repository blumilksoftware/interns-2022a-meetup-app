<?php

declare(strict_types=1);

namespace Tests\Feature;

use Blumilk\Meetup\Core\Models\News;
use Blumilk\Meetup\Core\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class NewsTest extends TestCase
{
    use DatabaseMigrations;

    public function testUserCanSeeNewsList(): void
    {
        $admin = User::factory()->admin()->create();

        $news = News::factory()
            ->count(15)
            ->for($admin)
            ->create();

        $this->assertDatabaseCount('news', 15);

        $response = $this->get(route('news'))
            ->assertOk();

        foreach ($news as $singleNews) {
            $response->assertSee($singleNews->title);
        }
    }

    public function testNewsListIsPaginated(): void
    {
        $admin = User::factory()->admin()->create();

        News::factory()
            ->count(30)
            ->for($admin)
            ->create();

        $news = News::query()
            ->latest()
            ->skip(20)
            ->take(10);

        $this->assertDatabaseCount('meetups', 30);

        $response = $this->get(route('news') . '?page=2')
            ->assertOk();

        foreach ($news as $singleNews) {
            $response->assertSee($singleNews->title);
        }
    }

    public function testUserCanSeeNews(): void
    {
        $admin = User::factory()->admin()->create();
        $news = News::factory()->for($admin)->create();

        $this->get(route('news.show', $news))
            ->assertOk()
            ->assertSee($news->title)
            ->assertSee($news->text);
    }

    public function testAdminCanCreateNews(): void
    {
        $admin = User::factory()->admin()->create();

        $this->actingAs($admin)
            ->get(route("news.create"))
            ->assertOk();

        $this->actingAs($admin)
            ->post(route("news.store"), [
                "title" => 'Test news',
                "text" => 'Test news content',
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect(route("news.create"));

        $this->assertDatabaseHas("news", [
            "user_id" => $admin->id,
            "title" => 'Test news',
            "text" => 'Test news content',
        ]);
    }

    public function testUserCannotCreateNews(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route("news.create"))
            ->assertForbidden();

        $this->actingAs($user)
            ->post(route("news.store"))
            ->assertForbidden();
    }

    public function testAdminCanEditNews(): void
    {
        $admin = User::factory()->admin()->create();

        $news = News::factory()->for($admin)->create();

        $this->actingAs($admin)
            ->get(route("news.edit", $news))
            ->assertOk();

        $this->actingAs($admin)
            ->put(route("news.update", $news), [
                'title' => 'Test News',
                'text' => 'Test News Content',
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect(route("news.edit", $news));
    }

    public function testUserCannotEditNews(): void
    {
        $admin = User::factory()->admin()->create();
        $news = News::factory()->for($admin)->create();

        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route("news.edit", $news))
            ->assertForbidden();

        $this->actingAs($user)
            ->put(route("news.update", $news))
            ->assertForbidden();
    }

    public function testAdminCanDeleteNews(): void
    {
        $admin = User::factory()->admin()->create();

        $news = News::factory()->for($admin)->create();

        $this->actingAs($admin)
            ->delete(route("news.destroy", $news))
            ->assertRedirect();

        $this->assertModelMissing($news);
    }

    public function testUserCannotDeleteNews(): void
    {
        $admin = User::factory()->admin()->create();
        $news = News::factory()->for($admin)->create();

        $user = User::factory()->create();

        $this->actingAs($user)
            ->delete(route("news.destroy", $news));
    }
}
