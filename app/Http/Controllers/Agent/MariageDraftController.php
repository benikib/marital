<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\MariageDraft;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MariageDraftController extends Controller
{
    

    public function index()
    {
        
        $user = Auth()->user();
        $drafts = MariageDraft::where('user_id', $user->id)->latest()->get();
        return view('agents.drafts.index', compact('drafts'));
    }
}
