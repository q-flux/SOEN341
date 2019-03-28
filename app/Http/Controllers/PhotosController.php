<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;
use App\Tweets;
use App\users;

class PhotosController extends Controller
{
	public function index(){}

	public function create()
	{
		return view('photos.create');
	}

	/**
	*The "store" fucntion does the following in order:
	*Check whether photo exists
	*Get the extension
	*Create a new filename
	*Upload the image
	*Store tweets with photo
	*
	*@param \Illuminate\Http\Request $request
	*@return Illuminate\Http\Response
	*/

	public function store(Request $request)
	{
		$this->validate($request, [
			'photo' => 'image|max:1999'
		]);

		if ($request->file('photo') && $request->input('tweet_text') != null) {

			$wholeFilename = $request->file('photo')->getClientOriginalName();

			$filename = pathinfo($wholeFilename, PATHINFO_FILENAME);

			$extension = $request->file('photo')->getClientOriginalExtension();

			$newfilename = $filename . '_' . time() . '.' . $extension;

			$path = $request->file('photo')->storeAs('public/Photos/', $newfilename);

			$photo = new Photo;
			$photo->user_id = auth()->user()->id;
			$photo->tweet_text = $request->input('tweet_text');
			$photo->photo = $newfilename;
			$photo->save();

			$tweet = new Tweets;
			$tweet->user_id = auth()->user()->id;
			$tweet->tweet_text = $request->input('tweet_text');
			$tweet->photo_id = $photo->id;
			$tweet->like_cnt = 0;
			$tweet->reply_cnt = 0;
			$tweet->photo = $newfilename;

			$tweet->published_at = now();
			$tweet->save();
			return redirect('/home')->with('success', 'Photo Uploaded');
		}

		else
		{
			$this->validate($request, ['tweet_text' => 'required']);
			$this->validate($request, ['photo' => 'required']);
		}
	}

	public function show($id)
	{
		$photo = Photo::find($id);
		return view('photos.showphoto')->with('photo', $photo);
	 }

}
