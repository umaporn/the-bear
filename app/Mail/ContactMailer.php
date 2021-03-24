<?php
/**
 * Control sending emails for contact.
 */

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * This class uses for sending a contact us email.
 */
class ContactMailer extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /** @var contact ContactModel model */
    protected $contact;

    /**
     * Initialize ContactMailer class.
     *
     * @param Contact $contact Contact model
     */
    public function __construct( Contact $contact )
    {
        $this->contact = $contact;
        $this->onQueue( 'contact_email' );
    }

    /**
     * Build the contact email message.
     *
     * @return ContactMailer ContactMailer instance
     */
    public function build()
    {

        $subject    = __( 'emails.contact.subject' );
        $introLines = [ __( 'emails.contact.name' ) . ': ' . $this->contact->name,
                        __( 'emails.contact.email' ) . ': ' . $this->contact->contacts_email,
                        __( 'emails.contact.company' ) . ': ' . $this->contact->company,
                        __( 'emails.contact.message' ) . ': ' . $this->contact->message,
        ];

        $greeting   = __( 'emails.contact.greeting' );
        $actionText = __( 'emails.contact.actionText' );

        return $this->markdown( 'notifications::email' )
                    ->subject( $subject )
                    ->with( [
                                'greeting'   => $greeting,
                                'level'      => '',
                                'introLines' => $introLines,
                                'actionText' => $actionText,
                                'actionUrl'  => route( 'home.index' ),
                                'outroLines' => [
                                    __( 'emails.contact.actionDetail' ),
                                ],
                            ] );
    }
}