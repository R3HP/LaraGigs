<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    public function index(Request $request){
        // dd(request(['tag','search']));
        // dd($request->query());
        // dd(Listing::latest()->filter($request->query())->paginate(4));
        return view('listings.index',[
            'listings' => Listing::latest()->filter($request->query())->paginate(4),
        ]);
    }

    public function create(){
        return view('listings.create');
    }

    public function store(Request $request){
        // dd($request);
        $listforms = $request->validate(
            [
                'title' => 'required',
                'company' => ['required',Rule::unique('listings','company')],
                'location' => 'required',
                'website' => 'required',
                'email' => ['required','email'],
                'tags' => 'required',
                'description' => 'required'
            ]
        );

        if($request->hasFile('logo')){
            $pathInStorage = $request->file('logo')->store('logos',['public']);
            // dd($pathInStorage);
            $listforms['logo'] = $pathInStorage;
        }

        $listforms['user_id'] = auth()->id();


        Listing::create($listforms);
        return redirect('/')->with('success', 'Listing created successfully!');
    }

    public function edit(Listing $listing){
        return view('listings.edit',['listing' => $listing]);
    }

    public function update(Request $request,Listing $listing){
        
        $listforms = $request->validate(
            [
                'title' => 'required',
                'company' => 'required',
                'location' => 'required',
                'website' => 'required',
                'email' => ['required','email'],
                'tags' => 'required',
                'description' => 'required'
            ]
        );

        

        if($request->hasFile('logo')){
            $pathInStorage = $request->file('logo')->store('logos',['public']);
            $listforms['logo'] = $pathInStorage;
        }
        // dd($listing->id);
        // dd($listforms);


        $listing->update($listforms);
        return back()->with('success', 'Listing Updated successfully!');
    }

    public function destroy(Request $request,Listing $listing){
        // if($listing->logo){
        //     $x = asset('storage/'.$listing->logo);
        //     dd($x);
        //     $logoFile = file($x);
        //     dd($logoFile);
        // }
        $listing->delete();

        return redirect('/')->with('success', 'Listing Deleted successfully!');
    }

    public function show(Listing $listing){
        return view('listings.show',[
            'listing' => $listing,
        ]);
    }

    public function manage(Request $request){
        //** @var \App\Models\User */
        $user = auth()->user();
        $userListings = $user->listings()->get();
        // dd($user->listings()->get());
        return view('listings.manage',[
            'listings' => $userListings
        ]);
    }

    
}
