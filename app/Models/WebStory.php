<?php
/**
 * Manage a webstory data.
 */

namespace App\Models;

use App\Libraries\ServiceRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * This class handles a webstory model.
 */
class Webstory extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'web_story';

    /**
     * Get Content model relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo Content model relationship
     */
    public function Content()
    {
        return $this->hasMany( 'App\Models\Content', 'web_story' );
    }

    public function getWebStory()
    {
        $data = $this->with( ['Content'] )->whereHas( 'content', function( $query ){
            $query->where( 'sitename', '=', '5' );
        } )->orderBy( 'id', 'desc' )->limit( 5 )->get();

        return $this->transformMainImage( $data );

    }

    private function transformMainImage( $data )
    {

        foreach( $data as $list ){
            $image = ServiceRequest::call(
                'GET',
                '/assets/' . $list->image,
                true,
                );

            $list->setAttribute( 'new_main_image', $image );
        }

        return $data;
    }
}