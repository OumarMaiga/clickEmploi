<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\OpportuniteRepository;

class HomeController extends Controller
{
    protected $opportuniteRepository;

    public function __construct(OpportuniteRepository $opportuniteRepository) {
        $this->opportuniteRepository = $opportuniteRepository;
    }
    
    public function index()
    {
        $opportunites = $this->opportuniteRepository->get();
        return view('pages/home', compact('opportunites'));
    }
}
