<?php

namespace Tests\Feature;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoTest extends TestCase
{
    use DatabaseMigrations;
    use WithFaker; use DatabaseMigrations;
    use WithFaker;

    /**
     * @test
     */
    public function loggedInUserCanCreateATodo()
    {
        $user = User::factory()->create();

        $todo = [
            'title' => $this->faker->name,
            'body' => $this->faker->text
        ];
        $this->actingAs($user)
            ->postJson(route('todos.store'), $todo)
            ->assertCreated();
    }

    /**
     * @test
     */
    public function loggedInUserViewCreatedTodos()
    {
        $user = User::factory()->create();

        Todo::factory()
            ->for($user, 'creator')
            ->count(15)
            ->create();

        $this->actingAs($user)
            ->getJson(route('todos.index'))
            ->assertOk()
            ->assertJsonCount(15, 'data');
    }
}
