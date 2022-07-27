<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Type;
use App\Models\Video;
use Illuminate\Http\Request;
use Vimeo\Vimeo;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $videos = Video::with('category', 'type')->when($request->name, function ($query) use ($request) {
            $query->where('name', 'LIKE', "%$request->name%");
        })->paginate(10);
        return view('dashboard.video.index', compact('videos'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response

     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $types = Type::all();
        return view('dashboard.video.create', compact('categories', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Video $video)
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
            'video_link' => 'required|url',
            'category_id' => 'required|integer',
            'type_id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
        $video = $request->file('Video_link');
        $client = new Vimeo(env('VIMEO_CLIENT'), env('VIMEO_SECRET'));
        $file_name = $video;
        $url = $client->upload($file_name, array(
            "name" => $request->get('name'),
            "description" => $request->get('desc')
        ));
        $data['video_link'] = $url;
        $isSaved = $video->create($data);
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
        $video = Video::with('category', 'type')->find($id);

        return view('dashboard.video.edit', compact('category', 'type', 'Video'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
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
            'Video_link' => 'required|url',
            'category_id' => 'required|integer',
            'type_id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
        $isSaved = $video->update($data);
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
        $isDeleted = Video::destroy($id);

        return response()->json(['icon' => 'success', 'title' => 'تم الحذف بنجاح'], $isDeleted ? 200 : 400);
    }
}
