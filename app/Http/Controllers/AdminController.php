<?php



namespace App\Http\Controllers;



use App\Models\Admin;
use App\Models\ModelHasRole;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Role;




class AdminController extends Controller

{

    /**
     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */
    public function index(Request $request, Admin $admins)

    {

        //
        // if (ControllersService::checkPermission('index-admin', 'admin')) {

        $page_title = 'Admins';
        $page_description = '';


        $role = Role::where('name', 'Admin')->first();
        if ($role != null) {
            $modelHasRoles = ModelHasRole::where('role_id', $role->id)->get();

            // $admins = Admin::where('id', '!=', Auth::user()->id);
            foreach ($modelHasRoles as $modelHasRole) {
                if (Auth::user()->id == $modelHasRole->model_id) {
                    if ($request->get('search')) {
                        $admins = Admin::where('email', 'like', '%' . $request->search . '%');
                    }
                    if ($request->get('Status') != '') {
                        $admins = Admin::where('status', $request->get('Status'));
                    }
                } else {
                    $admins = Admin::where('id', '!=', Auth::user()->id);
                    if ($request->get('search')) {
                        $admins = $admins->where('email', 'like', '%' . $request->search . '%');
                    }
                    if ($request->get('Status') != '') {
                        $admins = $admins->where('status', $request->get('Status'));
                    }
                }
            }
        }

        $admins = $admins->paginate(10);
        return response()->view('dashboard.admins.index', compact('admins', 'page_title', 'page_description'));
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

        // if (ControllersService::checkPermission('create-admin', 'admin')) {

        $roles = Role::where('guard_name', 'admin')->get();

        return response()->view('dashboard.admins.create', compact('roles'));

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

        //


        $validator = Validator($request->all(), [

            'role_id' => 'required|numeric|exists:roles,id',
            'first_name' => 'required|string|min:3|max:35',
            'last_name' => 'required|string|min:3|max:35',
            'mobile' => 'required|numeric',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string',
            'image' => 'required|image|max:2048|mimes:png,jpg,jpeg',

        ]);



        if (!$validator->fails()) {

            $admin = new Admin();
            $admin->email = $request->get('email');
            $admin->password = Hash::make($request->get('password'));
            $admin->status = $request->get('status');
            $admin->first_name = $request->get('first_name');
            $admin->last_name = $request->get('last_name');
            $admin->mobile = $request->get('mobile');

            if (request()->hasFile('image')) {
                $image = $request->file('image');;
                $imageName = time() . 'image.' . $image->getClientOriginalExtension();
                $image->move('images/admin', $imageName);
                $admin->image = $imageName;
            }
            $isSaved = $admin->save();
            if ($isSaved) {
                $role = Role::where('id', $request->role_id)->first();
                $admin->assignRole($role->id);
                return ['redirect' => route('admins.index')];
                return response()->json(['icon' => 'success', 'title' => 'admin created successfully'], $isSaved ? 201 : 400);
            } else {

                return response()->json(['message' => "Failed to save"], 400);
            }
        } else {

            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }



    /**

     * Display the specified resource.

     *

     * @param  \App\Models\Admin  $admin

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {

        //




    }



    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Models\Admin  $admin

     * @return \Illuminate\Http\Response

     */

    public function edit($id)
    {
        //
        // if (ControllersService::checkPermission('edit-admin', 'admin')) {
        $admin = Admin::findOrFail($id);
        $roles = Role::where('guard_name', 'admin')->get();
        $roleModel =  ModelHasRole::where('model_id', $id)->where('model_type', 'App\Models\Admin')->first();
        return response()->view('dashboard.admins.edit', compact('admin', 'roles', 'roleModel'));
        // } else {
        //     return response()->view('error-6');
        // }
    }



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\Models\Admin  $admin

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, $id)

    {

        //
        $validator = Validator($request->all(), [

            'first_name' => 'string|min:3|max:35',

            'last_name' => 'string|min:3|max:35',

            'mobile' => 'numeric',

            // 'email' => 'email|unique:admins,email',

            'password' => 'string',

            'birth_date' => 'date',

            'gender' => 'string|max:1|in:M,F',

            // 'image' => 'required|image|max:2048|mimes:png,jpg,jpeg',

        ]);
        if (!$validator->fails()) {

            $admin =  Admin::find($id);
            $admin->email = $request->get('email');
            $admin->password = Hash::make($request->get('password'));
            $admin->status = $request->get('status');
            $admin->first_name = $request->get('first_name');
            $admin->last_name = $request->get('last_name');
            $admin->mobile = $request->get('mobile');
            if (request()->hasFile('image')) {
                $image = $request->file('image');;
                $imageName = time() . 'image.' . $image->getClientOriginalExtension();
                $image->move('images/admin', $imageName);
                $admin->image = $imageName;
            }
            $isSaved = $admin->save();
            if ($isSaved) {
                $role = Role::find($request->get('role_id'));
                $roleModel =  ModelHasRole::where('model_id', $id)->where('model_type', 'App\Models\Admin')->first();
                $admin->removeRole($roleModel->role_id);
                $admin->assignRole($role->id);
                return ['redirect' => route('admins.index')];
                return response()->json(['icon' => 'success', 'title' => 'admin updated successfully'], $isSaved ? 201 : 400);
            } else {

                return response()->json(['message' => "Failed to save"], 400);
            }
        } else {

            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Models\Admin  $admin

     * @return \Illuminate\Http\Response

     */

    public function destroy(Admin $admin)

    {

        if (ControllersService::checkPermission('delete-admin', 'admin')) {

            if ($admin->id == Auth::id()) {
                return redirect()->route('admins.index')
                    ->withErrors(trans('cannot delete yourself'));
            } else {
                $admin->user()->delete();
                $isDeleted = $admin->delete();
                return response()->json(['icon' => 'success', 'title' => 'Admin Deleted successfully'], $isDeleted ? 200 : 400);
            }
        } else {
            return response()->view('error-6');
        }
    }

    public function destroyAll(Request $request, Admin $admin)

    {


        // if (ControllersService::checkPermission('delete-admin', 'admin')) {

        if ($admin->id == Auth::id()) {
            return redirect()->route('admins.index')
                ->withErrors(trans('cannot delete yourself'));
        } else {
            $ids = $request->ids;
            $admin->whereIn('id', explode(",", $ids))->delete();
            return response()->json(['success' => "Admin Deleted successfully."]);
        }
        // } else {
        //     return response()->view('error-6');
        // }
    }

    public function deacitveAll(Request $request, Admin $admin)

    {


        // if (ControllersService::checkPermission('delete-admin', 'admin')) {


        $ids = $request->ids;
        $admins = $admin->whereIn('id', explode(",", $ids))->get();
        foreach ($admins as $admin) {
            $admin->status = 'deactive';
            $admin->save();
        }
        return response()->json(['success' => "Admin Dective successfully."]);

        // } else {
        //     return response()->view('error-6');
        // }
    }
    public function activeAll(Request $request, Admin $admin)

    {


        // if (ControllersService::checkPermission('delete-admin', 'admin')) {


        $ids = $request->ids;
        $admins = $admin->whereIn('id', explode(",", $ids))->get();
        foreach ($admins as $admin) {
            $admin->status = 'active';
            $admin->save();
        }
        return response()->json(['success' => "Admin Active successfully."]);

        // } else {
        //     return response()->view('error-6');
        // }
    }


    public function editPassword($id)

    {

        $admin = Admin::findOrFail($id);

        return response()->view('dashboard.admins.edit-password', compact('id', 'admin'));
    }


    public function updatePassword(Request $request, $id)

    {

        $validator = Validator($request->all(), []);


        if (!$validator->fails()) {

            $admin = Admin::find($id);

            $admin->password = Hash::make($request->get('password'));

            $isSaved = $admin->save();

            if ($isSaved) {
                return ['redirect' => route('admins.index')];

                return response()->json(['icon' => 'success', 'title' => 'password updated successfully'], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => 'password updated failed'], 400);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }
}
