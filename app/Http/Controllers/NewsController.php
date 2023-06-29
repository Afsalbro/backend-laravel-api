<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NewsController extends Controller
{
    public function getNews(Request $request)
    {
  
        $newsAPIResponse = $this->getNewsFromNewsAPI($request->query);
        $guardianAPIResponse = $this->getNewsFromGuardianAPI($request->query);
        $nyTimesResponse = $this->getNYTimesArchive($request->query);

        return response()->json([
            'newsapi' => $newsAPIResponse,
            'guardianapi' => $guardianAPIResponse,
            'nytimes' => $nyTimesResponse
        ]);
    }


    private function getNewsFromNewsAPI($query)
    {
        // dd($query->get('q'));
        $response = Http::get('https://newsapi.org/v2/everything', [
            'q' => $query->get('q'),
            'from' => '2023-06-24',
            'sortBy' => 'date',
            'apiKey' => '7aea6cc087bf456ab8fe9cc390981b7f'
        ]);
        // dd($response);
        return $response->json();
    }

    private function getNewsFromGuardianAPI($query)
    {
        $response = Http::get('https://content.guardianapis.com/search', [
            'q' => $query->get('q'),
            'from-date' => '2023',
            'api-key' => '6907854c-f8fe-406d-999d-b36c1ad4e435'
        ]);

        return $response->json();
    }

    private function getNYTimesArchive($query)
    {
        $response = Http::get('https://api.nytimes.com/svc/search/v2/articlesearch.json', [
            'q' => $query->get('q'), 
            'api-key' => '5lxKzHOGA8EWCnGVU9SXniB5ArikAsGC'
        ]);
        // dd($response);
        return $response->json();
    }
}
