<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;

class SearchController extends Controller
{
    // this method is accepts ajax request of keyword and searches all users that are matches the keyword
    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            if (!empty($request->data)) {
                $users = User::where('name', 'LIKE', '%' . $request->data . "%")->get(); //searching user "like" the keyword

                if ($users) {
                    foreach ($users as $key => $user) {
                        if ($user->id != Auth::user()->id) {
                            $id = $user->id;
                            $output .= '<tr>' . '<td data-userId=' . $id . '> <a class="dropdown-item" href="/searchOther/' . $id . '">'  . $user->name . '</a></td> </tr>';
                        }
                    }
                    return response()->json($output, 200);
                }
            }
        }
    }
}
