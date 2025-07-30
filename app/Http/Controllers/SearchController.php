<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SearchController extends Controller
{
    public function searchPhotos(Request $request) 
    {
        //CALL API from here
        $apiKey = ''; //API KEY GOES HERE
        $endPoint = 'https://api.unsplash.com/search/photos';

        if(isset($request->heading) && $request->heading != '' && ($request->chk_logo == '' || $request->chk_logo == false)) {

            if(isset($request->favcolor) && $request->favcolor != '' && trim($request->favcolor) != 'All') {
                $res = Http::timeout(1000)->get($endPoint, [
                    'client_id' => $apiKey,
                    'query' => $request->heading,
                    'per_page' => 30,
                    'orientation' => 'squarish',
                    // 'page' => 3,
                    'color' => $request->favcolor,
                ]);
            } else {
                $res = Http::timeout(1000)->get($endPoint, [
                    'client_id' => $apiKey,
                    'query' => $request->heading,
                    'per_page' => 30,
                    'orientation' => 'squarish',
                    // 'page' => 3,
                ]);
            }
            
        } elseif(isset($request->chk_logo) && $request->chk_logo == true) {

            if(isset($request->favcolor) && $request->favcolor != '' && trim($request->favcolor) != 'All') {
                $res = Http::timeout(1000)->get($endPoint, [
                    'client_id' => $apiKey,
                    'query' => 'logo',
                    'per_page' => 30,
                    'orientation' => 'squarish',
                    // 'page' => 3,
                    'color' => $request->favcolor,
                ]);
            } else {
                $res = Http::timeout(1000)->get($endPoint, [
                    'client_id' => $apiKey,
                    'query' => 'logo',
                    'per_page' => 30,
                    'orientation' => 'squarish',
                    // 'page' => 3,
                ]);
            }
            

        } else {
            return response()->json([
                'error' => 'Validation error, Please give any search parameter.'
            ], 422);
        }    

        // return $res['results'];

        return $res;

    }
}
