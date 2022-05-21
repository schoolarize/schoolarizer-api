<?php

namespace Schoolarize\Schoolarizer\Http\Controllers\Term;

use Schoolarize\Schoolarizer\Http\Controllers\Controller;

use Schoolarize\Schoolarizer\Http\Requests\StoreTermRequest;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use Schoolarize\Schoolarizer\Models\Session\Session;
use Schoolarize\Schoolarizer\Models\Term\Term;



class TermController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($session_id)
    {
        $terms = Term::where('session_id', $session_id)->get();
        return (request()->expectsJson()) ? response()->json($terms, 200) : 'view';
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
    public function store(StoreTermRequest $request, $session_id)
    {
        $data = $request->validated();

        $term = new Term();
        $term->term = $request->term;
        $term->start_date = $request->start_date;
        $term->end_date = $request->end_date;
        $term->session_id = $session_id;

        $term->save();

        return ($request->expectsJson()) ? response()->json(['message' => 'session term created successfully', 'session' => $term], 200) : 'view';
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
            'term' => 'required|min:3|max:20', Rule::unique('term_or_semester')->ignore($id),
            'start_date' => 'required', Rule::unique('term_or_semester')->ignore($id),
        ]);
        $term = Term::findOrFail($id);

        $term->term = $request->term;
        $term->start_date = $request->start_date;
        $term->end_date = $request->end_date;
        $term->save();

        return ($request->expectsJson()) ? response()->json(['message' => 'Session Term Updated successfully', 'term' => $term], 200) : 'view';
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $term = Term::destroy($id);
        return (request()->expectsJson()) ? response()->json(['message' => 'Term deleted successfully'], 200) : 'view';
    }

}
