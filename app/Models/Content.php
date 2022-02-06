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
use App;
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

    /**
     * Get EZusers model relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo User model relationship
     */
    public function Sitename()
    {
        return $this->belongsTo( 'App\Models\Sitename', 'sitename' );
    }

    public function getContentDetail( $id )
    {
        $data    = $this->with( [ 'Author', 'Gallery', 'Sitename' ] )->where( [ 'id' => $id, 'status' => 'enable' ] )->get();
        $content = null;

        foreach( $data as $list ){
            $list->setAttribute( 'title', $this->getLanguageFields( 'title', $list ) );
            $list->setAttribute( 'content', $this->getLanguageFields( 'content', $list ) );
            $list->setAttribute( 'description', $this->getLanguageFields( 'description', $list ) );
            $list->setAttribute( 'keyword', $this->getLanguageFields( 'keyword', $list ) );
            $list['Author']->setAttribute( 'longtext', $this->getLanguageFields( 'longtext', $list['Author'] ) );
            $list['Sitename']->setAttribute( 'title', $this->getLanguageFields( 'title', $list['Sitename'] ) );
            $list['Sitename']->setAttribute( 'longtext', $this->getLanguageFields( 'longtext', $list['Sitename'] ) );
            $list['Sitename']->setAttribute( 'vip_title1', $this->getLanguageFields( 'vip_title1', $list['Sitename'] ) );
            $list['Sitename']->setAttribute( 'vip_title2', $this->getLanguageFields( 'vip_title2', $list['Sitename'] ) );
            $list['Sitename']->setAttribute( 'vip_title3', $this->getLanguageFields( 'vip_title3', $list['Sitename'] ) );
            $list['Sitename']->setAttribute( 'vip_longtext', $this->getLanguageFields( 'vip_longtext', $list['Sitename'] ) );
        }

        if( $data->isEmpty() ){
            return $content;
        } else {
            if( isset( $data[0]->Author->image ) ){
                $result = ServiceRequest::call(
                    'GET',
                    '/assets/' . $data[0]->Author->image,
                    true,
                );

                $data[0]->Author->setAttribute( 'new_image', $result );
            }

            if( isset( $data[0]->Sitename->image ) ){
                $result = ServiceRequest::call(
                    'GET',
                    '/assets/' . $data[0]->Sitename->image,
                    true,
                );

                $data[0]->Sitename->setAttribute( 'new_image', $result );
            }

            if( isset( $data[0]->Sitename->vip_image ) ){
                $result = ServiceRequest::call(
                    'GET',
                    '/assets/' . $data[0]->Sitename->vip_image,
                    true,
                );

                $data[0]->Sitename->setAttribute( 'new_vip_image', $result );
            }

            $newContent    = $this->transformContentDetail( $data[0]->content );
            $image         = $this->getGallery( $data );
            $menu          = $this->getMenu();
            $menuIncontent = $this->getMenuInContent( $id );
            $content       = [ 'data' => $data, 'image' => $image, 'menu' => $menu, 'menuInContent' => $menuIncontent, 'newContent' => $newContent ];

            return $content;
        }

    }

    public function getHeaderMenu()
    {
        $menu    = $this->getMenu();
        $content = [ 'menu' => $menu ];

        return $content;
    }

    public function getContentList()
    {
        $data    = $this->where( [ 'sitename' => '5', 'status' => 'enable' ] )->orderBy( 'id', 'desc' )->limit( 6 )->get();
        $newData = $this->transformContent( $data );

        return $newData;
    }

    public function getContentListForSitemap()
    {
        $data = $this->where( [ 'sitename' => '5', 'status' => 'enable' ] )->orderBy( 'id', 'asc' )->get();

        return $data;
    }

    public function getContentMenuList( $menuID, Request $request )
    {
        $builder = $this->with( [ 'Menu' ] )->orderBy( 'id', 'desc' )->where( [ 'menu' => $menuID, 'sitename' => '5', 'status' => 'enable' ] );
        $data    = Search::search( $builder, 'content', $request );
        $newData = $this->transformContent( $data );

        return $newData;
    }

    public function getContentTagsList( $slug, Request $request )
    {
        $builder = $this->with( [ 'Menu' ] )->orderBy( 'id', 'desc' )
                        ->where( 'tags', 'like', "%" . $slug . "%" )
                        ->where( [ 'sitename' => '5', 'status' => 'enable' ] );

        $data    = Search::search( $builder, 'content', $request );
        $newData = $this->transformContent( $data );

        return $newData;
    }

    public function getContentSearchList( Request $request )
    {

        $builder = $this->where( [ 'sitename' => '5', 'status' => 'enable' ] )->orderBy( 'id', 'desc' );
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

                if( isset( $galleryID[0] ) ){
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

        }

        $data = $this->transformImageFromBackend( $data );

        return $data;
    }

    private function transformImageFromBackend( $data )
    {
        $imageStr   = '';
        $components = explode( 'http://desk.thebear.group:8055/assets/', $data );

        /*foreach( $components as $key => $items ){
            if( $key > 0 ){
                $item = substr( $items, 0, 36 );

                if( isset( $item ) ){
                    $result = ServiceRequest::call(
                        'GET',
                        '/assets/' . $item,
                        true,
                );

                    $imageStr = env('SERVICE_OAUTH_BASE_URI') . 'assets/' . $item;
                    $data     = str_replace( 'http://desk.thebear.group:8055/assets/' . $item, $imageStr, $data );
                }

            }

        }*/

        return $data;
    }

    private function getImage( $imageData )
    {
        $imageStrInfo = '';
        foreach( $imageData as $imageItem ){
            $imageStr = '<figure>';
            /*$image    = ServiceRequest::call( 'GET',
                                              '/assets/' . $imageItem->image,
                                              true, );*/
            $imageStr .= '<a href="' . env('SERVICE_OAUTH_BASE_URI') . 'assets/' . $imageItem->image . '"
                               class="gallery-pic" data-fancybox="gallery-units"
                               data-caption="' . $imageItem->description . '"><img src="' . env('SERVICE_OAUTH_BASE_URI') . 'assets/' . $imageItem->image . '"
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

        $string = 'menu_name_'.App::getLocale();

        foreach( $menuFirst as $menuFirstItem ){
            $id            = $menuFirstItem->id;
            $sortID        = $menuFirstItem->sort_id;
            $menuNameFirst = $menuFirstItem->$string;

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
                $menuNameSecond = $menuSecondItem->$string;

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
                    $menuNameThird = $menuThirdItem->$string;

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
        $data = $this->with( [ 'Author' ] )->where( [ 'sitename' => '5', 'status' => 'enable' ] )->inRandomOrder()->whereNotIn( 'id', [ $id ] )->take( 6 )->get();

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
            $list->setAttribute( 'title', $this->getLanguageFields( 'title', $list ) );
        }

        return $data;
    }

    private function getMenuInContent( $id )
    {
        $menuText       = [];
        $menuFirstText  = [];
        $menuSecondText = [];
        $menuThirdText  = [];

        $string = 'menu_name_'.App::getLocale();

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
            $menuNameFirst = $menuFirstItem->$string;

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
                $menuNameSecond = $menuSecondItem->$string;

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
                    $menuNameThird = $menuThirdItem->$string;

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

    public function getLanguageList()
    {
        $language     = [];
        $languageList = DB::table( 'sitename' )
                          ->where( [
                                       'id' => '5',
                                   ] )
                          ->get( 'languages' );

        if( $languageList ){
            $language = $languageList[0]->languages;
            $language = json_decode( $language );
        }

        return $language;

    }

    /**
     * Get data with language field.
     *
     * @param string $field Field name
     * @param Model  $model Model
     *
     * @return string $data Field value
     */
    private function getLanguageFields( string $field, Model $model )
    {
        $languageFields = [ 'en' => $field . '_en', 'th' => $field . '_th', 'de' => $field . '_de' ];
        $defaultField   = $languageFields['en'];
        $chosenField    = $languageFields[ App::getLocale() ];
        $data           = ( trim( $model->$chosenField ) ) ? $model->$chosenField : $model->$defaultField;

        return $data;
    }
}