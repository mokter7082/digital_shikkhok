<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class AnnouncementController extends Controller
{
    public function AnnounceMent()
    {
        return view('pages/announcement.announcement');
    }
}
