<?php

namespace App\Http\Controllers;

use App\Picture;
use Illuminate\Http\Request;

class PicturesController extends Controller
{

    /* 
    *
    *   Store new Item
    *
    */
    public function store(Request $request)
    {

        $pictures = array();

        // Validate
        $request->validate([
            'itemCode' => 'required',
            'itemNumber' => 'required',
            'itemName' => 'required',
            'itemCategory' => 'required',
            'itemPictures' => 'required',
            'itemDescription' => 'required'
        ]);

        // If pictures are uploaded
        if ($files = $request->file('itemPictures')) {
            foreach ($files as $file) {
                $fileName = $file->getClientOriginalName();
                $file->move('image', $fileName);
                $pictures[] = $fileName;
            }
        }

        // Create a row in Picture table with new data
        Picture::create([
            'item_name' => $request->input('itemName'),
            'item_code' => $request->input('itemCode'),
            'item_number' => $request->input('itemNumber'),
            'item_category' => $request->input('itemCategory'),
            'item_description' => $request->input('itemDescription'),
            'item_images' => implode('|', $pictures)
        ]);
        
        // Redirect to homepage
        return redirect('/search');
    }
    
} // end class
