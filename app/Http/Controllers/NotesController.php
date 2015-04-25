<?php namespace Notes\Http\Controllers;

use Notes\Note;
use Notes\Transformers\NoteTransformer;

class NotesController extends Controller {

    private $noteTransformer;

    function __construct(NoteTransformer $noteTransformer)
    {
        $this->noteTransformer = $noteTransformer;
    }

    public function index()
    {
        $notes = Note::all();

        return $this->noteTransformer->transformCollection($notes);
    }
}