<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers;

use Blumilk\Meetup\Core\FilesFilter;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class StaticController extends Controller
{
    private const STATIC_PATH = "static";

    public function index(Request $request): BinaryFileResponse
    {
        $path = resource_path() . "/" . self::STATIC_PATH . "/" . $request->route("path");
        if (!File::exists($path) || FilesFilter::filter(File::basename($path))) {
            abort(Response::HTTP_NOT_FOUND);
        }

        $headers = [
            "Content-Type" => File::mimeType($path),
        ];

        return response()->file($path, $headers);
    }
}
