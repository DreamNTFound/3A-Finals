<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_get_student()
    {
        $response = $this->get('/api/students');
        $response->assertStatus(200);
        $response->assertJsonPath('greetings','hello');
    }
    
    public function test_post_student()
    {
        $response = $this->post(
            '/api/students',
        [
            'firstname' => 'Jenard',
            'lastname' => 'Hinayon',
            'birthdate' => '2002-09-12',
            'sex' => 'Male',
            'address' => 'Tacloban City',
            'year' => '3',
            'course' => 'BSIT',
            'section' => '3A',
        ]
    );

        $response->assertStatus(200);
        $response->assertJsonStructure(['message']);
        $response->assertJsonPath('message', 'User created!');

    }

    public function test_patch_student()
    {
        $response = $this->patch('api/students/{id}',
        [
            'firstname' => 'Jenard',
            'lastname' => 'Hinayon',
            'birthdate' => '2002-09-12',
            'sex' => 'Male',
            'address' => 'Tacloban City',
            'year' => '4',
            'course' => 'BSIT',
            'section' => '3A'
        ]
    );

        $response->assertStatus(200);
        $response->assertJsonStructure(['message']);
        $response->assertJsonPath('message', 'User update!');
    }
}
