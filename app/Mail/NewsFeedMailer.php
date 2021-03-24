<?php
/**
 * Control sending emails for the News feed request.
 */

namespace App\Mail;

use App\Models\NewsFeed;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * This class uses for sending the News feed request email.
 */
class NewsFeedMailer extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /** @var NewsFeed NewsFeedModel model */
    protected $newsFeed;

    /**
     * Initialize NewsFeedMailer class.
     *
     * @param NewsFeed $newsFeed News feed model
     */
    public function __construct( NewsFeed $newsFeed )
    {
        $this->newsFeed = $newsFeed;
        $this->onQueue( 'news_feed_email' );
    }

    /**
     * Build the News Feed email message.
     *
     * @return NewsFeedMailer NewsFeedMailer instance
     */
    public function build()
    {

        return $this->markdown( 'notifications::email' )
                    ->subject( __( 'emails.news_feed.subject' ) )
                    ->with( [
                                'greeting'   => __( 'emails.news_feed.greeting' ),
                                'level'      => '',
                                'introLines' => [ __( 'emails.news_feed.email' ) . ': ' . $this->newsFeed->news_feed_email,
                                ],
                                'actionText' => __( 'emails.news_feed.actionText' ),
                                'actionUrl'  => route( 'home.index' ),
                                'outroLines' => [
                                    __( 'emails.news_feed.actionDetail' ),
                                ],
                            ] );

    }
}