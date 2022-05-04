<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class StaticController extends Controller
{
    private const IGNORE_HEADER_FILES_EXTENSION = [
        "css",
    ];
    private const IGNORE_FILES = [
        ".gitignore",
    ];
    private const STATIC_PATH = "static";

    public function index(Request $request): BinaryFileResponse
    {
        $path = resource_path() . "/" . self::STATIC_PATH . "/" . $request->route("path");
        if (!File::exists($path) || $this->filesFilter(File::basename($path))) {
            abort(Response::HTTP_NOT_FOUND);
        }
        $headers = [
            "Content-Type" => in_array(File::extension($path), static::IGNORE_HEADER_FILES_EXTENSION, true) ? null : File::type($path),
        ];

        return response()->file($path, $headers);
    }

    private function filesFilter(string $fileName): bool
    {
        return in_array($fileName, static::IGNORE_FILES, true);
    }
}
