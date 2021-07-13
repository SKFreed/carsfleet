<?php

namespace App\Http\Controllers;
use App\Car;
use App\Park;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
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
    public function index($parkId)
    {
        $idPark = Park::find($parkId)->id;
        $namePark = Park::find($parkId)->name;

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
        $parks = Park::find($parkId)->cars()->get();
        //$parks = Car::where('park_id',$park->id)->paginate(10);  //Неправильно хоть и нормально роботает

        }
        else
        {
            $parks = Park::find($parkId)->cars()->paginate(100);
            //$parks = Car::where('park_id',$parkId && 'user_id', $userId )->paginate(100);
        }

        return view('car.index', compact('parks', 'namePark','idPark'));

       /* $parks = Car::all(); // получить первые 10 значений таблицы и вызвать пагинатор
        //$categories = Category::all(); // Получить все значения таблицы
        //return view('start', ['categories' => $categories]);
        return view('car.index', compact('parks'));*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($idPark)
    {
        $idPar = Park::find($idPark)->id;
        return view('car.create',compact('idPar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request, $idPark)
    {
        $park = new Car();
        $parkId = Park::find($idPark)->id;
       // $UserId = User::find($idPark)->id;

        $park->park_id=$parkId;
        $userId = Auth::user()->id;
        $park->user_id=$userId;
        $park->number = $request->number;
        $park->driver = $request->driver;

        $park->save();

        $park1 = new Car();
        $parkId = Park::find($idPark)->id;
        // $UserId = User::find($idPark)->id;

        $park1->park_id=$parkId;
        $userId = Auth::user()->id;
        $park1->user_id=$userId;
        $park1->number = $request->number1;
        $park1->driver = $request->driver1;

        $park1->save();


        return view('/home');
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $idPark,string $park)
    {
        $park = Car::find($park);
        $park->delete();

        return redirect()->route('park.index');
    }
}