<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

class WebhookController extends BaseController
{
    public function index(Request $request)
    {

        http_response_code(200);
    }
}
