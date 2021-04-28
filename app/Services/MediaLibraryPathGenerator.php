<?php

namespace App\Services;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class MediaLibraryPathGenerator implements PathGenerator
{
    public function getPath(Media $media) : string
    {
        return strtr(":collection_name/:model_id/:media_id/", [
            ":collection_name" => $media->collection_name,
            ":model_id" => $media->model->id,
            ":media_id" => $media->id,
        ]);
    }

    public function getPathForConversions(Media $media) : string
    {
        return $this->getPath($media) . "conversions/";
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getPath($media) . "responsive/";
    }
}
