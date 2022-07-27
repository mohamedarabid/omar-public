<?php



namespace App\Http\Controllers;



use App\Models\Admin;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;



class UserAuthController extends Controller

{
    public function showLogin($guard)
    {
        return response()->view('dashboard.auth.login', ['guard' => $guard]);
    }


    public function login(Request $request)

    {

        $validator = Validator($request->all(), [
            'email' => 'required|email|string',
            'password' => 'required|string|min:3',
            'remember_me' => 'required|boolean',
            'guard' => 'required|string|in:admin,lawyer'
        ], [
            'email.required' => 'Email is required',
            'email.email' => 'Please enter the correct e-mail',
            'password.required' => 'Password is required',
            'guard.in' => 'Enter the correct password'
        ]);
        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];
        if (!$validator->fails()) {
            if (Auth::guard($request->get('guard'))->attempt($credentials, $request->get('remember_me'))) {
                return response()->json(['icon' => 'success', 'title' => 'Login Successfully'], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => 'Login Faild'], 400);
            }
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], 400);
        }
    }





    public function logout(Request $request)

    {
        Auth::guard()->logout();
        $request->session()->invalidate();
        return redirect()->route('dashboard.login', 'admin');
    }



    public function editPassword()
    {
        return response()->view('dashboard.auth.edit-password');
    }
    
    public function updatePassword(Request $request)
    {
        $validator = Validator($request->all(), [
            'current_password' => 'required|string',
            'new_password' => 'required|string|confirmed',
            'new_password_confirmation' => 'required|string'
        ]);
        if (!$validator->fails()) {
            $admin = Admin::findOrFail(Auth()->guard('admin')->user()->id);
            $admin->password = Hash::make($request->get('new_password'));
            $isSaved = $admin->save();
            return response()->json(['icon' => 'success', 'title' => 'Password update successfully'], $isSaved ? 200 : 400);
        } else {
            return response()->json(['icon' => 'error', 'title' => 'Password update faild'], 400);
        }
    }







    public function editProfile()
    {
        $edit = Admin::findOrFail(Auth::guard('admin')->id());
        return view('dashboard.auth.edit-profile', compact('edit'));
    }



    public function updateProfile(Request $request)
    {
        $validator = Validator($request->all(), [

            // 'first_name' => 'string|min:3|max:35',

            // 'last_name' => 'string|min:3|max:35',

            // 'mobile' => 'numeric',

            // 'email' => 'email|unique:admins,email,',

            // 'birth_date' => 'date',

            // 'gender' => 'string|max:1|in:M,F',

            // 'image' => 'image|max:2048|mimes:png,jpg,jpeg',

        ]);

        if (!$validator->fails()) {

            $admin = Admin::findOrFail(Auth::guard('admin')->id());

            $admin->email = $request->email;


            if ($request->file('image')) {
                $image = $request->file('image');
                $imageName = time() . '_Admin.' . $image->getClientOriginalExtension();
                $image->storeAs('images/admin', $imageName, ['disk' => 'public']);
                $admin->image = $imageName;
            }
            

            // $image = $request->file('image');

            // $imageName = time() . '_Admin.' . $image->getClientOriginalExtension();

            // $image->storeAs('images/admin', $imageName, ['disk' => 'public']);

            // $admin->image = $imageName;



            $isSaved = $admin->save();

            if ($isSaved) {

                $user = $admin->user;

                $user->first_name = $request->first_name;

                $user->last_name = $request->last_name;

                $user->mobile = $request->mobile;

                $user->birth_date = $request->birth_date;

                $user->gender = $request->gender;

                $isSaved = $user->save();

                return ['redirect' => route('admin.dashboard')];

                return response()->json(

                    ['status' => true, 'message' => "Updated Successfully"],
                    200
                );
            }
        } else {

            return response()->json(
                ['status' => false, 'message' => $validator->getMessageBag()->first()],
                400

            );
        }
    }
}
