<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const HTTP_SUCCESS 		    = 200;
    const HTTP_NOCONTENT 		  = 204;
    const HTTP_BADREQUEST 	  = 400;
    const HTTP_UNAUTHORISED   = 401;
    const HTTP_NOTFOUND 		  = 404;
    const HTTP_ERROR 			    = 500;
    const HTTP_NOTIMPLEMENTED = 501;

    const UPLOADS_DIRECTORY = '/docs/uploads/';

    const BACKEND_PAGINATE = 30;
}
