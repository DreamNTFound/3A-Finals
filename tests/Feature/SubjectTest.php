<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubjectTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_get_subject()
    {
        $response = $this->get('/api/students/{id}/subjects');
        $response->assertStatus(200);
        $response->assertJsonPath('greetings','hello');
    }

    public function test_post_subject()
    {
        $response = $this->post('api/students/{id}/subjects',
        [
            'student_id'=>1,
            'subject_code'=>123,
            'name'=>'DreamNTFound',
            'description'=>'Minecraft Player',
            'instructor'=>'Prof. Dream',
            'schedule'=>'MW 8AM-12PM',
            'grades'=>1.0,
            'prelims'=>1.75,
            'midterms'=>1.5,
            'prefinals'=>1.5,
            'finals'=>1.0,
            'average_grade'=>1.0,
            'remarks'=>'passed',
            'date_taken'=>'1995-06-25'
        ]
        );

        $response->assertStatus(200);
        $response->assertJsonStructure(['message']);
        $response->assertJsonPath('message', 'Subject Added!');
    }

    public function test_patch_subject()
    {
        $response = $this->patch('api/students/{id}/subjects/{subject_id}',
        [
            'student_id'=>2,
            'subject_code'=>123,
            'name'=>'DreamNTFound',
            'description'=>'Minecraft Player',
            'instructor'=>'Prof. Dream',
            'schedule'=>'MW 8AM-12PM',
            'grades'=>1.0,
            'prelims'=>1.75,
            'midterms'=>1.5,
            'prefinals'=>1.5,
            'finals'=>1.0,
            'average_grade'=>1.0,
            'remarks'=>'passed',
            'date_taken'=>'1995-06-25'
        ]
        );

        $response->assertStatus(200);
        $response->assertJsonStructure(['message']);
        $response->assertJsonPath('message', 'Subject Update!');
    }
}
