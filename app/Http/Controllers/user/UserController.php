<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

use Auth;
use Validator;

class UserController extends Controller
{

    public function getUpload()
    {
        return view('user/upload');
    }

    public function postUpload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|max:10240'
        ]);

        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }

        return redirect('user/upload');

    }
}
