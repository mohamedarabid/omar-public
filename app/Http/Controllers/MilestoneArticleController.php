<?php

namespace App\Http\Controllers;

use App\Models\Milestone;
use App\Models\MilestoneArticle;
use Illuminate\Http\Request;

class MilestoneArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $MilestoneArticle = MilestoneArticle::with('milestone')->when($request->name, function ($query) use ($request) {
            $query->where('name_ar', 'LIKE', "%$request->name%");
        })->paginate(10);
        return view('dashboard.milestoneArtical.index', compact('MilestoneArticle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $milestones = Milestone::all();
        return view('dashboard.milestoneArtical.create', compact('milestones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, MilestoneArticle $milestoneArticle)
    {
        $data = $request->all();
        $validator = Validator($request->all(), [
            'name' => 'required|string',
            'desc' => 'required|string',
            'image' => 'required',
            'milestone_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }

        $isSaved = $milestoneArticle->create($data);
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
        $milestones = Milestone::all();
        $milestoneArticle = MilestoneArticle::with('milestone')->find($id);

        return view('dashboard.milestoneArtical.create', compact('milestones', 'milestoneArticle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MilestoneArticle $milestoneArticle)
    {
        $data = $request->all();
        $validator = Validator($request->all(), [
            'name' => 'required|string',
            'desc' => 'required|string',
            'image' => 'required',
            'milestone_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }

        $isSaved = $milestoneArticle->update($data);
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
        $isDeleted = Milestone::destroy($id);

        return response()->json(['icon' => 'success', 'title' => 'تم الحذف بنجاح'], $isDeleted ? 200 : 400);
    }
}
