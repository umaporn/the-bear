<?php

namespace config;

/*
|--------------------------------------------------------------------------
| Data table rules
|--------------------------------------------------------------------------
|
| Contains rules for pagination limits and sortby (orderby).
|
| Limit          => Default option value for pagination limit
| Limits         => Option values used for pagination limit select filter
| Sortby         => Default column to orderby
| Direction      => Sortby direction (asc / desc)
| searchFields   => List of searching column names
| fulltextSearch => Search by fulltext index flag ( true / false )
| layout         => Default layout (grid / list)
|
| Additional rules can be added for a particular view where
| the defaults are not suitable.
|
*/

return [
    'default' => [
        'limit'             => 10,
        'limits'            => [ 10, 25, 50, 100 ],
        'limitForFirstPage' => 10,
        'sortby'            => 'id',
        'direction'         => 'asc',
        'searchFields'      => [ 'id' ],
        'fulltextSearch'    => false,
    ],
    'knowledge_base' => [
        'limit'             => 10,
        'limits'            => [ 10, 25, 50, 100 ],
        'limitForFirstPage' => 10,
        'sortby'            => 'id',
        'direction'         => 'asc',
        'searchFields'      => [ 'id', 'title' ],
        'fulltextSearch'    => false,
    ],
    'company' => [
        'limit'             => 10,
        'limits'            => [ 10, 25, 50, 100 ],
        'limitForFirstPage' => 10,
        'sortby'            => 'id',
        'direction'         => 'asc',
        'searchFields'      => [ 'company_name', 'country' ],
        'fulltextSearch'    => false,
    ],
    'content' => [
        'limit'             => 6,
        'limits'            => [ 10, 25, 50, 100 ],
        'limitForFirstPage' => 6,
        'sortby'            => 'id',
        'direction'         => 'asc',
        'searchFields'      => [ 'title'],
        'fulltextSearch'    => false,
    ]
];
