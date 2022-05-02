<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Schema;
use BarcodeGenerator;
use QrCode;

class CodeGenerator {
	public static function barcodeGenerate($text){
		$barcode = new BarcodeGenerator();
		$barcode->setText($text);
		$barcode->setType(BarcodeGenerator::Code128);
		$barcode->setScale(2);
		$barcode->setThickness(25);
		$barcode->setFontSize(10);
		$code = $barcode->generate();
		return $code;
	}

	public static function qrcodeGenerate($text){
		$qrCode = new QrCode();
		$qrCode
		    ->setText($text)
		    ->setSize(300)
		    ->setPadding(10)
		    ->setErrorCorrection('high')
		    ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
		    ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
		    ->setLabelFontSize(16)
		    ->setImageType(QrCode::IMAGE_TYPE_PNG)
		;
		$code = $qrCode->generate();
		return $code;
	}
}	