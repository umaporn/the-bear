<?php
/**
 * Travel Page Controller
 */

namespace App\Http\Controllers;

use App\Libraries\ServiceRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Content;
use Illuminate\Support\Arr;

/**
 * Travel Page Controller
 * @package App\Http\Controllers
 */
class TravelController extends Controller
{
    /** @var Content Content model */
    protected $contentModel;

    /**
     * Initialize ContentController class.
     *
     * @param Content $content Users model
     */
    public function __construct( Content $content )
    {
        $this->contentModel = $content;
    }

    /**
     * Display travel page.
     *
     * @return Factory|View Travel page
     */
    public function index( Request $request )
    {
        $contentDetail = $this->contentModel->getHeaderMenu();
        $contentList   = $this->contentModel->getContentList();

        return view( 'travel.index', compact( 'contentDetail', 'contentList' ) );
    }

    /**
     * Display travel page.
     *
     * @return Factory|View Travel page
     */
    public function menu( $menuID, Request $request )
    {
        $contentDetail = $this->contentModel->getHeaderMenu();
        $contentList   = $this->contentModel->getContentMenuList( $menuID, $request );

        if( $request->ajax() ){
            return response()->json( [
                                         'data' => view( 'travel.menu_list', compact( 'contentList' ) )->render(),
                                     ] );
        }

        return view( 'travel.menu', compact( 'contentDetail', 'contentList' ) );
    }

    /**
     * Display travel page.
     *
     * @return Factory|View Travel page
     */
    public function detail( $id )
    {
        $contentDetail = $this->contentModel->getContentDetail( $id );

        $mainImage    = $this->getMainImage( $contentDetail );
        $galleryImage = $this->getGalleryImage( $contentDetail );
        $moreContent  = $this->getMoreContent( $id );

        return view( 'travel.detail', compact( 'contentDetail', 'mainImage', 'moreContent', 'galleryImage' ) );
    }

    private function getMainImage( $contentDetail )
    {
        return ServiceRequest::call( 'GET',
                                     '/assets/' . $contentDetail['data'][0]->main_image,
                                     true, );
    }

    private function getGalleryImage( $contentDetail )
    {

        foreach( $contentDetail['image'] as $image ){
            $transformImage  = ServiceRequest::call( 'GET',
                                                     '/assets/' . $image[0]->image,
                                                     true, );
            $image->newImage = $transformImage;
        }

        return $contentDetail['image'];
    }

    private function getMoreContent( $id )
    {
        return $this->contentModel->getMoreContent( $id );
    }
}
