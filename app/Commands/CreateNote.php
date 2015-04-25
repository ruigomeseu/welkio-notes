<?php namespace Notes\Commands;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Notes\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;
use Notes\Note;
use Notes\Tag;

class CreateNote extends Command implements SelfHandling {

    private $message;
    private $tags;

    /**
     * Create a new command instance.
     *
     */
	public function __construct($message, $tags)
	{
        $this->message = $message;
        $this->tags = $tags;
    }

	/**
	 * Execute the command.
	 *
	 */
	public function handle()
	{
        $eloquentTags = [];

        //Loop over the input tags and create the tags that don't exist yet
        foreach ((array) $this->tags as $tag) {
            try {
                $eloquentTags[] = Tag::whereName($tag)->firstOrFail()->id;
            } catch (ModelNotFoundException $e) {
                $newTag = new Tag;
                $newTag->name = $tag;
                $newTag->save();
                $eloquentTags[] = $newTag->id;
            }
        }

        $note = new Note;
        $note->user_id = \Auth::user()->id;
        $note->message = $this->message;
        $note->save();

        $note->tags()->sync($eloquentTags);

        return $note;
	}

}
