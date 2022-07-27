<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Scroll;
use App\Models\Type;
use Illuminate\Http\Request;

class ScrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $scrolls = Scroll::with('category', 'type')->when($request->name, function ($query) use ($request) {
            $query->where('name', 'LIKE', "%$request->name%");
        })->paginate(10);
        return view('dashboard.scroll.index', compact('scrolls'));
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
        return view('dashboard.scroll.create', compact('categories', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Scroll $scroll)
    {
        $data = $request->all();
        $validator = Validator($request->all(), [
            'name' => 'required',
            'secound_name' => 'required',
            'code' => 'required',
            'desc' => 'required',
            'image' => 'required',
            'url' => 'required',
            'duration' => 'required',
            'file' => 'required',
            'category_id' => 'required',
            'type_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
        if ($request->file('file')) {
            $userImage = $request->file('file');
            $imageName = time() . '_' .  '.' . $userImage->getClientOriginalExtension();
            $userImage->move('files/scroll', $imageName);
            $url = '/files/scroll/' . $imageName;
        }
        $data['file'] = $url;
        $isSaved = $scroll->create($data);
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
        $scroll = Scroll::with('category', 'type')->find($id);

        return view('dashboard.Scroll.edit', compact('categories', 'types', 'scroll'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Scroll $scroll)
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
            'category_id' => 'required|integer',
            'type_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }

        if ($request->file('file')) {
            $userImage = $request->file('file');
            $imageName = time() . '_' .  '.' . $userImage->getClientOriginalExtension();
            $userImage->move('files/scroll', $imageName);
            $url = '/files/scroll/' . $imageName;
            $data['file'] = $url;
        }

        $isSaved = $scroll->update($data);
        return response()->json(['icon' => 'success', 'title' => 'تم الحفظ بنجاح'], $isSaved ? 201 : 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isDeleted = Scroll::destroy($id);

        return response()->json(['icon' => 'success', 'title' => 'تم الحذف بنجاح'], $isDeleted ? 200 : 400);
    }
}
