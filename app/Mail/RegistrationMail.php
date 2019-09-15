<?php

namespace App\Mail;

use App\Models\Etudiant;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\URL;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class RegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

     /**
     * The etudiant instance.
     *
     * @var Etudiant
     */
    protected $etudiant;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Etudiant $etudiant)
    {
        $this->etudiant = $etudiant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.registration')
                ->with([
                    'etudiant' => $this->etudiant
                    ]);
    }
}
