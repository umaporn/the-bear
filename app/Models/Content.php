<?php
/**
 * Manage a company data.
 */

namespace App\Models;

use App\Libraries\Image;
use App\Libraries\Search;
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
        $data          = $this->with( [ 'Author', 'Gallery' ] )->where( [ 'id' => $id ] )->get();
        $newContent    = $this->transformContentDetail( $data[0]->content );
        $image         = $this->getGallery( $data );
        $menu          = $this->getMenu();
        $menuIncontent = $this->getMenuInContent( $id );
        $content       = [ 'data' => $data, 'image' => $image, 'menu' => $menu, 'menuInContent' => $menuIncontent, 'newContent' => $newContent ];

        return $content;
    }

    public function getHeaderMenu()
    {
        $menu    = $this->getMenu();
        $content = [ 'menu' => $menu ];

        return $content;
    }

    public function getContentList()
    {
        $data    = $this->where( 'sitename', '5' )->orderBy( 'id', 'desc' )->limit( 6 )->get();
        $newData = $this->transformContent( $data );

        return $newData;
    }

    public function getContentMenuList( $menuID, Request $request )
    {
        $builder = $this->with( [ 'Menu' ] )->orderBy( 'id', 'desc' )->where( [ 'menu' => $menuID, 'sitename' => '5' ] );
        $data    = Search::search( $builder, 'content', $request );
        $newData = $this->transformContent( $data );

        return $newData;
    }

    public function getContentSearchList( Request $request )
    {
        $builder = $this->where( 'sitename', '5' )->orderBy( 'id', 'desc' );
        $data    = Search::search( $builder, 'content', $request );
        $newData = $this->transformContent( $data );

        return $newData;
    }

    private function transformMainImage( $data )
    {
        foreach( $data as $list ){
            $image = ServiceRequest::call(
                'GET',
                '/assets/' . $list->main_image,
                true,
                );
        }

    }

    private function transformContentDetail( $data )
    {
        $albumName = [];
        $imageItem = [];

        //str_replace('Today' , 'test', $data);

        //$data = str_ireplace('http://desk.thebear.group' , 'http://desk.thebear.group', $data);


        $components = explode( ']]', $data );

        foreach( $components as $item ){
            $tags = explode( '[[', $item );

            if( isset( $tags[1] ) ){

                $galleryID = DB::table( 'gallery' )
                               ->where( [
                                            'name'   => $tags[1],
                                            'status' => 'enable',
                                        ] )
                               ->get();

                $imageID  = DB::table( 'gallery_image' )
                              ->where( [
                                           'gallery_id' => $galleryID[0]->id,
                                       ] )
                              ->get();
                $imageStr = '';
                foreach( $imageID as $imageItem ){
                    $image_id  = $imageItem->image_id;
                    $imageData = DB::table( 'image' )->where( 'id', $image_id )->get();
                    $imageStr  .= $this->getImage( $imageData->toArray() );
                }
                $data = str_replace( '[[' . $tags[1] . ']]', '<div id="columns">' . $imageStr . '</div>', $data );
            }
        }

        $data = $this->transformImageFromBackend( $data );
        return $data;
    }

    private function transformImageFromBackend( $data )
    {
        $imageStr = '';
        $components = explode( 'http://desk.thebear.group:8055/assets/', $data );

        foreach( $components as $key => $items ){
            if($key > 0){
                $item = substr($items, 0, 36);

                if( isset( $item ) ){
                    $result= ServiceRequest::call(
                        'GET',
                        '/assets/' . $item,
                        true,
                );

                    $imageStr = 'data:image/png;base64,' . $result . '';
                    $data = str_replace( 'http://desk.thebear.group:8055/assets/'. $item,  $imageStr , $data );
                }

            }

        }
        return $data;
    }

    private function getImage( $imageData )
    {
        $imageStrInfo = '';
        foreach( $imageData as $imageItem ){
            $imageStr = '<figure>';
            $image    = ServiceRequest::call( 'GET',
                                              '/assets/' . $imageItem->image,
                                              true, );
            $imageStr .= '<a href="data:image/png;base64,' . $image . '"
                               class="gallery-pic" data-fancybox="gallery-units"
                               data-caption="' . $imageItem->description . '"><img src="data:image/png;base64,' . $image . '"
                                     alt="' . $imageItem->alt_tag . '" title="' . $imageItem->alt_tag . '"></a>';

            $imageStr .= '</figure>';
        }

        return $imageStrInfo . $imageStr;
    }

    private function getMenu()
    {
        $menuText       = [];
        $menuFirstText  = [];
        $menuSecondText = [];
        $menuThirdText  = [];

        $menuFirst = DB::table( 'menu' )
                       ->where( [
                                    'language' => 'EN',
                                    'sitename' => '5',
                                    'status'   => 'enable',
                                ] )
                       ->whereNull( 'upper_id' )
                       ->orderBy( 'sort_id', 'asc' )
                       ->get();

        foreach( $menuFirst as $menuFirstItem ){
            $id            = $menuFirstItem->id;
            $sortID        = $menuFirstItem->sort_id;
            $menuNameFirst = $menuFirstItem->menu_name;

            $menuSecond = DB::table( 'menu' )
                            ->where( [
                                         'language' => 'EN',
                                         'sitename' => '5',
                                         'status'   => 'enable',
                                         'upper_id' => $id,
                                     ] )
                            ->orderBy( 'sort_id', 'asc' )
                            ->get();

            foreach( $menuSecond as $menuSecondItem ){
                $secondID       = $menuSecondItem->id;
                $secondSortID   = $menuSecondItem->sort_id;
                $menuNameSecond = $menuSecondItem->menu_name;

                $menuThird = DB::table( 'menu' )
                               ->where( [
                                            'language' => 'EN',
                                            'sitename' => '5',
                                            'status'   => 'enable',
                                            'upper_id' => $secondID,
                                        ] )
                               ->orderBy( 'sort_id', 'asc' )
                               ->get();

                foreach( $menuThird as $menuThirdItem ){

                    $thirdID       = $menuThirdItem->id;
                    $thirdSortID   = $menuThirdItem->sort_id;
                    $menuNameThird = $menuThirdItem->menu_name;

                    array_push( $menuThirdText, [
                        'id'       => $thirdID,
                        'menuName' => $menuNameThird,
                    ] );
                }

                array_push( $menuSecondText, [
                    'id'        => $secondID,
                    'menuName'  => $menuNameSecond,
                    'menuThird' => $menuThirdText,
                ] );

                $menuThirdText = [];
            }

            array_push( $menuText,
                        [ 'id'            => $id,
                          'menuName'      => $menuNameFirst,
                          'menuSecondary' => $menuSecondText, ] );

            $menuSecondText = [];
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

    private function getMenuInContent( $id )
    {
        $menuText       = [];
        $menuFirstText  = [];
        $menuSecondText = [];
        $menuThirdText  = [];

        $menuFirst = DB::table( 'menu' )
                       ->where( [
                                    'language' => 'EN',
                                    'sitename' => '5',
                                    'status'   => 'enable',
                                ] )
                       ->whereNull( 'upper_id' )
                       ->orderBy( 'sort_id', 'asc' )
                       ->get();

        foreach( $menuFirst as $menuFirstItem ){
            $id            = $menuFirstItem->id;
            $sortID        = $menuFirstItem->sort_id;
            $menuNameFirst = $menuFirstItem->menu_name;

            $menuSecond = DB::table( 'menu' )
                            ->where( [
                                         'language' => 'EN',
                                         'sitename' => '5',
                                         'status'   => 'enable',
                                         'upper_id' => $id,
                                     ] )
                            ->orderBy( 'sort_id', 'asc' )
                            ->get();

            foreach( $menuSecond as $menuSecondItem ){
                $secondID       = $menuSecondItem->id;
                $secondSortID   = $menuSecondItem->sort_id;
                $menuNameSecond = $menuSecondItem->menu_name;

                $menuThird = DB::table( 'menu' )
                               ->where( [
                                            'language' => 'EN',
                                            'sitename' => '5',
                                            'status'   => 'enable',
                                            'upper_id' => $secondID,
                                        ] )
                               ->orderBy( 'sort_id', 'asc' )
                               ->get();

                foreach( $menuThird as $menuThirdItem ){

                    $thirdID       = $menuThirdItem->id;
                    $thirdSortID   = $menuThirdItem->sort_id;
                    $menuNameThird = $menuThirdItem->menu_name;

                    array_push( $menuThirdText, [
                        'id'       => $thirdID,
                        'menuName' => $menuNameThird,
                    ] );
                }

                array_push( $menuSecondText, [
                    'id'        => $secondID,
                    'menuName'  => $menuNameSecond,
                    'menuThird' => $menuThirdText,
                ] );

                $menuThirdText = [];
            }

            array_push( $menuText,
                        [ 'id'            => $id,
                          'menuName'      => $menuNameFirst,
                          'menuSecondary' => $menuSecondText, ] );

            $menuSecondText = [];
        }

        return $menuText;
    }
}