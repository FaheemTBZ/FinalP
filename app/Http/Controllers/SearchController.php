<?php

namespace App\Http\Controllers;

use App\Picture;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function index()
    {
        return view('search');
    }

    /* 
    *
    *   Find User Data
    *
    */

    public function search(Request $request)
    {
        $searchUnit = $request->input('itemUnit');
        $searchUser = null;
        $searchDb   = null;
        $pictureFlag = false;
        $itemData = null;
        $allPictures = [];
        $pictures = [];
        $dataArray = [];

        if ($searchUnit === 'itemCode') {
            $request->validate([
                'itemCode' => 'required'
            ]);
            $searchUser = $request->input('itemCode');
            $searchDb = 'item_code';
        } else if ($searchUnit === 'itemName') {
            $request->validate([
                'itemName' => 'required'
            ]);
            $searchUser = $request->input('itemName');
            $searchDb = 'item_name';
        } else if ($searchUnit === 'itemPicture') {
            $pictureFlag = true;
            $searchDb = 'item_images';
        } else if ($searchUnit === 'itemCategory') {
            $request->validate([
                'itemCategory' => 'required'
            ]);
            $searchUser = $request->input('itemCategory');
            $searchDb = 'item_category';
        }

        if ($pictureFlag) {
            $find = ['"', '[', ']'];
            $allPictures = explode('|', Picture::pluck('item_images'));
            $allData = Picture::select('item_images', 'item_category')->get()->all();

            foreach ($allPictures as $pic) {
                array_push($pictures, str_replace($find, '', $pic));
            }

            for ($i = 0; $i < count($allData); $i++) {
                $images = $allData[$i]['item_images'];
                $category = $allData[$i]['item_category'];
                if (strpos($images, '|') !== false) {
                    $images = explode('|', $images);
                } else { 
                    
                }
                print_r($images);
            }
        } else {
            $itemData = Picture::where($searchDb, $searchUser)->first();
        }

        dd($allData);

        return view('/search', [
            'itemData' => $itemData,
            'pictures' => $pictures
        ]);
    }
}
