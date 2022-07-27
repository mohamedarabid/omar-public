<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;





class RoleController extends Controller

{
    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {
        // if (ControllersService::checkPermission('index-role', 'admin')) {
        $page_title = 'Role';
        $page_description = '';
        $roles = Role::withCount('permissions')->paginate(10);
        return response()->view('dashboard.spatie.role.index', compact('roles', 'page_title', 'page_description'));
        // } else {
        //     return response()->view('error-6');
        // }

    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()
    {
        //

        // if (ControllersService::checkPermission('create-role', 'admin')) {
        return response()->view('dashboard.spatie.role.create');
        // } else {
        //     return response()->view('error-6');
        // }
    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {

        $validator = Validator($request->all(), [
            'name' => 'required|string|max:100',
            'guard_name' => 'required|string|in:admin',

        ]);


        if (!$validator->fails()) {
            $role = new Role();
            $role->name = $request->get('name');
            $role->guard_name = $request->get('guard_name');

            $isSaved = $role->save();
            return ['redirect' => route('roles.index')];
            return response()->json(['icon' => 'success', 'title' => 'role created successfully'], $isSaved ? 201 : 400);

        } else {

            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);

        }

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

        //
        // if (ControllersService::checkPermission('edit-role', 'admin')) {

        $role = Role::findById($id);

        return response()->view('dashboard.spatie.role.edit', compact('role'));
        // } else {
        //     return response()->view('error-6');
        // }

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

        //
        $validator = Validator($request->all(), [
            'name' => 'required|string|max:100',
            'guard_name' => 'required|string|in:adminوlawyer',

        ]);



        if (!$validator->fails()) {
            $role = Role::findById($id);
            $role->name = $request->get('name');
            $role->guard_name = $request->get('guard_name');

            $isSaved = $role->save();

            return response()->json(['icon' => 'success', 'title' => 'role updated successfully'], $isSaved ? 200 : 400);

        } else {

            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);

        }

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        // if (ControllersService::checkPermission('delete-role', 'admin')) {

        $isDeleted = Role::destroy($id);

        return response()->json(['icon' => 'success', 'title' => 'تم حذف الصلاحية'], $isDeleted ? 200 : 400);
        // } else {
        //     return response()->view('error-6');
        // }

    }

}

