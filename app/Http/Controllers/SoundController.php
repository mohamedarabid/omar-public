<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Sound;
use App\Models\Type;
use Illuminate\Http\Request;
use Vimeo\Vimeo;

class SoundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sounds = Sound::with('category', 'type')->when($request->name, function ($query) use ($request) {
            $query->where('name', 'LIKE', "%$request->name%");
        })->paginate(10);
        return view('dashboard.sound.index', compact('sounds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $types = Type::all();
        return view('dashboard.sound.create', compact('categories', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Sound $sound)
    {
        $data = $request->all();
        $validator = Validator($data, [
            'name' => 'required|string',
            'secound_name' => 'required|string',
            'code' => 'required|string',
            'desc' => 'required|string',
            'image' => 'required|string',
            'url' => 'required|url',
            'duration' => 'required|integer',
            'sound_link' => 'required|url',
            'category_id' => 'required|integer',
            'type_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
        $video = $request->file('sound_link');
        $client = new Vimeo(env('VIMEO_CLIENT'), env('VIMEO_SECRET'));
        $file_name = $video;
        $url = $client->upload($file_name, array(
            "name" => $request->get('name'),
            "description" => $request->get('desc')
        ));

        $data['sound_link'] = $url;
        $isSaved = $sound->create($data);
        return response()->json(['icon' => 'success', 'title' => 'تم الحفظ بنجاح'], $isSaved ? 201 : 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $types = Type::all();
        $sound = Sound::with('category', 'type')->find($id);

        return view('dashboard.sound.edit', compact('categories', 'types', 'sound'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sound $sound)
    {
        $data = $request->all();
        $validator = Validator($data, [
            'name' => 'required|string',
            'secound_name' => 'required|string',
            'code' => 'required|string',
            'desc' => 'required|string',
            'image' => 'required|string',
            'url' => 'required|url',
            'duration' => 'required|integer',
            'sound_link' => 'required|url',
            'category_id' => 'required|integer',
            'type_id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
        $isSaved = $sound->update($data);
        return response()->json(['icon' => 'success', 'title' => 'تم التعديل بنجاح'], $isSaved ? 201 : 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isDeleted = Sound::destroy($id);

        return response()->json(['icon' => 'success', 'title' => 'تم الحذف بنجاح'], $isDeleted ? 200 : 400);
    }
}
