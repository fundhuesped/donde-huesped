<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'panel/importer/*',
        'panel/importer/activePlacesExport',
        'panel/importer/filteredEvaluations',
        'panel/importer/evaluationsExportFilterByService',
        'api/v1/panel/ciudad/clearAllEmtpy',
        'api/v1/panel/provincia/clearAllEmtpy',
        'api/v1/panel/pais/clearAllEmtpy',
        'api/v1/panel/partido/clearAllEmtpy',
    ];
}
