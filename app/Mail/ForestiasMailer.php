<?php
/**
 * Control sending emails for forestias member register.
 */

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * This class sending forestias member register email.
 */
class ForestiasMailer extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /** @var array member information */
    public $member;

    /**
     * Create a new message instance.
     *
     * @param array $member member register
     */
    public function __construct( $member )
    {
        $this->member = $member;
        $this->onQueue( env('FORESTIAS_MAIL_NAMEQUEUE') );
    }

    /**
     * Build  member register email
     *
     * @return ForestiasMailer forestiasMailer instance
     */
    public function build()
    {
        return $this->subject( 'DTGO member interested your project' )
                    ->view( 'forestias.mail' );
    }
}
