<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Type;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $books = Book::with('category', 'type')->when($request->name, function ($query) use ($request) {
            $query->where('name', 'LIKE', "%$request->name%");
        })->paginate(10);
        return view('dashboard.book.index', compact('books'));
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
        return view('dashboard.book.create', compact('categories', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Book $book)
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
            $userImage->move('files/books', $imageName);
            $url = '/files/bookss/' . $imageName;
            $data['file'] = $url;
        }
        $isSaved = $book->create($data);
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
        $book = Book::with('category', 'type')->find($id);

        return view('dashboard.book.edit', compact('categories', 'types', 'book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
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
            'category_id' => 'required',
            'type_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
        if ($request->file('file')) {
            $userImage = $request->file('file');
            $imageName = time() . '_' .  '.' . $userImage->getClientOriginalExtension();
            $userImage->move('files/books', $imageName);
            $url = '/files/bookss/' . $imageName;
            $data['file'] = $url;
        }
        $isSaved = $book->update($data);
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
        $isDeleted = Book::destroy($id);

        return response()->json(['icon' => 'success', 'title' => 'تم الحذف بنجاح'], $isDeleted ? 200 : 400);
    }
}
