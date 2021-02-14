<?php

namespace App\Http\Controllers\views\admin;

use Auth;
use App\Models\Session;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $session = Session::whereStatus('pending')->first();
      Setting::updateOrCreate([
        'session_id' => $session->id,
        'stat_image' => $request->image,
      ]);
    }

}
