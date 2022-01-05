<?php

namespace App\Http\Controllers;

use App\Models\Budgeting;
use Illuminate\Http\Request;

class BudgetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $budget = Budgeting::get()->first();

        if (!empty($budget)) {
            $budget = Budgeting::get();
            $response = [
                'error' => false,
                'message' => 'Data load successfully',
                'budget' => $budget
            ];
            
        } else {
            $response = [
                'error' => true,
                'message' => 'Data not found',
                'budget' => null
            ];
        }
        
        return response($response);
    }

    public function index_user_id($id)
    {
        $budget = Budgeting::where('user_id', $id)->get()->first();

        if (!empty($budget)) {
            $budget = Budgeting::where('user_id', $id)->get();
            $response = [
                'error' => false,
                'message' => 'Data load successfully',
                'budget' => $budget
            ];
            
        } else {
            $response = [
                'error' => true,
                'message' => 'Data not found',
                'budget' => null
            ];
        }
        
        return response($response);
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
    public function store(Request $request)
    {
        $budget = new Budgeting;
        $budget->user_id = $request->user_id;
        $budget->remaining_budget = $request->total_budget;
        $budget->total_expenses = 0;
        $budget->total_budget = $request->total_budget;
        $result = $budget->save();

        if (!empty($result)) {
            $response = [
                'error' => false,
                'message' => 'Created successfully!'
            ];
        } else {
            $response = [
                'error' => true,
                'message' => 'Failed to create a budgeting!'
            ];
        }

        return response($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Budgeting  $budgeting
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $budget = Budgeting::find($id);

        if (!empty($budget)) {
            $response = [
                'error' => false,
                'message' => 'Data load successfully',
                'categories' => $budget
            ];
            
        } else {
            $response = [
                'error' => true,
                'message' => 'Data not found',
                'categories' => null
            ];
        }
        
        return response($response);
    }

    public function show_user_id($id)
    {
        $budget = Budgeting::where('user_id', $id)->latest('created_at')->first();

        if (!empty($budget)) {
            $response = [
                'error' => false,
                'message' => 'Data load successfully',
                'budget' => $budget
            ];
            
        } else {
            $response = [
                'error' => true,
                'message' => 'Data not found',
                'budget' => null
            ];
        }
        
        return response($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Budgeting  $budgeting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $budget = Budgeting::find($request->id);

        if (empty($budget)){
            return [
                'error' => true,
                'message' => 'There is no budget with id ' . $request->id
            ];
        }

        $budget->total_budget = $request->total_budget;
        $budget->remaining_budget = $request->total_budget - $budget->total_expenses; //update remaining budget after update total budget
        $result = $budget->save();

        if (!empty($result)) {
            $response = [
                'error' => false,
                'message' => 'Updated successfully!'
            ];
        } else {
            $response = [
                'error' => true,
                'message' => 'Failed to update budget!'
            ];
        }

        return response($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Budgeting  $budgeting
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $budget = Budgeting::find($id);

        if (empty($budget)) {
            return [
                'error' => true,
                'message' => 'There is no budget id by '.$id
            ];
        }
        
        $budget = $budget->delete($id);

        if (!empty($budget)) {
            $response = [
                'error' => false,
                'message' => 'Deleted successfully!'
            ];
        } else {
            $response = [
                'error' => true,
                'message' => 'Failed to delete budget!'
            ];
        }

        return response($response);
    }
}
