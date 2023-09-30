<?php

namespace App\Helper;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUpload
{
	public static function uploadFile($file, $dest = "uploads")
	{
		if (!in_array($file->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'pdf'])) {
			return response(['error' => 'Invalid file format'], 400);
		}

		$filePath = Storage::disk("public")->putFile($dest, $file);
		if (!$filePath) {
			return response(['error' => 'Error storing the image'], 500);
		}

		$relativePath = '/storage/' . $filePath;
		$fullUrl = url($relativePath);

		return $fullUrl;
	}

	public function ech()
	{
		return "word";
	}
}
