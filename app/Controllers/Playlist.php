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
        $data  = ['list' => $this->musicplaylist->distinct()->FindAll(),
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

    public function playlist($plname)
    {
        $data  = [ 'plist' => $this->musicplaylist->where('playlist', $plname)->first(),
        'list' => $this->musicplaylist->distinct()->FindAll(),
        'songs' => $this->musicplaylist->where('playlist', $plname)->FindAll(),
        ];
        return view('music',$data);
    }

    public function save_p()
    {
        $plname = $this->request->getVar('playlist');
        $file_path = PUBLIC_PATH."\uploads\\".$plname;
        if (!file_exists($file_path)) {
            mkdir($file_path, 0777, false);
            $data  = [ 'list' => $this->musicplaylist->distinct()->FindAll(),
            'm' => '1',
        ];
        return view('music',$data);
        }
        else {
            $data  = [ 'list' => $this->musicplaylist->distinct()->FindAll(),
            'm' => '0',
        ];
        return view('music',$data);
        }
    }
}
