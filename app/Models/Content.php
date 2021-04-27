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

    /**
     * Get Menu model relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo Menu model relationship
     */
    public function Menu()
    {
        return $this->belongsTo( 'App\Models\Menu', 'menu' );
    }

    public function getContentDetail( $id )
    {
        $data    = $this->with( [ 'Author', 'Gallery', 'Menu' ] )->where( [ 'id' => $id ] )->get();
        $image   = $this->getGallery( $data );
        $menu    = $this->getMenu( $data );
        $content = [ 'data' => $data, 'image' => $image, 'menu' => $menu ];

        return $content;
    }

    private function getMenu( $data )
    {
        $menuText = [];

        if( $data[0]->Menu !== null ){

            $menuFirst     = $data[0]->Menu;
            $upperID       = $menuFirst->upper_id;
            $sortID        = $menuFirst->sort_id;
            $menuNameFirst = $menuFirst->menu_name;

            array_push( $menuText, [ 'sortID' => $sortID, 'menuName' => $menuNameFirst ] );

            if( $upperID ){
                $menuSecond = DB::table( 'menu' )->where( 'id', $upperID )->get();
                array_push( $menuText, [ 'sortID' => $menuSecond[0]->sort_id, 'menuName' => $menuSecond[0]->menu_name ] );

                if( $menuSecond[0]->upper_id ){
                    $menuThird = DB::table( 'menu' )->where( 'id', $menuSecond[0]->upper_id )->get();
                    array_push( $menuText, [ 'sortID' => $menuThird[0]->sort_id, 'menuName' => $menuThird[0]->menu_name ] );

                }
            }

            usort( $menuText, function( $a, $b ){
                return $a['sortID'] <=> $b['sortID'];
            } );
        }

        return $menuText;
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

    public
    function getMoreContent( $id )
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
    private
    function transformContent( $data )
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