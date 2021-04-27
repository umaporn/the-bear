<?php
/**
 * Manage a company data.
 */

namespace App\Models;

use App\Libraries\Image;
use App\Libraries\ServiceRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * This class handles a press kit model.
 */
class Content extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'content';

    /**
     * Get EZusers model relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo User model relationship
     */
    public function Author()
    {
        return $this->belongsTo( 'App\Models\Author', 'author_name' );
    }

    /**
     * Get EZusers model relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany User model relationship
     */
    public function Gallery()
    {
        return $this->hasMany( 'App\Models\Gallery', 'content_id' );
    }

    public function getContentDetail( $id )
    {
        $data    = $this->with( [ 'Author', 'Gallery' ] )->where( [ 'id' => $id ] )->get();
        $image   = $this->getGallery( $data );
        $content = [ 'data' => $data, 'image' => $image ];
        return $content;
    }

    private function getGallery( $data )
    {
        $image = [];
        foreach( $data as $item ){
            foreach( $item->gallery as $key => $gallery ){

                $galleryImage = DB::table( 'gallery_image' )->where( 'gallery_id', $gallery->id )->get();

                foreach( $galleryImage as $gImage ){
                    array_push( $image,
                                DB::table( 'image' )->where( 'id', $gImage->image_id )->get(),
                                );
                }
            }
        }

        return $image;
    }

    public function getMoreContent( $id )
    {
        $data = $this->with( [ 'Author' ] )->inRandomOrder()->whereNotIn( 'id', [ $id ] )->take( 6 )->get();

        return $this->transformContent( $data );
    }

    /**
     * Transform news information.
     *
     * @param LengthAwarePaginator $homeNewsList A list of news
     *
     * @return LengthAwarePaginator Home news list for display
     */
    private function transformContent( $data )
    {

        foreach( $data as $list ){

            $image = null;

            if( $list->main_image !== null ){
                $image = ServiceRequest::call(
                    'GET',
                    '/assets/' . $list->main_image,
                    true,
                );
            }
            $list->setAttribute( 'new_main_image', $image );
        }

        return $data;
    }
}