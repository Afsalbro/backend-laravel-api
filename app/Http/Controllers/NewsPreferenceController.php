<?php

namespace App\Http\Controllers;

use App\Models\NewsPreference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NewsPreferenceController extends Controller
{
    
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'selected_source' => 'required',
            'news_title' => 'required',
            'news_description' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
    
        $user = Auth::user();
    
        $newsPreference = new NewsPreference([
            'user_id' => $user->id,
            'selected_source' => $request->input('selected_source'),
            'selected_categories' => $request->input('selected_categories'),
            'selected_authors' => $request->input('selected_authors'),
            'news_title' => $request->input('news_title'),
            'news_description' => $request->input('news_description'),
        ]);
    
        $newsPreference->save();
    
        return response()->json(['message' => 'News preference saved successfully'], 201);
    }
    

    public function show()
    {
        $user = Auth::user();

        $newsPreferences = NewsPreference::where('user_id', $user->id)->get();

        return response()->json(['newsPreferences' => $newsPreferences]);
    }
}
