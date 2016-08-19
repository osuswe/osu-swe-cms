<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Link;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class LinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $links = Link::paginate(15);

        return view('admin.links.index', compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('admin.links.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, ['id' => 'required', 'link' => 'required', ]);

        Link::create($request->all());

        Session::flash('flash_message', 'Link added!');

        return redirect('admin/links');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function show($id)
    {
        $link = Link::findOrFail($id);

        return view('admin.links.show', compact('link'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function edit($id)
    {
        $link = Link::findOrFail($id);

        return view('admin.links.edit', compact('link'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function update($id, Request $request)
    {
        $this->validate($request, ['id' => 'required', 'link' => 'required', ]);

        $link = Link::findOrFail($id);
        $link->update($request->all());

        Session::flash('flash_message', 'Link updated!');

        return redirect('admin/links');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function destroy($id)
    {
        Link::destroy($id);

        Session::flash('flash_message', 'Link deleted!');

        return redirect('admin/links');
    }
}
