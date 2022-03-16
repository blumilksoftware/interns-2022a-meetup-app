<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Services\Organization;

use Illuminate\Http\UploadedFile;

class StoreFileService
{
    protected string $path;

    public function storeFile(string $uploadFolder, UploadedFile $file): string
    {
        $this->path = $file->store($uploadFolder);

        return $this->path;
    }
}
