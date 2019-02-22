<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class SearchController extends Controller
{

    public function search(Request $request){
        if ($request->ajax()){
            $output = "";
            // $users = User::all(); // this gets everything 
            // $users = User::select('name')->get(); // this gets users column
            $users = User::where('name', 'LIKE', '%'.$request->search."%")->get();

            if ($users){
                foreach($users as $key => $user){
                    $id=$user->id;
                    $output.='<tr>'.'<td data-userId='.$id. '> <a href="{{ route(searchOther)}}">'  .$user->name .'</a></td> </tr>';
                }
                return response()->json($output, 200);  
            }
        } // <a class="nav-link" href="{{ route('login') }}">
    }
}
