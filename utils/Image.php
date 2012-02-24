<?php

namespace Util;

class Image {
	
	public static function resize($inputFilename, $outputFilename, $maxWidth, $maxHeight, $stretch = false) {
		$originalSize = getimagesize($inputFilename);
		$inputType = $originalSize['mime'];
		$originalWidth = $originalSize[0];
		$originalHeight = $originalSize[1];
		
		switch ($inputType) {
			case 'image/jpeg':
			case 'image/pjpeg':
				$functionSuffix = 'jpeg';
				break;
			case 'image/png':
				$functionSuffix = 'png';
				break;
			case 'image/gif':
				$functionSuffix = 'gif';
				break;
			default:
				throw new Exception('Unrecognized image file format. Accepted formats are jpeg, png and gif.');
		}
		
		$function = 'imagecreatefrom' . $functionSuffix;
		$originalImage = $function($inputFilename);
		
		if (!$stretch && $originalWidth < $maxWidth && $originalHeight < $maxHeight) {
			imagejpeg($originalImage, $outputFilename, 100);
		} else {
			$targetRatio = $maxWidth / $maxHeight;
			$originalRatio = $originalWidth / $originalHeight;
			if ($originalRatio > $targetRatio) {
				$width = $maxWidth;
				$height = ($width * $originalHeight) / $originalWidth;
			} else {
				$height = $maxHeight;
				$width = ($height * $originalWidth) / $originalHeight;
			}
			$outputImage = imagecreatetruecolor($width, $height);
			imagecopyresampled($outputImage, $originalImage, 0, 0, 0, 0, $width, $height, $originalWidth, $originalHeight);
			imagejpeg($outputImage, $outputFilename, 100);
		}
	}
	
	public static function showFromString($str) {
		header('Content-type: image/jpeg');
		$img = imagecreatefromstring($str);
		imagejpeg($img, null, 100);
		imagedestroy($img);
	}
	
}