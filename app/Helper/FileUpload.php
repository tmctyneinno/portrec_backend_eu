<?php

namespace App\Helper;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

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

	public static function uploadFileToPath($request, String $name, String $filePath, String $refCode = null)
	{
		if (!File::exists(public_path($filePath))) {
			File::makeDirectory(public_path($filePath), 0755, true);
		}

		$fileNameToStore = null;

		if ($request->hasFile($name)) {

			$originalTempFile =  $request->file($name);
			$filenamewithextension = $originalTempFile->getClientOriginalName();
			$filename              = pathinfo($filenamewithextension, PATHINFO_FILENAME);
			$extension             = $originalTempFile->getClientOriginalExtension();
			$fileNameToStore       = $refCode === null
				? str_ireplace(' ', '_', $filename) . '_' . time() . '.' . $extension
				: $refCode . '_' . str_ireplace(' ', '_', $filename) . '_' . time() . '.' . $extension;

			$originalTempFile->move(public_path($filePath), $fileNameToStore);
		}

		$configUrl =  rtrim(config('app.url'), '/') . '/';

		return [
			'name' => $fileNameToStore,
			'url' => $configUrl . $filePath . '/' . $fileNameToStore,
		];
	}


	public static function deleteFileInPath($folder, $name)
	{
		if (File::exists(public_path($folder . '/' . $name))) {
			File::delete(public_path($folder . '/' . $name));
		}
	}

	public function ech()
	{
		return "word";
	}
}
