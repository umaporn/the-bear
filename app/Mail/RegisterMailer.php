<?php

namespace App\Mail;

use App\Models\Users;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterMailer extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     *
     * @var Users $contact
     */
    private $users;

    /**
     * RegisterMailer constructor.
     *
     * @param Users $users
     */
    public function __construct( Users $users )
    {
        $this->users = $users;
        $this->onQueue( env( 'REGISTER_MAIL_QUEUE', 'register_email' ) );
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $introLines = [
            __( 'emails.users.name' ) . ': ' . $this->users->firstname . ' ' . $this->users->lastname ,
            __( 'emails.users.email' ) . ': ' . $this->users->email,
        ];

        return $this->markdown( 'notifications::email' )
                    ->subject( __( 'emails.users.subject' ) )
                    ->with( [
                                'greeting'   => __( 'emails.users.greeting' ),
                                'level'      => '',
                                'introLines' => $introLines,
                                'actionUrl'  => route( 'home.index' ),
                                'outroLines' => [
                                    __( 'emails.users.actionDetail' ),
                                ],
                            ] );
    }
}
