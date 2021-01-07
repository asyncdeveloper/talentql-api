<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTest extends TestCase
{

    use DatabaseMigrations;
    use WithFaker;

    /**
     * @test
     */
    public function loggedInUserCanCreateAProject()
    {
        $user = User::factory()->create();

        $project = [
            'name' => $this->faker->name,
            'description' => $this->faker->text
        ];
        $this->actingAs($user)
            ->postJson(route('projects.store'), $project)
            ->assertCreated();
    }

    /**
     * @test
     */
    public function loggedInUserViewCreatedProjects()
    {
        $user = User::factory()->create();

        Project::factory()
            ->for($user, 'creator')
            ->count(9)
            ->create();

        $this->actingAs($user)
            ->getJson(route('projects.index'))
            ->assertOk()
            ->assertJsonCount(9, 'data');
    }
}
