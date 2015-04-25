<?php namespace Notes\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Notes\Commands\CreateNote;
use Notes\Commands\UpdateNote;
use Notes\Http\Requests\CreateNoteRequest;
use Notes\Http\Requests\DeleteNoteRequest;
use Notes\Http\Requests\ListNotesRequest;
use Notes\Http\Requests\UpdateNoteRequest;
use Notes\Note;
use Notes\Tag;
use Notes\Transformers\NoteTransformer;

class NotesController extends Controller
{

    use DispatchesCommands;

    private $noteTransformer;

    function __construct(NoteTransformer $noteTransformer)
    {
        $this->noteTransformer = $noteTransformer;
    }

    public function index(ListNotesRequest $request)
    {
        $notes = Note::where('user_id', '=', \Auth::user()->id)->get();

        return $this->noteTransformer->transformCollection($notes);
    }

    public function store(CreateNoteRequest $request)
    {
        $note = $this->dispatch(
            new CreateNote($request->get('message'), $request->get('tags'))
        );

        return $this->noteTransformer->transform($note);
    }

    public function update($noteId, UpdateNoteRequest $request)
    {
        $note = $this->dispatch(
            new UpdateNote($noteId, $request->get('message'), $request->get('tags'))
        );

        return $this->noteTransformer->transform($note);
    }

    public function destroy($noteId, DeleteNoteRequest $request)
    {
        if(Note::where('id', '=', $noteId)->delete())
        {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
}