<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Dish;
use Validator;

class DishesController extends Controller
{
    public $successStatus = 200;

    public function index() {
        $dishes = Dish::all();
        return response()->json(['dishes' => $dishes->toArray()], $this->successStatus);
    }

    public function getDishesByCategory() {
        $ordenCategory = [
            'Entrantes' => 1,
            'Sopas' => 2,
            'Carnes' => 3,
            'Pescados' => 4,
            'Bebidas' => 5,
            'Postres' => 6,
            'Vinos' => 7,
            'Otros' => 8,
        ];
        $dishes = Dish::orderByRaw("FIELD(category, '" . implode("', '", array_keys($ordenCategory)) . "')")
                      ->orderBy('id')
                      ->get();
        //$dishes = Dish::where('category', $category)->get();
        return response()->json(['dishes' => $dishes->toArray()], $this->successStatus);
    }

    public function getDishesByOneCategory($category) {
        $dishes = Dish::where('category', $category)->get();
        return response()->json(['dishes' => $dishes->toArray()], $this->successStatus);
    }

    public function getAllCategories(){
        $categories = Dish::select('category')->distinct()->get();
        return response()->json(['categories' => $categories->toArray()], $this->successStatus);
    }

    // public function getAssetImages(Request $request)
    // {
    //     // //$imagePath=public_path('images/dishes');
    //     // $images=[];
    //     // if (is_dir($imagePath)) {
    //     //     $files=scandir($imagePath);
    //     //     foreach ($files as $file) {
    //     //         if ($file!=='.' && $file!=='..') {
    //     //             $images[]=$file;
    //     //         }
    //     //     }
    //     // }
    //     // return response()->json(['images' => $images], $this->successStatus);
    //     //--------------
    //     $imagePath=public_path('assets/icons/imgs/dishes');
    //     $images=[];

    //     if (is_dir($imagePath)) {
    //         $files=scandir($imagePath);
            
    //         foreach ($files as $file) {
    //             if ($file !== '.' && $file !== '..') {
    //                 $images[] = $file;
    //             }
    //         }
    //     }
    //     return response()->json(['images' => $images], $this->successStatus);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    
    public function store(Request $request) {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'price' => 'required'
        ]);
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], 401);
        }
        $dish = Dish::create($input);
        return response()->json(['Plato' => $dish->toArray()], $this->successStatus);
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
    
    public function show($id) {
        $dish = Dish::find($id);
        if (is_null($dish)) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        return response()->json(['Plato' => $dish->toArray()], $this->successStatus);
    }

    // public function update(Request $request, $id)
    public function update(Request $request, Dish $dish) {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'price' => 'required'
        ]);
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], 401);
        }
        $dish->name = $input['name'];
        $dish->price = $input['price'];
        $dish->save();
        return response()->json(['Plato' => $dish->toArray()], $this->successStatus);
    }
    
    //public function destroy($id)
    public function destroy(Dish $dish) {
        $dish->delete();
        return response()->json(['Plato' => $dish->toArray()], $this->successStatus);
    }
}
