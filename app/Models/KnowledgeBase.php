<?php
/**
 * Manage a knowledge base data.
 */

namespace App\Models;

use App\Libraries\Search;
use App\Libraries\ServiceRequest;
use App\Libraries\Utility;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

/**
 * This class handles a knowledge base information model.
 */
class KnowledgeBase extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'knowledge_base';

    /**
     * Get users profile information.
     *
     * @return Users[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getKnowledgeBaseList( Request $request )
    {
        $builder = $this->where( [ 'status' => 'active' ] )
                        ->orderBy( 'id', 'desc' );

        $data = Search::search( $builder, 'knowledge_base', $request );

        return $this->transformKnowledgeContent( $data );
    }

    /**
     * Transform news information.
     *
     * @param LengthAwarePaginator $homeNewsList A list of news
     *
     * @return LengthAwarePaginator Home news list for display
     */
    private function transformKnowledgeContent( LengthAwarePaginator $knowledgeBaseList )
    {

        foreach( $knowledgeBaseList as $list ){

            $image = null;

            if( $list->image_path !== null ){
                $image = ServiceRequest::call(
                    'GET',
                    '/assets/' . $list->image_path,
                    true,
                );
            }
            $list->setAttribute( 'new_image_path', $image );
        }

        return $knowledgeBaseList;
    }

    public function getKnowledgeBaseDetail( $id )
    {
        return $this->where( [ 'id' => $id ] )->get();
    }

}