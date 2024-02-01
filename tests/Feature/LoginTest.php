<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    protected function successfulLoginRoute()
    {
        return route('home');
    }
    
    protected function adminSuccessfulLoginRoute()
    {
        return route('admin.dashboard');
    }

    protected function loginGetRoute()
    {
        return route('login');
    }

    protected function loginPostRoute()
    {
        return route('login');
    }

    protected function logoutRoute()
    {
        return route('logout');
    }

    protected function successfulLogoutRoute()
    {
        return '/';
    }

    protected function guestMiddlewareRoute()
    {
        return route('home');
    }

    /**
     * A basic feature test example.
     */
    public function test_user_can_view_a_login_form(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('login');
        $response->assertSee('name="email"', false);
        $response->assertSee('name="password"', false);
        $response->assertSee('type="submit"', false);
    }

    public function test_user_cannot_view_a_login_form_when_authenticated()
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get($this->loginGetRoute());

        $response->assertRedirect($this->guestMiddlewareRoute());
    }

    // user

    public function test_user_can_login_with_correct_credentials()
    {
        $user = User::factory()->create([
            'password' => Hash::make($password = 'correct-pass'),
        ]);

        $response = $this->post($this->loginPostRoute(), [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect($this->successfulLoginRoute());
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_cannot_login_with_incorrect_password()
    {
        $user = User::factory()->create([
            'password' => Hash::make('correct-pass'),
        ]);

        $response = $this->from($this->loginGetRoute())->post($this->loginPostRoute(), [
            'email' => $user->email,
            'password' => 'incorrect-pass',
        ]);

        $response->assertRedirect($this->loginGetRoute());
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    public function test_user_cannot_login_with_incorrect_email()
    {
        $user = User::factory()->create([
            'password' => Hash::make($password = 'correct-pass'),
        ]);

        $response = $this->from($this->loginGetRoute())->post($this->loginPostRoute(), [
            'email' => 'diffEmail@test.com',
            'password' => $password,
        ]);

        $response->assertRedirect($this->loginGetRoute());
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    public function test_user_cannot_login_with_email_that_does_not_exist()
    {
        $response = $this->from($this->loginGetRoute())->post($this->loginPostRoute(), [
            'email' => 'user@test.com',
            'password' => 'incorrect-pass',
        ]);

        $response->assertRedirect($this->loginGetRoute());
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    // admin

    public function test_admin_can_login_with_correct_credentials()
    {
        $user = User::factory()->admin()->create([
            'password' => Hash::make($password = 'correct-pass'),
        ]);

        $response = $this->post($this->loginPostRoute(), [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect($this->adminSuccessfulLoginRoute());
        $this->assertAuthenticatedAs($user);
    }

    public function test_admin_cannot_login_with_incorrect_password()
    {
        $user = User::factory()->create([
            'password' => Hash::make('correct-pass'),
            'role' => 'Admin'
        ]);

        $response = $this->from($this->loginGetRoute())->post($this->loginPostRoute(), [
            'email' => $user->email,
            'password' => 'incorrect-pass',
        ]);

        $response->assertRedirect($this->loginGetRoute());
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    public function test_admin_cannot_login_with_incorrect_email()
    {
        $user = User::factory()->create([
            'password' => Hash::make($password = 'correct-pass'),
            'role' => 'Admin'
        ]);

        $response = $this->from($this->loginGetRoute())->post($this->loginPostRoute(), [
            'email' => 'diffEmail@test.com',
            'password' => $password,
        ]);

        $response->assertRedirect($this->loginGetRoute());
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    // admin

    // public function test_admin_login(): void
    // {
    //     $user = new User([
    //         'name' => 'admin',
    //         'email' => 'admin@gmail.com',
    //         'password' => bcrypt('admin123'),
    //     ]);
    //     $user->role = 'Admin';
    //     $user->save();

    //     $response = $this->post('/login', [
    //         'email' => 'admin@gmail.com',
    //         'password' => 'admin123',
    //     ]);
    //     $response->assertStatus(302);
    //     $response->assertRedirect('/admin/dashboard');
    // }

    // user

    // public function test_user_login(): void
    // {
    //     $user = new User([
    //         'name' => 'User Test',
    //         'email' => 'usertest@gmail.com',
    //         'password' => bcrypt('usertest123'),
    //     ]);
    //     $user->role = 'User';
    //     $user->save();

    //     $response = $this->post('/login', [
    //         'email' => 'usertest@gmail.com',
    //         'password' => 'usertest123',
    //     ]);
    //     $response->assertStatus(302);
    //     $response->assertRedirect('/');
    // }

    // public function test_user_login_with_different_email(): void
    // {
    //     $user = new User([
    //         'name' => 'User Test',
    //         'email' => 'usertest@gmail.com',
    //         'password' => bcrypt('usertest123'),
    //     ]);
    //     $user->role = 'User';
    //     $user->save();

    //     $response = $this->post('/login', [
    //         'email' => 'usert@gmail.com',
    //         'password' => 'usertest123',
    //     ]);
    //     $response->assertStatus(302);
    //     $response->assertRedirect('/');
    // }

    // public function test_user_login_with_different_password(): void
    // {
    //     $user = new User([
    //         'name' => 'User Test',
    //         'email' => 'usertest@gmail.com',
    //         'password' => bcrypt('usertest123'),
    //     ]);
    //     $user->role = 'User';
    //     $user->save();

    //     $response = $this->post('/login', [
    //         'email' => 'usertest@gmail.com',
    //         'password' => 'usert123',
    //     ]);
    //     $response->assertStatus(302);
    //     $response->assertRedirect('/login');
    // }

    // public function test_login_with_unknown_role(): void
    // {
    //     $user = new User([
    //         'name' => 'admimn',
    //         'email' => 'admin@gmail.com',
    //         'password' => bcrypt('admin123'),
    //     ]);
    //     $user->role = 'Unknown';
    //     $user->save();

    //     $response = $this->post('/login', [
    //         'email' => 'admin@gmail.com',
    //         'password' => 'admin123',
    //     ]);
    //     $response->assertStatus(302);
    //     $response->assertRedirect('/login');
    // }
}
