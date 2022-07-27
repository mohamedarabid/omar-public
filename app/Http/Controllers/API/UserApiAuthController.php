<?php

namespace App\Http\Controllers\API;

use App\Helpers\Messages;
use App\Http\Controllers\ControllersService;
use App\Http\Resources\UserResource;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class UserApiAuthController extends AuthBaseController
{
    public function login(Request $request)
    {
        $roles = [
            'email' => 'required|string|exists:users,email',
            'password' => 'required',
        ];
        if (request()->header('lang') == 'en') {
            $customMessages = [
                'exists' => 'The :attribute field is exists.',
                'required' => 'The :attribute field is required.'
            ];
        } else {
            $customMessages = [
                'email.exists' => '  هذا الاميل غير مسجل مسبقا',
                'password.required' => 'كلمة المرور مطلوبه',
                'email.required' => ' الاميل مطلوبه'
            ];
        }
        $validator = Validator::make($request->all(), $roles, $customMessages);
        if (!$validator->fails()) {
            $user = User::where("email", $request->get('email'))->first();
            if ($user) {
                return $this->generateToken($user, 'LOGGED_IN_SUCCESSFULLY');
            } else {
                return ControllersService::generateProcessResponse(false, 'ERROR_CREDENTIALS');
            }
        } else {
            return ControllersService::generateValidationErrorMessage($validator->errors()->first());
        }
    }

    public function loginWith(Request $request, $service)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
        ]);

        if ($validator->fails()) {
            return ControllersService::generateValidationErrorMessage($validator->errors()->first());
        }
        try {
            $user = Socialite::driver($service)
                ->userFromToken(
                    $request->get('token')
                );
        } catch (Exception $exception) {
            return ControllersService::generateProcessResponse(false, 'ERROR_CREDENTIALS');
        }

        $email = $user->getEmail();

        if (!$email or $service == 'apple') {
            $email = $user->getId() . "@$service.com";
        }

        $newUser = User::where('email', $email)->first();
        if ($newUser) {
            return ControllersService::generateProcessResponse(false, 'ERROR_CREDENTIALS');
        }
        $name = $user->getName();
        $updatedData = [
            'name' => $name,
            'email' => $email,
            'source' => $service
        ];
        $newUser = User::updateOrCreate(
            ['email' => $email],
            $updatedData
        );
        return $this->generateToken($newUser, 'LOGGED_IN_SUCCESSFULLY');
    }
    public function profile(Request $request)
    {
        $userId = Auth::id();
        $user = User::with('country')->find($userId);
        $resonseData =  new UserResource($user);
        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => $resonseData
        ]);
    }
    public function register(Request $request, User $user)
    {
        $roles = [
            'name' => 'required|string|min:3',
            'last_name' => 'required|string|min:3',
            'phone' => 'required|unique:users,phone',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'country_id' => 'required|exists:countries,id',
            'image' => 'required',
        ];
        if (request()->header('lang') == 'en') {
            $customMessages = [
                'unique' => 'The :attribute field is Must be unique.',
                'required' => 'The :attribute field is required.'
            ];
        } else {
            $customMessages = [
                'phone.unique' => 'رقم الهاتف مسجل مسبقا',
                'name.required' => ' :الاسم الاول  مطلوب.',
                'last_name.required' => ' :الاسم العائلة  مطلوب.',
                'last_name.required' => ' :الاسم العائلة  مطلوب.',
                'email.required' => ' :الاميل  مطلوب.',
                'phone.required' => ' :رقم الهويه  مطلوب.',
                'image.required' => ' :الصوره  مطلوب.',
            ];
        }
        $validator = Validator::make($request->all(), $roles, $customMessages);
        if (!$validator->fails()) {
            if ($request->hasFile('image')) {
                $userImage = $request->file('image');
                $imageName = time() . '_' . $request->get('name') . '.' . $userImage->getClientOriginalExtension();
                $userImage->move('images/users', $imageName);
                $user['image'] = '/images/users/' . $imageName;
            }
            $isSaved =  $user->create($request->all());
            if ($isSaved) {
                return $this->generateToken($user, 'REGISTERED_SUCCESSFULLY');

                return ControllersService::generateProcessResponse(true, 'CREATE_SUCCESS');
            } else {
                return ControllersService::generateProcessResponse(false, 'LOGIN_IN_FAILED');
            }
        } else {

            return ControllersService::generateValidationErrorMessage($validator->errors()->first(), 402);
        }
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $userId = Auth::id();
        $roles = [
            'name' => 'required|string|min:3',
            'last_name' => 'required|string|min:3',
            'phone' => 'required|unique:users,phone,' . $userId,
            'email' => 'required|email|unique:users,email,' . $userId,
            'password' => 'required',
            'country_id' => 'required|exists:countries,id',
            'image' => 'required',
        ];
        if (request()->header('lang') == 'en') {
            $customMessages = [
                'unique' => 'The :attribute field is Must be unique.',
                'required' => 'The :attribute field is required.'
            ];
        } else {
            $customMessages = [
                'phone.unique' => 'رقم الهاتف مسجل مسبقا',
                'name.required' => ' :الاسم الاول  مطلوب.',
                'last_name.required' => ' :الاسم العائلة  مطلوب.',
                'last_name.required' => ' :الاسم العائلة  مطلوب.',
                'email.required' => ' :الاميل  مطلوب.',
                'phone.required' => ' :رقم الهويه  مطلوب.',
                'image.required' => ' :الصوره  مطلوب.',
            ];
        }
        $validator = Validator::make($request->all(), $roles, $customMessages);
        if (!$validator->fails()) {
            if ($request->hasFile('image')) {
                $userImage = $request->file('image');
                $imageName = time() . '_' . $request->get('name') . '.' . $userImage->getClientOriginalExtension();
                $userImage->move('images/users', $imageName);
                $user['image'] = '/images/users/' . $imageName;
            }
            $isSaved =  $user->update($request->all());
            if ($isSaved) {
                return ControllersService::generateProcessResponse(true, 'USER_UPDATED_SUCCESS');
            } else {
                return ControllersService::generateProcessResponse(false, 'USER_UPDATED_FAILED');
            }
        } else {

            return ControllersService::generateValidationErrorMessage($validator->errors()->first(), 402);
        }
    }



    public function resetPassword(Request $request)
    {
        $roles = [
            'new_password' => 'required|string',
            'new_password_confirmation' => 'required|string|same:new_password'
        ];
        $validator = Validator::make($request->all(), $roles);
        if (!$validator->fails()) {
            $userId = Auth::id();
            $user =  User::find($userId);
            $user->password = Hash::make($request->get('new_password'));
            $isSaved = $user->save();
            if ($isSaved) {
                return ControllersService::generateProcessResponse(true, 'CREATE_SUCCESS');
            } else {
                return ControllersService::generateProcessResponse(false, 'CREATE_FAILED');
            }
        } else {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }
    private function generateToken($user, $message)
    {
        $tokenResult = $user->createToken('News-User');
        $token = $tokenResult->accessToken;
        $user->setAttribute('token', $token);
        return response()->json([
            'status' => true,
            'message' => Messages::getMessage($message),
            'object' => $user,
        ]);
    }
}
