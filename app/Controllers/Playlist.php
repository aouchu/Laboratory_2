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
        //$directories = glob('/uploads/*' , GLOB_ONLYDIR);
        $data  = [
        'list' => glob(PUBLIC_PATH.'/uploads'.'/*' , GLOB_ONLYDIR),
        ];
        return view('music',$data);
    }

    public function playlist($plname, $song)
    {
        $data  = [ 'plist' => $plname,
        'list' => glob(PUBLIC_PATH.'/uploads'.'/*' , GLOB_ONLYDIR),
        'songs' => $this->musicplaylist->where('playlist', $plname)->FindAll(),
        'playing' => $this->musicplaylist->where('musicID', $song)->First(),
        ];
        return view('music',$data);
    }

    public function search(){
        $find = $this->request->getVar('music');
        $data  = [ 
        'list' => glob(PUBLIC_PATH.'/uploads'.'/*' , GLOB_ONLYDIR),
        'search' => $this->musicplaylist->like('title', $find)->FindAll(),
        'setter' => $this->musicplaylist->like('title', $find)->First(),
        ];
        return view('music',$data);
    }

    public function save()
    {
        $id = $this->request->getVar('id');
        $pl = $this->request->getVar('playlist');
        $file = $this->request->getFile('song');
        $file->move(PUBLIC_PATH.'\uploads\\'.$pl.'\\');
        $name = $file->getClientPath();
        $fname = str_replace('.mp3','', $name);
        $path = '/uploads/'.$pl.'/'.$name;
        $data = [
            'playlist' => $pl,
            'music' => $path,
            'title' => $fname,
            ];
        
        $this->musicplaylist->save($data);
        return redirect()->to('/playlist/'.$pl.'/null');
    }

    public function save_p()
    {
        $plname = $this->request->getVar('playlist');
        $file_path = PUBLIC_PATH."\uploads\\".$plname;
        if (!file_exists($file_path)) {
            mkdir($file_path, 0777, false);
            $data  = [ 'plist' => $plname,
            'list' => glob(PUBLIC_PATH.'/uploads'.'/*' , GLOB_ONLYDIR),
            'songs' => $this->musicplaylist->where('playlist', $plname)->FindAll(),
            'm' => '1',
        ];
        return view('music',$data);
        }
        else {
            $data  = [ 'plist' => $plname,
            'list' => glob(PUBLIC_PATH.'/uploads'.'/*' , GLOB_ONLYDIR),
            'songs' => $this->musicplaylist->where('playlist', $plname)->FindAll(),
            'playing' => $this->musicplaylist->where('musicID', $song)->First(),
            'm' => '0',
        ];
        return view('music',$data);
        }

    }

    public function delete($plname, $song){
        $data  = [ 'plist' => $plname,
        'list' => glob(PUBLIC_PATH.'/uploads'.'/*' , GLOB_ONLYDIR),
        'songs' => $this->musicplaylist->where('playlist', $plname)->FindAll(),
        'playing' => $this->musicplaylist->where('musicID', $song)->First(),
        ];
        $finder['music'] = $this->musicplaylist->select('music')->where('musicID',$song)->First();
        $path = PUBLIC_PATH.implode($finder['music']);
        unlink($path);
        $this->musicplaylist->where('musicID', $song)->delete();
        return redirect()->to('/playlist/'.$pl.'/null');
    }

    public function delete_p($plname){
        $data  = [ 'plist' => $plname,
        'list' => glob(PUBLIC_PATH.'/uploads'.'/*' , GLOB_ONLYDIR),
        'songs' => $this->musicplaylist->where('playlist', $plname)->FindAll(),
        ];
        $path = PUBLIC_PATH.'/uploads/'.$plname;
        if (is_dir($path)) { 
            $objects = scandir($path);
            foreach ($objects as $object) { 
              if ($object != "." && $object != "..") { 
                if (is_dir($path. DIRECTORY_SEPARATOR .$object) && !is_link($path."/".$object))
                  rrmdir($path. DIRECTORY_SEPARATOR .$object);
                else
                  unlink($path. DIRECTORY_SEPARATOR .$object); 
              } 
            }
            rmdir($path); 
          }

        $this->musicplaylist->where('playlist', $plname)->delete();
        return redirect()->to('/music');
    }
    
    
}

