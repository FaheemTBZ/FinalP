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
        $categoryFlag = false;
        $otherFlag = false;
        $itemData = null;
        $allPictures = [];
        $allData = null;
        $allCat = null;

        if ($searchUnit === 'itemCode') {
            $this->validate($request, [
                'itemCode' => 'required'
            ]);
            $searchUser = $request->input('itemCode');
            $searchDb = 'item_code';
            $otherFlag = true;
        } else if ($searchUnit === 'itemName') {
            $request->validate([
                'itemName' => 'required'
            ]);
            $searchUser = $request->input('itemName');
            $searchDb = 'item_name';
            $otherFlag = true;
        } else if ($searchUnit === 'itemPicture') {
            $pictureFlag = true;
            $searchDb = 'item_images';
        } else if ($searchUnit === 'itemCategory') {
            $request->validate([
                'itemCategory' => 'required'
            ]);
            $categoryFlag = true;
            $searchUser = $request->input('itemCategory');
            $searchDb = 'item_category';
        }

        if ($pictureFlag) {
            $allData = Picture::select('item_images', 'item_category')->get()->all();
            $maxLength = count($allData);

            for ($i = 0; $i < $maxLength; $i++) {

                $images = $allData[$i]['item_images'];
                $category = $allData[$i]['item_category'];

                if (strpos($images, '|') !== false) {
                    $images = explode('|', $images);
                    foreach ($images as $image) {
                        $arr = array(
                            'category' => $category,
                            'pic' => $image
                        );
                        array_push($allPictures, $arr);
                    }
                } else {
                    $arr = array(
                        'category' => $category,
                        'pic' => $images
                    );
                    array_push($allPictures, $arr);
                }
            }
        }
        if ($categoryFlag) {
            $allCat = Picture::where('item_category', $searchUser)->get()->all();
        }
        if ($otherFlag) {
            $itemData = Picture::where($searchDb, $searchUser)->first();
        }

        //dd($allData);

        return view('/search', [
            'itemData' => $itemData,
            'pictures' => $allPictures,
            'allCategories' => $allCat
        ]);
    }

    public function show(Request $request)
    {
        $this->validate($request, [
            'picItemCategory' => 'required'
        ]);

        $allCat = Picture::where('item_category', $request->input('picItemCategory'))->get()->all();

        return view('/search', [
            'allCategories' => $allCat
        ]);
    }
}
