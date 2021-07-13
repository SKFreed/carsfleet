<?php

namespace App\Http\Controllers;

use App\Car;
use App\Park;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param int $parkId
     * @return Application|Factory|View
     */
    public function index(int $parkId)
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
            $parks = Park::find($parkId)->cars()->where('user_id', $userId)->paginate(100);
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
     * @return Application|Factory|View
     */
    public function create(int $idPark)
    {
        $idPar = Park::find($idPark)->id;
        return view('car.create',compact('idPar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request, int $idPark)
    {
        $car = new Car();
        $carId = Park::find($idPark)->id;

        $car->park_id=$carId;
        $userId = Auth::user()->id;
        $car->user_id=$userId;
        $car->number = $request->number;
        $car->driver = $request->driver;
        $car->save();

        return redirect()->route('park.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy(string $idPark,string $park)
    {
        $park = Car::find($park);
        $park->delete();

        return redirect()->route('park.index');
    }
}
