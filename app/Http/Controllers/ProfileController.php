<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Profile;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = Profile::all();
        $user = Auth::user();
        $input['user_id'] = $user->id;
        return view('profile.index')->with('profiles', $profile);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->get();

            if ($profile->count() > 0) {

                return redirect()->route('profile.show', $profile->first()->id);

            }
            else {
                return view('profile.create');
            }
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input = $request->all();


        if ($request->file('image') != null) {
            $path = $request->file('image')->store('public/images');
            $input['image'] = basename($path);
        }

        $user = Auth::user();
        $input['user_id'] = $user->id;
        Profile::create($input);

        return view('profile.show')->with([
            'profile' => $user->profile,
            'user' => $user
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = Profile::find($id);
        return view('profile.show')->with(['profile' => $profile]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile = Profile::find($id);


        return view('profile.edit')->with(['profiles' => $profile]);
     
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $profile = Profile::find($id);
        $data = $request->all();
        if ($request->file('image') != null) {
            $path = $request->file('image')->store('public/images');
            $data['image'] = basename($path);
        }
        $profile->update($data);

        return redirect()->route('profile.show', Auth::user())->with('success', 'profile updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    //
    }

    public function following($id){
        $profile = Profile::find($id);
        return view('profile.following')->with(['profile' => $profile]);

    }
    public function followers($id){
        $profile = Profile::find($id);
        return view('profile.followers')->with(['profile' => $profile]);


    }
}
