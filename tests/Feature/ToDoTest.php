<?php

namespace Tests\Feature;

use App\Models\ToDo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ToDoTest extends TestCase
{
    /**
     * Create user before test execution.
     */
    private function createUser()
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();

        return $user;
    }

    /**
     * Create task for test execution.
     */
    private function createTask()
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        return $user;
    }
    
    public function test_user_create_task(): void
    {
        $user = $this->createUser();

        $task = [
            "user_id" => $user->id,
            "task" => "This is a test task",
            "is_complete" => true,
        ];

        $response = $this->postJson('/api/v1/task', $task);

        $response->assertStatus(201);
    }

    public function test_user_update_task_status(): void
    {
        $task = $this->createTask();

        $updateTask = [
            "task_id" => $task->id,
            "is_complete" => true
        ];

        $response = $this->putJson('/api/v1/task/update', $updateTask);

        $response->assertStatus(201);
    }

    public function test_user_delete_task(): void
    {
        $task = $this->createTask();

        $deleteTask = [
            "task_id" => $task->id
        ];

        $response = $this->deleteJson('/api/v1/task/delete', $deleteTask);

        $response->assertStatus(201);
    }
}
