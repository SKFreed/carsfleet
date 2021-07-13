<?php

namespace App\Http\Controllers;

use App\Park;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $parks = Park::paginate(10); // получить первые 10 значений таблицы и вызвать пагинатор
        //$categories = Category::all(); // Получить все значения таблицы
        //return view('start', ['categories' => $categories]);
        return view('park.index', compact('parks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return
     */
    public function create()
    {
        if (Auth::check()) {
            /**
             * После проверки уже можешь получать любое свойство модели
             * пользователя через фасад Auth, например id
             */
            $userId = Auth::user()->id;
            $manager = User::find($userId)->manager;
        }
        if ($manager == 1)
        {
            return view('park.create');
        }
        else
        {
            return view('errorPages.403');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request)
    {
        $park = new Park();
        $park->name = $request->name;
        $park->save();

        return view('welcome');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Park $park)
    {
        $park = Park::find($park->id);
        return view('park.show', compact('park'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Park $park)
    {
        $park = Park::find($park->id);
        return view('park.edit', compact('park'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Park $park)
    {
        {
            $park = Park::find($park->id);
            $park->name = $request->name;

            $park->save();

            return redirect()->route('park.index');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Park $park
     * @return \Illuminate\Http\Response
     */
    public function destroy(Park $park)
    {
        $park = Park::find($park->id);
        $park->delete();

        return redirect()->route('park.index');
    }
}
