<?php namespace Notes\Transformers;

use Notes\Note;

class NoteTransformer extends Transformer
{
    private $tagTransformer;

    function __construct(TagTransformer $tagTransformer)
    {
        $this->tagTransformer = $tagTransformer;
    }

    /**
     * Transform the model data
     * @param Note $note
     * @return array|mixed
     */
    public function transform($note)
    {
        return [
            'id'      => (int) $note->id,
            'message' => $note->message,
            'tags'    => $this->embedTags($note)
        ];
    }

    /**
     * Embed the notes' tags
     * @param Note $note
     * @return array
     */
    protected function embedTags($note)
    {
        $tags = [];

        $note->tags->map(function ($tag) use (&$tags) {
            $tags[] = $this->tagTransformer->transform($tag);
        });

        return $tags;
    }
}