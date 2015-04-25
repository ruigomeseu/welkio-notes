<?php

use Notes\Note;

class NotesTest extends ApiTester {

    /**
     * @test
     */
    public function it_fetches_notes()
    {
        $_SERVER['REQUEST_METHOD'] = 'get';
        $response = $this->getJson('/notes?token=123');
        $this->assertResponseStatus(200);
        $this->assertObjectHasAttribute('message', $response[0]);
    }

    /**
     * @test
     */
    public function it_creates_note()
    {
        $_SERVER['REQUEST_METHOD'] = 'post';

        $_POST = [
            'message' => 'Created note'
        ];

        $this->call('POST', '/notes?token=123', $_POST);

        $note = Note::whereMessage('Created note');

        $this->assertResponseStatus(200);
        $this->assertTrue($note->exists());
    }

    /**
     * @test
     */
    public function it_creates_note_with_tags()
    {
        $_SERVER['REQUEST_METHOD'] = 'post';

        $_POST = [
            'message' => 'Note with tags',
            'tags' => [
                'First tag',
                'Second tag'
            ]
        ];

        $this->call('POST', '/notes?token=123', $_POST);

        $note = Note::whereMessage('Note with tags');

        $this->assertEquals(2, count($note->first()->tags));
        $this->assertResponseStatus(200);
        $this->assertTrue($note->exists());
    }

    /**
     * @test
     */
    public function it_updates_note()
    {
        $_SERVER['REQUEST_METHOD'] = 'put';

        $_POST = [
            'message' => 'Updated note'
        ];

        $this->call('PUT', '/notes/1?token=123', $_POST);

        $note = Note::whereMessage('Updated note');

        $this->assertResponseStatus(200);
        $this->assertTrue($note->exists());
    }

    /**
     * @test
     */
    public function it_deletes_notes()
    {
        $_SERVER['REQUEST_METHOD'] = 'delete';

        $this->call('DELETE', '/notes/1?token=123');

        $this->assertResponseStatus(200);
        $this->assertEquals(0, count(Note::all()));
    }




}