<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageUploaderController extends Controller
{
    public function save(Request $request)
    {
        $base64_image = $request->image;
        $extension = explode('/', mime_content_type($base64_image))[1];

        $allowed_extensions = ['jpg', 'jpeg', 'png'];
        if (!in_array($extension, $allowed_extensions)) {
            return $this->validationFailed([
                'userImage' => 'invalid image' . implode(', ', $allowed_extensions)
            ]);
        }
        if (preg_match('/^data:image\/(\w+);base64,/', $base64_image)) {
            $data = substr($base64_image, strpos($base64_image, ',') + 1);

            $data = base64_decode($data);
            $fileName = 'users/images/' . time() .  '.' . $extension;
            Storage::disk('public')->put($fileName, $data);
        } else {
            return $this->validationFailed([
                'video' => 'خطأ في رفع الملف'
            ]);
        }

        return response()->json([
            'path' => $fileName
        ]);
    }
}
