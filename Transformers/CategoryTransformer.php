<?php

namespace Modules\Itest\Transformers;

use Illuminate\Http\Resources\Json\Resource;

use Modules\Media\Image\Imagy;

class CategoryTransformer extends Resource
{
    /**
     * @var Imagy
     */
    private $imagy;

    public function __construct($resource)
    {
        parent::__construct($resource);

        $this->imagy = app(Imagy::class);
    }

    public function toArray($request)
    {
        $data =[
            'id' => $this->when($this->id, $this->id),
            'title' => $this->when($this->title, $this->title),
            'slug' => $this->when($this->slug, $this->slug),
            'description' => $this->when($this->description, $this->description),
            'metaTitle' => $this->when($this->meta_title, $this->meta_title),
            'metaDescription' => $this->when($this->meta_description, $this->meta_description),
            'metaKeywords' => $this->when($this->meta_keywords, $this->meta_keywords),
            'mainImage' => $this->main_image,
            'secondaryImage' => $this->when($this->secondary_image, $this->secondary_image),
            'createdAt' => $this->when($this->created_at, $this->created_at),
            'options' => $this->when($this->options, json_decode($this->option)),

        ];

        $locales = $this->whenLoaded('translations')->groupBy('locale');
      if(isset($locales) && !empty($locales)) {
        foreach ($locales as $locale => $items) {
          $data[$locale] = $items;
        }
      }

        return $data;
    }
}