<?php
/**
 * Manage a project information data.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

/**
 * This class handles a project information model.
 */
class ProjectInfo extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'project_info';

    /**
     * Get users profile information.
     *
     * @return Users[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getProjectInformationList()
    {
        return $this->where( [ 'status' => 'active' ] )->get();
    }

    public function getProjectInformationDetail( $id )
    {
        return $this->where( [ 'id' => $id ] )->get();
    }

}