<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Services;

use Blumilk\Meetup\Core\Contracts\StoreFile;
use Illuminate\Http\UploadedFile;

class StoreFileService implements StoreFile
{
    protected string $path;

    public function storeFile(string $uploadFolder, UploadedFile $file): string
    {
        $this->path = $file->store($uploadFolder, "public");

        return $this->path;
    }
}
