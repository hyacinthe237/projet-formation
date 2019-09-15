<?php
namespace App\Helpers;

use Cache;
use Carbon\Carbon;
use App\Models\Etudiant;

class EtudiantHelper
{


    public static function makeEtudiantNumber()
    {
        $last_etud = Etudiant::orderBy('id', 'desc')->first();
        return $last_etud ? $last_etud->number + rand(1, 3) : 1010103;
    }

    public static function signaturePAD($student, $signature_url)
    {
        $stud = Etudiant::whereNumber($student->number)->firstOrFail();

        $encoded_image = explode(",", $signature_url)[1];
        $decoded_image = base64_decode($encoded_image);
        $fileLocation = public_path('docs/signatures/etudiant-'.$etudiant->number.'.png');
        file_put_contents($fileLocation, $decoded_image);

        $stud->signature_url = '/docs/signatures/etudiant-'.$etudiant->number.'.png';
        $stud->save();
    }

}
