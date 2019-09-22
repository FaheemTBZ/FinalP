<?php

namespace App\Http\Controllers;

use App\Picture;
use BigV\ImageCompare;
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
        $pictures = [];

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
            $request->validate([
                'itemPicture' => 'required|image'
            ]);
            $pictureFlag = true;
            $searchUser = $request->file('itemPicture');
            $searchDb = 'item_images';
        } else if( $searchUnit === 'itemCategory' ){
            $request->validate([
                'itemCategory' => 'required'
            ]);
            $searchUser = $request->input('itemCategory');
            $searchDb = 'item_category';
        }

        if ($pictureFlag) {
            $image = new ImageCompare();
            $allPictures = Picture::pluck('item_images');

            foreach ($allPictures as $picture) {
                $pic = explode('|', $picture);
                foreach ($pic as $p) {
                    if ($image->compare($searchUser, 'image/' . $p) < 25) {
                        array_push($pictures, $p);
                    }
                }
            }
        } else {
            $itemData = Picture::where($searchDb, $searchUser)->first();
        }
        

        return view('/search', [
            'itemData' => $itemData,
            'pictures' => $pictures
        ]);
    }
}
