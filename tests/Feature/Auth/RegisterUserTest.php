<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function users_can_register_an_account()
    {
        $response = $this->post(route('register'), $this->validParams());

        $response->assertRedirect('/');

        $this->assertTrue(Auth::check());
        $this->assertCount(1, User::all());

        tap(User::first(), function ($user) {
            $this->assertEquals('John', $user->name);
            $this->assertEquals('Doe', $user->surname);
            $this->assertEquals('johndoe@example.com', $user->email);
            $this->assertTrue(Hash::check('secret', $user->password));
        });
    }

    /** @test */
    public function name_cannot_exceed_255_chars()
    {
        $this->withExceptionHandling();
        $this->from(route('register'));

        $response = $this->post(route('register'), $this->validParams([
            'name' => str_repeat('a', 256),
        ]));

        $response->assertRedirect(route('register'));
        $response->assertSessionHasErrors('name');
        $this->assertFalse(Auth::check());
        $this->assertCount(0, User::all());
    }

    /** @test */
    public function surname_cannot_exceed_255_chars()
    {
        $this->withExceptionHandling();
        $this->from(route('register'));

        $response = $this->post(route('register'), $this->validParams([
            'surname' => str_repeat('a', 256),
        ]));

        $response->assertRedirect(route('register'));
        $response->assertSessionHasErrors('surname');
        $this->assertFalse(Auth::check());
        $this->assertCount(0, User::all());
    }

    /** @test */
    public function email_is_required()
    {
        $this->withExceptionHandling();
        $this->from(route('register'));

        $response = $this->post(route('register'), $this->validParams([
            'email' => '',
        ]));

        $response->assertRedirect(route('register'));
        $response->assertSessionHasErrors('email');
        $this->assertFalse(Auth::check());
        $this->assertCount(0, User::all());
    }

    /** @test */
    public function email_is_valid()
    {
        $this->withExceptionHandling();
        $this->from(route('register'));

        $response = $this->post(route('register'), $this->validParams([
            'email' => 'not-an-email-address',
        ]));

        $response->assertRedirect(route('register'));
        $response->assertSessionHasErrors('email');
        $this->assertFalse(Auth::check());
        $this->assertCount(0, User::all());
    }

    /** @test */
    public function email_cannot_exceed_255_chars()
    {
        $this->withExceptionHandling();
        $this->from(route('register'));

        $response = $this->post(route('register'), $this->validParams([
            'email' => substr(str_repeat('a', 256) . '@example.com', -256),
        ]));

        $response->assertRedirect(route('register'));
        $response->assertSessionHasErrors('email');
        $this->assertFalse(Auth::check());
        $this->assertCount(0, User::all());
    }

    /** @test */
    public function email_is_unique()
    {
        create(User::class, ['email' => 'johndoe@example.com']);
        $this->withExceptionHandling();
        $this->from(route('register'));

        $response = $this->post(route('register'), $this->validParams([
            'email' => 'johndoe@example.com',
        ]));

        $response->assertRedirect(route('register'));
        $response->assertSessionHasErrors('email');
        $this->assertFalse(Auth::check());
        $this->assertCount(1, User::all());
    }

    /** @test */
    public function password_is_required()
    {
        $this->withExceptionHandling();
        $this->from(route('register'));

        $response = $this->post(route('register'), $this->validParams([
            'password' => '',
        ]));

        $response->assertRedirect(route('register'));
        $response->assertSessionHasErrors('password');
        $this->assertFalse(Auth::check());
        $this->assertCount(0, User::all());
    }

    /** @test */
    public function password_must_be_confirmed()
    {
        $this->withExceptionHandling();
        $this->from(route('register'));

        $response = $this->post(route('register'), $this->validParams([
            'password' => 'foo',
            'password_confirmation' => 'bar'
        ]));

        $response->assertRedirect(route('register'));
        $response->assertSessionHasErrors('password');
        $this->assertFalse(Auth::check());
        $this->assertCount(0, User::all());
    }

    /** @test */
    public function password_must_be_6_chars()
    {
        $this->withExceptionHandling();
        $this->from(route('register'));

        $response = $this->post(route('register'), $this->validParams([
            'password' => 'foo',
            'password_confirmation' => 'foo',
        ]));

        $response->assertRedirect(route('register'));
        $response->assertSessionHasErrors('password');
        $this->assertFalse(Auth::check());
        $this->assertCount(0, User::all());
    }

    private function validParams($overrides = [])
    {
        return array_merge([
            'name' => 'John',
            'surname' => 'Doe',
            'email' => 'johndoe@example.com',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ], $overrides);
    }
}