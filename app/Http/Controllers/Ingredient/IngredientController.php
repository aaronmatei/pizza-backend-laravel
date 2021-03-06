<?php

namespace App\Http\Controllers\Ingredient;

use App\Http\Controllers\ApiController;
use App\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingredients = Ingredient::all();
        return $this->showAll($ingredients);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'description' => 'required',           
            'quantity'=>'required',
        ];

        $this->validate($request, $rules);
        $newIngredient = Ingredient::create($request->all());
        return $this->showOne($newIngredient, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ingredient $ingredient)
    {
        return $this->showOne($ingredient);
    }

  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ingredient $ingredient)
    {
        $ingredient->fill($request->only(['name', 'description','quantity']));
        if ($ingredient->isClean()) {
            return $this->errorResponse('You have not changed a single value to update', 422);
        }
        $ingredient->save();
        return $this->showOne($ingredient);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ingredient $ingredient)
    { {
            $ingredient->delete();
            return $this->showOne($ingredient);
        }
    }
}
