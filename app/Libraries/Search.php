<?php
/**
 * Search library
 */

namespace App\Libraries;

use App;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

/**
 * This class handles the values for searching, pagination, and sorting
 * to be used in the database queries and output to the views.
 */
class Search
{
    /**
     * Add module filters.
     *
     * @param    string  $module  Module name
     * @param    Request $request Form request which extends from Request class
     *
     * @return   array                  Module filter list
     */
    private static function addFilters( string $module, Request $request )
    {
        $filterConfiguration = config( 'filter.' . $module ) ? config( 'filter.' . $module ) : config( 'filter.default' );
        $filter              = [];

        foreach( $filterConfiguration as $key => $value ){

            $filter[ $key ] = $request->input( $key ) ? $request->input( $key ) : $value;

        }

        return $filter;
    }

    /**
     * Keep all session inputs.
     *
     * @param     string  $module  Module name
     * @param     Request $request Form request which extends from Request class
     * @param     array   $input   An initial kept input list
     *
     * @return    void
     */
    private static function keepSessionInputs( string $module, Request $request, array $input )
    {
        $input = array_merge( $input, Search::addFilters( $module, $request ) );

        $request->session()->flashInput( $input );
    }

    /**
     * Get search options of a specific module.
     *
     * @param     string  $module  Module name
     * @param     Request $request Form request which extends from Request class
     *
     * @return    array                  An array pair of search options
     */
    private static function getSearchOptions( string $module, Request $request )
    {
        $searchKeys    = [ 'limit', 'limits', 'limitForFirstPage', 'sortby', 'direction', 'searchFields', 'fulltextSearch' ];
        $searchOptions = [];
        foreach( $searchKeys as $key ){

            $moduleConfig = config( 'datatables.' . $module . '.' . $key );

            if( !is_null( $request ) && $request->input( $key ) ){
                $searchOptions[ $key ] = $request->input( $key );
            } else if( !empty( $moduleConfig ) || is_bool( $moduleConfig ) ){
                $searchOptions[ $key ] = config( 'datatables.' . $module . '.' . $key );
            } else {
                $searchOptions[ $key ] = config( 'datatables.default.' . $key );
            }
        }

        if( !in_array( $searchOptions['limit'], $searchOptions['limits'] ) ){
            $searchOptions['limit'] = $searchOptions['limits'][0];
        }

        if( !in_array( $searchOptions['limit'], $searchOptions['limits'] ) ){
            $searchOptions['limit'] = $searchOptions['limits'][0];
        }

        return $searchOptions;
    }

    /**
     * Add search conditions.
     *
     * @param array   $searchOptions Search options
     * @param array   $keywords      All keywords
     * @param string  $matches       Fulltext search keyword
     * @param Builder $builder       Eloquent builder
     */
    private static function addSearchClause( array $searchOptions, array $keywords, string $matches, Builder $builder )
    {
        if( $searchOptions['fulltextSearch'] ){
            $relatedFields = implode( ', ', $searchOptions['searchFields'] );
            $builder->orWhereRaw( "match( $relatedFields ) against( ? in boolean mode )", [ $matches ] );
        } else {
            foreach( $searchOptions['searchFields'] as $field ){
                foreach( $keywords as $value ){
                    $builder->orWhere( $field, 'like', '%' . $value . '%' );
                }
            }
        }
    }

    /**
     * Get a new keyword after cut off risky characters.
     *
     * @param string $keyword Original keyword
     *
     * @return string New keyword
     */
    private static function getNormalKeyword( string $keyword )
    {
        return trim( preg_replace( '@[\+\-\*~%\_\@]@', '', $keyword ) );
    }

    /**
     * Get a new keyword for fulltext search after cut off risky characters.
     *
     * @param string $keyword Original keyword
     *
     * @return string New keyword
     */
    private static function getFulltextKeyword( string $keyword )
    {
        $keyword       = Search::getNormalKeyword( $keyword );
        $phrases       = [];
        $phrasePattern = '@("[^"]+")@';

        if( preg_match_all( $phrasePattern, $keyword, $matches, PREG_PATTERN_ORDER ) ){

            foreach( $matches[1] as $value ){
                array_push( $phrases, $value );
            }

            $keyword = preg_replace( $phrasePattern, '', $keyword );
        }

        $keyword = trim( str_replace( '"', '', $keyword ) );

        if( !empty( $keyword ) ){
            $keywords = preg_split( '/\s+/', $keyword );
            $keyword  = implode( ' ', array_map( function( $value ){
                return $value . '*';
            }, $keywords ) );
        }

        if( count( $phrases ) ){
            $keyword .= ' ' . implode( ' ', $phrases );
        }

        return $keyword;
    }

    /**
     * Search and sort by a form request.
     *
     * @param Builder $builder        Eloquent builder
     * @param string  $module         Module name
     * @param Request $request        Form request which extends from Request class
     * @param array   $orWhereHas     A list of related tables which are searched by keyword
     *                                ( an array pair of related table and related module in datatables configuration
     *                                file )
     *
     * @return    \Illuminate\Pagination\LengthAwarePaginator    Result data
     */
    public static function search( Builder $builder, string $module, Request $request, array $orWhereHas = [] )
    {
        $searchOptions = Search::getSearchOptions( $module, $request );
        $searchInput   = $request->input( 'search' ) ? $request->input( 'search' ) : '';
        $keyword       = Search::getNormalKeyword( $searchInput );
        $page          = $request->input( 'page' ) ? $request->input( 'page' ) : '';

        if( !empty( $keyword ) ){

            $keywords = preg_split( '/\s+/', $keyword );
            $matches  = Search::getFulltextKeyword( $keyword );

            $builder->where( function( $query ) use ( $searchOptions, $keywords, $matches, $orWhereHas ){

                Search::addSearchClause( $searchOptions, $keywords, $matches, $query );

                foreach( $orWhereHas as $relatedTable => $relatedModule ){

                    $relatedConfig = config( 'datatables.' . $relatedModule );

                    if( !isset( $relatedConfig['fulltextSearch'] ) ){
                        $relatedConfig['fulltextSearch'] = $searchOptions['fulltextSearch'];
                    }

                    $query->orWhereHas( $relatedTable, function( $statement ) use ( $relatedConfig, $keywords, $matches ){
                        $statement->where( function( $subStatement ) use ( $relatedConfig, $keywords, $matches ){
                            Search::addSearchClause( $relatedConfig, $keywords, $matches, $subStatement );
                        } );
                    } );
                }

            } );
        }

        $result = $builder
            ->orderBy( $searchOptions['sortby'], $searchOptions['direction'] )
            ->paginate( $searchOptions['limitForFirstPage'] );

        $result->limitValues = $searchOptions['limits'];

        return $result;
    }
}
