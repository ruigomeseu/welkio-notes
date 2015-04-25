<?php namespace Notes\Transformers;

class TagTransformer extends Transformer
{

    /**
     * Transform the model data
     * @param $tag
     * @return array|mixed
     */
    public function transform($tag)
    {
        return [
            'tag' => $tag->name
        ];
    }
}