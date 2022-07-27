<?php

namespace App\Http\Controllers;

use App\Models\Milestone;
use App\Models\MilestoneCategory;
use App\Models\MilestoneType;
use Illuminate\Http\Request;

class MilestonesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $milestones = Milestone::with('category', 'type')->when($request->name, function ($query) use ($request) {
            $query->where('name_ar', 'LIKE', "%$request->name%");
        })->paginate(10);
        return view('dashboard.milestone.index', compact('milestones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = MilestoneCategory::all();
        $types = MilestoneType::all();
        return view('dashboard.milestone.create', compact('categories', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Milestone $milestone)
    {
        $data = $request->all();
        $validator = Validator($request->all(), [
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'desc_ar' => 'required|string',
            'desc_en' => 'required|string',
            'sound' => 'required|mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav',
            'video' => 'required|mimetypes:video/avi,video/mpeg,video/quicktime|max:102400',
            'long' => ['required', 'required', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'lat' => ['required', 'required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'hight' => 'required|numeric',
            'width' => 'required|numeric',
            'main_image' => 'required',
            'gallery' => 'required',
            'icon_image' => 'required',
            'category_id' => 'required',
            'type_id' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
        if ($request->file('sound')) {
            $userImage = $request->file('sound');
            $imageName = time() . '_' .  '.' . $userImage->getClientOriginalExtension();
            $userImage->move('files/sound', $imageName);
            $soundUrl = '/files/sound/' . $imageName;
        }
        if ($request->file('video')) {
            $userImage = $request->file('video');
            $imageName = time() . '_' .  '.' . $userImage->getClientOriginalExtension();
            $userImage->move('files/video', $imageName);
            $videUrl = '/files/video/' . $imageName;
        }
        $data['video'] = $videUrl;
        $data['sound'] = $soundUrl;
        $isSaved = $milestone->create($data);
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
        $categories = MilestoneCategory::all();
        $types = MilestoneType::all();
        $milestone = Milestone::with('category', 'type')->find($id);
        return view('dashboard.milestone.edit', compact('categories', 'types', 'milestone'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Milestone $milestone)
    {
        $data = $request->all();
        $validator = Validator($request->all(), [
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'desc_ar' => 'required|string',
            'desc_en' => 'required|string',
            'long' => ['required', 'required', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'lat' => ['required', 'required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'hight' => 'required|numeric',
            'width' => 'required|numeric',
            'main_image' => 'required',
            'gallery' => 'required',
            'icon_image' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }

        $isSaved = $milestone->update($data);
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
        $isDeleted = Milestone::destroy($id);

        return response()->json(['icon' => 'success', 'title' => 'تم الحذف بنجاح'], $isDeleted ? 200 : 400);
    }
}
