<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class MainController extends BaseController
{
    private $music, $playlist;
    public function __construct(){
        $this->music = new \App\Models\Music();
        $this->playlist = new \App\Models\Playlists();
        $this->playlist_music = new \App\Models\PlaylistMusic();

    }
    
    public function index()
    {
        $data['music'] = $this->music->findAll();
        $data['playlist'] = $this->playlist->findAll();
        return view('index', $data);
    }

    public function upload(){
        
        if ($this->request->getMethod() === 'post' && $this->request->getFile('file')->isValid()) {
            $audioFile = $this->request->getFile('file');
            $originalName = $audioFile->getName();
            $filenameWithoutExtension = pathinfo($originalName, PATHINFO_FILENAME);
            
            $newName = $audioFile->getRandomName();
            // $newName = uniqid("video-", true). '.'.$audioFile;

            // Move the uploaded file to the "uploads" folder
            $uploadDir = './assets/uploads/';
            $audioFile->move($uploadDir, $newName);

            // Save the URL path in the database
            $insertData = [
                'title' => $filenameWithoutExtension,
                'file' => base_url('/assets/uploads/' . $newName),
            ];

            $this->music->insert($insertData);

            return redirect()->to('/');
        }
    }

    public function delete_song($id) {
        $data['file'] = $this->music->select('file')->find($id);
        foreach ($data as $file) {
            $base_url = config('App')->baseURL;
            $path = str_replace($base_url, '', $file['file']);
            $uploadDirectory = WRITEPATH . $path;
        }
        
        if (is_dir($uploadDirectory) && is_writable($uploadDirectory)) {
            // Get a list of files in the directory
            $files = scandir($uploadDirectory);

            // Iterate through the files and delete them
            foreach ($files as $file) {
                // Skip "." and ".." directories and any other non-file entries
                if ($file !== '.' && $file !== '..' && is_file($uploadDirectory . $file)) {
                    unlink($uploadDirectory . $file); // Delete the file
                }
            }
        }
        
        $this->music->delete($id);
        $this->playlist_music->where('music_id', $id)->delete();
        
        return redirect()->to('/');
    }

    public function playlist($id){
        $data['playlistmusic'] = $this->playlist_music->select('music_id')->where('playlist_id', $id)->findAll();
        $data['music'] = $this->music->findAll();
        $data['playlist'] = $this->playlist->find($id);
        
        $playlistMusicIds = array_column($data['playlistmusic'], 'music_id');
        $data['music'] = array_filter($data['music'], function ($music) use ($playlistMusicIds) {
            return in_array($music['music_id'], $playlistMusicIds);});
    
        return view('playlist', $data);
        // echo "<pre>";
        // print_r($data);
    }

    public function create_playlist(){
        $data['music'] = $this->music->findAll();
        return view('create_playlist', $data);
    }

    public function save_playlist(){
        $data = ['name' => $this->request->getVar('playlist_name')];
        $this->playlist->save($data);

        $selected_id = $this->request->getPost('song');
        $playlist_name = $this->request->getVar('playlist_name');
        $playlist_id = $this->playlist->select('playlist_id')->where('name', $playlist_name)->orderBy('playlist_id', 'DESC')->first();
        
        foreach ($selected_id as $val) {
             $this->playlist_music->insert([ 
                'playlist_id' => $playlist_id,
                        'music_id' => $val]);
        }
        
        foreach ($playlist_id as $val) {
            return redirect()->to('/playlist/'.$val);
        }
    }

    public function add_to_playlist($id){
        $data['playlistmusic'] = $this->playlist_music->select('music_id')->where('playlist_id', $id)->findAll();
        $data['music'] = $this->music->findAll();
        $data['playlist'] = $this->playlist->findAll($id);
        // echo "<pre>";
        // print_r($data);
        return view('add_to_playlist', $data);
    }

    public function save_adding($id) {
        $selected_id = $this->request->getPost('song');
        $playlist_id = $this->playlist->select('playlist_id')->find($id);
        $data['playlistmusic'] = $this->playlist_music->select('music_id')->where('playlist_id', $id)->findAll();
        
        foreach ($selected_id as $val) {
            $existing = false;
            if($existing == false){
                foreach ($data['playlistmusic'] as $pm) {
                    if($val == $pm['music_id']){
                        $existing = true;
                    }
                }
            }

            if($existing == false)
             $this->playlist_music->insert([ 
                'playlist_id' => $playlist_id,
                        'music_id' => $val]);
        }

        foreach ($playlist_id as $val) {
                    return redirect()->to('/playlist/'.$val);

        }
    }
    
    public function remove_song($p, $m){
        $this->playlist_music->where('playlist_id', $p)->where('music_id', $m)->delete();
        return redirect()->to('/playlist/'.$p);
    }
    
    public function delete_playlist($id){
        $this->playlist->delete($id);
        $this->playlist_music->where('playlist_id', $id)->delete();
        return redirect()->to('/');
    }

}