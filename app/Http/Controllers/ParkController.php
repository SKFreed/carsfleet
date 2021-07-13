<?php

namespace App\Http\Controllers;

use App\Park;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ParkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
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
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $park = new Park();
        $park->name = $request->name;
        $park->address = $request->address;
        $park->schedule = $request->schedule;
        $park->save();

        return redirect()->route('park.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
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
     * @return Application|Factory|View
     */
    public function edit(Park $park)
    {
        $park = Park::find($park->id);
        return view('park.edit', compact('park'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
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
     * @param Park $park
     * @return Response
     */
    public function destroy(Park $park)
    {
        $park = Park::find($park->id);
        $park->delete();

        return redirect()->route('park.index');
    }
}
