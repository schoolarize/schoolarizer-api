<?php

namespace Schoolarize\Schoolarizer\Http\Controllers\User;


use Schoolarize\Schoolarizer\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;

use Illuminate\Validation\Rule;


class ActivityLogController extends Controller
{
    /**
     * Display a listing of the users activlity logs.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $logs = User::findOrFail($id)->activityLogs()->orderBy('created_at', 'desc')->paginate(10);
        return (request()->expectsJson()) ? response()->json($logs, 200) : 'view';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with(['roles', 'activityLogs'])->findOrFail($id);
        return  (request()->expectsJson()) ? response()->json($user, 200) : 'view';
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
        $data = $request->validate([
            'name' => 'required|min:3|max:15',
            'email' => 'required|email', Rule::unique('users')->ignore($id),
        ]);
        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();

        return ($request->expectsJson()) ? response()->json(['message' => 'User updated successfully', 'user' => $user], 200) : 'view';

    }

    public function updateField(Request $request, $field, $id)
    {
        switch ($field) {
            case 'email':
                $request->validate(['email' => 'required|email', Rule::unique('users')->ignore($id),]);
                $user = User::findOrFail($id);
                $user->email = $request->email;
                $user->save();
                return ($request->expectsJson()) ? response()->json(['message' => 'User Email updated successfully', 'user' => $user], 200) : 'view';
                break;

            case 'name':
                $request->validate([
                    'name' => 'required|min:3|max:15',
                ]);
                $user = User::findOrFail($id);
                $user->name = $request->name;
                $user->save();
                return ($request->expectsJson()) ? response()->json(['message' => 'User NAme updated successfully', 'user' => $user], 200) : 'view';
                break;

            case 'password':
                $request->validate([
                    'password' => 'required|min:3|max:20',
                ]);
                $user = User::findOrFail($id);
                $user->password = bcrypt($request->password);
                $user->save();
                return ($request->expectsJson()) ? response()->json(['message' => 'User password updated successfully', 'user' => $user], 200) : 'view';
                break;

            default:
                abort(404, 'Unknown field');
                break;
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
        $user = User::destroy($id);
        return (request()->expectsJson()) ? response()->json(['message' => 'User deleted successfully'], 200) : 'view';
    }
}
