<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\OpportuniteRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\File;

class HomeController extends Controller
{
    protected $opportuniteRepository;
    protected $userRepository;

    public function __construct(OpportuniteRepository $opportuniteRepository, UserRepository $userRepository) {
        $this->opportuniteRepository = $opportuniteRepository;
        $this->userRepository = $userRepository;
    }
    
    public function index()
    {
        $opportunites = $this->opportuniteRepository->get();
        return view('pages/home', compact('opportunites'));
    }
 
    public function profil($email) {
        $user = $this->userRepository->getByEmail($email);
        $photo = $this->photo_profil($user->email);
        return view('pages.profil', compact('user', 'photo'));
    }

    public function edit_profil() {
        $user = Auth::user();
        $photo = $this->photo_profil($user->email);
        return view('pages.edit_profil', compact('user', 'photo'));
    }

    public function update_profil($id, Request $request) {
        $user = Auth::user();

        $request->validate([
            'photo' => 'file|mimes:png,jpg,gif,jpeg|max:5120',
            'cv' => 'file|mimes:csv,txt,doc,docx,xls,pdf|max:2048',
        ]);

        $this->userRepository->update($id, $request->all());

        $ImageModel = new File;

        if($request->hasFile('photo')) {
            
            $fileName = time().'_'.$request->file('photo')->getClientOriginalName();
            $filePath = $request->file('photo')->storeAs("uploads/images/profil/$user->id", $fileName, 'public');
            $ImageModel->libelle = $fileName;
            $ImageModel->file_path = '/storage/' . $filePath;
            $ImageModel->type = 'photo_profil';
            $ImageModel->user_id = $user->id;

            $ImageModel->save();
        }

        if($request->hasFile('cv')) {
            $CvModel = new File;
            
            $fileName = time().'_'.$request->file('cv')->getClientOriginalName();
            $filePath = $request->file('cv')->storeAs("uploads/cv/profil/$user->id", $fileName, 'public');
            $CvModel->libelle = $fileName;
            $CvModel->file_path = '/storage/' . $filePath;
            $CvModel->type = 'cv_profil';
            $CvModel->user_id = $user->id;
            $CvModel->profil_id = $user->id;

            $CvModel->save();
        }

        return redirect("/$user->email")->withStatus('Profil mise à jour');

    }

    
    public function photo_profil($email) {
        
        $user = $this->userRepository->getByEmail($email);
        
        if($user == null){
            return false;
        }
        $file = new File;
        $file = $file->where('user_id', $user->id)->where('type', 'photo_profil')->orderBy('id', 'desc')->first();
        
        if ($file == null) {
            $file = false;
        } else {
            $file = $file->file_path;
        }

        return $file;
    }

}
