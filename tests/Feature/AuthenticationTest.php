<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{

    use DatabaseMigrations;
    use WithFaker;

    /**
     * @test
     */
    public function userCanRegisterWithValidEmailAndPassword()
    {
        $user = [
            'email' => $this->faker->email,
            'password' => $this->faker->password(6),
            'name' => $this->faker->name
        ];

        $this->postJson(route('register'), $user)
            ->assertCreated()
            ->assertJson([ 'data' => [
                'name' => $user['name'],
                'email' => $user['email']
            ]]);
    }

    /**
     * @test
     */
    public function userCanNotRegisterWithInvalidEmail()
    {
        $user = [
            'email' => 'sss',
            'password' => $this->faker->password,
            'name' => $this->faker->name
        ];

        $this->postJson(route('register'), $user)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @test
     */
    public function userCanLoginWithValidEmailAndPassword()
    {
        $user = User::factory()->create([
            'email' => 'me@example.com'
        ]);

        $this->postJson(route('login'), [
            'email' => $user->email,
            'password' => 'password'
        ])->assertOk()
        ->assertJsonStructure([ 'data', 'access_token', 'expires_in' ]);
    }

    /**
     * @test
     */
    public function userCanNotLoginWithInvalidCredentials()
    {
        $user =  [
            'email' => 'me@sss.com',
            'password' => '123456pass'
        ];
       User::factory(1)->create($user);

        $this->postJson(route('login'), [
            'email' => $user['email'],
            'password' => 'wrongpassword'
        ])->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

}
