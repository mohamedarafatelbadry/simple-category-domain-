<?php

namespace Domains\Base\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


class AppBaseController extends Controller {

    function sendResponse($data = null,string $message = null, int $status = 200): \Illuminate\Http\JsonResponse
    {
        $response = [];

        if ($data) {
            $response['data'] = $data;
        }

        if ($message) {
            $response['message'] = $message;
        }

        if ($status) {
            $response['status'] = $status;
        }

        return response()->json($response,$status);
    }

    function sendError(string $message = null, $data = null, int $status = 404): \Illuminate\Http\JsonResponse
    {
        $response = [];

        if ($data) {
            $response['data'] = $data;
        }

        if ($message) {
            $response['message'] = $message;
        }

        if ($status) {
            $response['status'] = $status;
        }

        return response()->json($response,$status);
    }

	public function sendSuccess($message): \Illuminate\Http\JsonResponse
    {
		return response()->json([
			'success' => true,
			'message' => $message,
		], 200);
	}

    public function saveImageArray($images, string $name): array
    {
        $imagePaths = [];
        foreach ($images as $image) {
            $fullPath=$image->store($name , 'StoreApp');
            $imagePaths[] = asset(Storage::url($fullPath));
        }
        return $imagePaths;

    }


    // handle image full project
    public function saveImage($images, string $name)
    {
        return $images->store($name);
    }

    public function updateImage($oldImage,$image, string $name)
    {
        $this->fileRemove($oldImage);
        return $image->store($name);
    }

    public function fileRemove($file): void
    {
        if (Storage::disk('local')->exists($file)) {
            Storage::disk('local')->delete($file);
        }
    }
}
