<?php namespace Notes\Transformers;

abstract class Transformer
{

    /**
     * Transform the model data
     * @param $item
     * @return mixed
     */
    public abstract function transform($item);

    public function transformCollection($collection)
    {
        return $collection->map([$this, 'transform']);
    }

}
