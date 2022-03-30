<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response as FacadesResponse;

class AssetsController extends Controller
{
    private const ASSETS_PATH = "static";

    public function index(Request $request): Response
    {
        $path = resource_path() . "/" . self::ASSETS_PATH . "/" . $request->route("folder") . "/" . $request->route("file");
        if (!File::exists($path)) {
            return FacadesResponse::make("", Response::HTTP_NOT_FOUND);
        }

        $response = FacadesResponse::make(File::get($path));
        $response->header("Content-Type", File::mimeType($path));

        return $response;
    }
}
