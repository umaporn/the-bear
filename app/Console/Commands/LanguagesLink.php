<?php
/**
 * Create a symbolic link for JavaScript translation.
 */

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * This class handles creating a symbolic link for JavaScript translation.
 * @package App\Console\Commands
 */
class LanguagesLink extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'languages:link';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a symbolic link from "public/languages" to "resources/lang"';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if( file_exists( public_path( 'languages' ) ) ){
            $this->error( 'The "public/languages" directory already exists.' );
        } else {
            
            $this->laravel->make( 'files' )->link(
                resource_path( 'lang' ), public_path( 'languages' )
            );

            $this->info( 'The [public/languages] directory has been linked.' );
        }
    }
}
