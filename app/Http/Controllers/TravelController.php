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
use App\Models\WebStory;
use Illuminate\Support\Arr;

/**
 * Travel Page Controller
 * @package App\Http\Controllers
 */
class TravelController extends Controller
{
    /** @var Content Content model */
    protected $contentModel;
    protected $webStoryModel;

    /**
     * Initialize ContentController class.
     *
     * @param Content $content Users model
     */
    public function __construct( Content $content, WebStory $webStory )
    {
        $this->contentModel  = $content;
        $this->webStoryModel = $webStory;
    }

    /**
     * Display travel page.
     *
     * @return Factory|View Travel page
     */
    public function index( Request $request )
    {
        $webStory      = $this->webStoryModel->getWebStory();
        $contentDetail = $this->contentModel->getHeaderMenu();
        $languageList  = $this->contentModel->getLanguageList();
        $contentList   = $this->contentModel->getContentList();

        return view( 'travel.index', compact( 'contentDetail', 'contentList', 'webStory', 'languageList' ) );
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
        $languageList  = $this->contentModel->getLanguageList();

        if( $request->ajax() ){
            return response()->json( [
                                         'data' => view( 'travel.menu_list', compact( 'contentList', 'languageList' ) )->render(),
                                     ] );
        }

        return view( 'travel.menu', compact( 'contentDetail', 'contentList', 'languageList' ) );
    }

    /**
     * Display travel page.
     *
     * @return Factory|View Travel page
     */
    public function tags( $slug, Request $request )
    {
        $contentDetail = $this->contentModel->getHeaderMenu();
        $contentList   = $this->contentModel->getContentTagsList( $slug, $request );
        $languageList  = $this->contentModel->getLanguageList();

        if( $request->ajax() ){
            return response()->json( [
                                         'data' => view( 'travel.tags_list', compact( 'contentList', 'languageList' ) )->render(),
                                     ] );
        }

        return view( 'travel.tags', compact( 'contentDetail', 'contentList', 'slug', 'languageList' ) );
    }

    /**
     * Display travel page.
     *
     * @return Factory|View Travel page
     */
    public function detail( $id )
    {
        $contentDetail = $this->contentModel->getContentDetail( $id );
        $languageList  = $this->contentModel->getLanguageList();

        if($contentDetail === null){
            abort(404);
        }
        $mainImage    = $this->getMainImage( $contentDetail );
        $galleryImage = $this->getGalleryImage( $contentDetail );
        $moreContent  = $this->getMoreContent( $id );

        return view( 'travel.detail', compact( 'contentDetail', 'mainImage', 'moreContent', 'galleryImage', 'languageList' ) );
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

    public function search( Request $request )
    {
        $contentList   = $this->contentModel->getContentSearchList( $request );
        $search        = $request->input( 'search' );
        $languageList  = $this->contentModel->getLanguageList();
        $contentDetail = $this->contentModel->getHeaderMenu();

        if( $request->ajax() ){
            return response()->json( [
                                         'data' => view( 'travel.search_list', compact( 'contentList', 'search', 'languageList' ) )->render(),
                                     ] );
        }

        return view( 'travel.search', compact( 'contentDetail', 'contentList', 'search', 'languageList' ) );

    }
}
