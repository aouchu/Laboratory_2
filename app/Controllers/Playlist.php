<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Playlist extends BaseController
{
    private $musicplaylist;
    public function __construct()
    {
        $this->musicplaylist = new \App\Models\Music();
    }

    public function index()
    {
        $data  = [ 'starter' => $this->musicplaylist->select('playlist')->first(),
        'list' => $this->musicplaylist->distinct()->FindAll(),
        ];
        return view('music',$data);
    }

    public function search()
    {
        return view('music');
    }

    public function save()
    {

    }

    public function playlist()
    {
        $data  = [ 'playlist' => $this->musicplaylist->distinct()->get('playlist'),
        
        ];
    }
}
