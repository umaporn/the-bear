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
use App;

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
            $list->setAttribute( 'title', $this->getLanguageFields( 'title', $list['content'][0]) );
        }
        return $data;
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