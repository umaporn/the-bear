<?php

/**
 * Add a prefix to all resource route names.
 *
 * @param string $prefix Prefix
 *
 * @return array All route names for a resource
 */
function addPrefixResourceRouteName( $prefix )
{
    return [
        'index'   => $prefix . '.index',
        'create'  => $prefix . '.create',
        'store'   => $prefix . '.store',
        'show'    => $prefix . '.show',
        'edit'    => $prefix . '.edit',
        'update'  => $prefix . '.update',
        'destroy' => $prefix . '.destroy',
    ];
}