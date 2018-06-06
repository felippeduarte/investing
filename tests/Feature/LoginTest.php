<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;

class LoginTest extends TestCase
{
    protected $urlLogin = '/login';
    protected $urlLogout = '/logout';

    public function testLoginOk()
    {
        $password = 'test123';
        $user = factory(User::class)->create(['password' => \Hash::make($password)]);
        $response = $this->post($this->urlLogin, ['email' => $user->email, 'password' => $password]);

        $response->assertStatus(200);
        $this->assertNotNull(\Auth::user());
    }

    public function testLoginFailed()
    {
        $password = 'test123';
        $user = factory(User::class)->create(['password' => $password]); //without hash to force error
        $response = $this->post($this->urlLogin, ['email' => $user->email, 'password' => $password]);

        $response->assertStatus(401);
        $this->assertNull(\Auth::user());
    }

    public function testLogout()
    {
        $password = 'test123';
        $user = factory(User::class)->create(['password' => $password]);
        $response = $this->post($this->urlLogin, ['email' => $user->email, 'password' => $password]);

        $response = $this->get($this->urlLogout);

        $response->assertStatus(200);
        $this->assertNull(\Auth::user());
    }
}
