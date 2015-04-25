<?php namespace Notes\Commands;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Notes\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;
use Notes\Note;
use Notes\Tag;

class UpdateNote extends Command implements SelfHandling {
    /**
     * @var
     */
    private $note;
    /**
     * @var
     */
    private $message;
    /**
     * @var
     */
    private $tags;

    /**
     * Create a new command instance.
     *
     * @param $note
     * @param $message
     * @param $tags
     */
	public function __construct($note, $message, $tags)
	{
        $this->note = $note;
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

        $note = Note::find($this->note);
        $note->user_id = \Auth::user()->id;
        $note->message = $this->message;
        $note->save();

        $note->tags()->sync($eloquentTags);

        return $note;
	}

}
