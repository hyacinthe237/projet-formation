<?php
namespace App\Repositories;

use DB;
use Image;
use Carbon\Carbon;
use App\Models\Etudiant;

class EtudiantRepository
{

    /**
     * Upload base64 Image to etudiant profile
     *
     * @param  Etudiant $etudiant
     * @param  String    $base64String
     * @return
     */
    public function uploadProfilePicture (Etudiant $etudiant, $base64String) {
        if ($base64String) {
            $fileName  = '/uploads/profile/' . $etudiant->number . '_' . time() . '.jpg';
            $thumbName = '/uploads/profile/' . $etudiant->number . '_thumbnail_' . time() . '.jpg';

            /**
             * Resize image to a maximum of 500px width
             * Prevent upsizing
             * Create a thumbnail of 200 x 200
             */
            Image::make($base64String)->resize(150, null, function ($img) {
                $img->aspectRatio();
                // $img->upsize();
            })
            ->save(public_path() . $fileName)
            ->fit(200)
            ->save(public_path() . $thumbName);

            $etudiant->photo = $fileName;
            $etudiant->thumbnail = $thumbName;

            return $etudiant;
        }
    }

    /**
     * Get Limited Stagiaires
     *
     * @param  Etudiant $etudiants
     * @return
     */
    public function getLimitedStagiaires ($etudiants) {
        if (count($etudiants) > 0) {
            return Etudiant::limit(count($etudiants))->get();
        }
    }
}
