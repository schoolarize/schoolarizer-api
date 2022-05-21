<?php

namespace Schoolarize\Schoolarizer\Http\Controllers\Session;

use Schoolarize\Schoolarizer\Http\Controllers\Controller;

use Schoolarize\Schoolarizer\Http\Requests\StoreSessionRequest;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use Schoolarize\Schoolarizer\Models\Session\Session;



class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessions = Session::paginate(4);
        return (request()->expectsJson()) ? response()->json($sessions, 200) : 'view';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSessionRequest $request)
    {
        $data = $request->validated();

        $session = new Session();
        $session->name = $request->name;
        $session->start_date = $request->start_date;
        $session->end_date = $request->end_date;

        $session->save();

        return ($request->expectsJson()) ? response()->json(['message' => 'session created successfully', 'session' => $session], 200) : 'view';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $session = Session::findOrFail($id);
        return  (request()->expectsJson()) ? response()->json($session, 200) : 'view';
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
            'name' => 'required|min:3|max:20', Rule::unique('school_sessions')->ignore($id),
            'start_date' => 'required', Rule::unique('school_sessions')->ignore($id),
        ]);
        $session = Session::findOrFail($id);

        $session->name = $request->name;
        $session->start_date = $request->start_date;
        $session->end_date = $request->end_date;
        $session->save();

        return ($request->expectsJson()) ? response()->json(['message' => 'User updated successfully', 'session' => $session], 200) : 'view';
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $session = Session::destroy($id);
        return (request()->expectsJson()) ? response()->json(['message' => 'Session deleted successfully'], 200) : 'view';
    }

}
