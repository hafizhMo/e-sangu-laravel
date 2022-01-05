<?php

namespace App\Http\Controllers;

use App\Models\Relation;
use Illuminate\Http\Request;

class RelationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $relation = Relation::get()->first();

        if (!empty($relation)) {
            $relation = Relation::get();
            $response = [
                'error' => false,
                'message' => 'Data load successfully',
                'relations' => $relation
            ];
            
        } else {
            $response = [
                'error' => true,
                'message' => 'Data not found',
                'relations' => null
            ];
        }
        
        return response($response);
    }

    public function index_by_wali($id)
    {
        $relation = Relation::where('wali_id', $id)->first();

        if (!empty($relation)) {
            // $relation = Relation::where('wali_id', $id)->get();
            $relation = Relation::where('wali_id', $id)->
            leftJoin('users', 'users.id', '=', 'relations.beban_id')->
            select('relations.id AS rid', 'users.id', 'users.name', 'users.email', 'status', 'created_by')->get();

            $response = [
                'error' => false,
                'message' => 'Data load successfully',
                'relations' => $relation
            ];
            
        } else {
            $response = [
                'error' => true,
                'message' => 'Data not found',
                'relations' => null
            ];
        }
        
        return response($response);
    }

    public function index_by_beban($id)
    {
        $relation = Relation::where('beban_id', $id)->first();

        if (!empty($relation)) {
            // $relation = Relation::where('wali_id', $id)->get();
            $relation = Relation::where('beban_id', $id)->
            leftJoin('users', 'users.id', '=', 'relations.beban_id')->
            select('relations.id AS rid', 'users.id', 'users.name', 'users.email', 'status', 'created_by')->get();

            $response = [
                'error' => false,
                'message' => 'Data load successfully',
                'relations' => $relation
            ];
            
        } else {
            $response = [
                'error' => true,
                'message' => 'Data not found',
                'relations' => null
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
    public function store_by_wali(Request $request)
    {
        $relation = Relation::where('wali_id', $request->wali_id)->
        where('beban_id', $request->beban_id)->first();

        if (!empty($relation)){
            return [
                'error' => true,
                'message' => 'There is already relation with wali_id by ' . $request->wali_id 
                . ' and beban_id by ' . $request->beban_id
            ];
        }

        $relation = new Relation;
        $relation->created_by = $request->wali_id;
        $relation->wali_id = $request->wali_id;
        $relation->beban_id = $request->beban_id;
        $result = $relation->save();

        if (!empty($result)) {
            $response = [
                'error' => false,
                'message' => 'Created successfully!',
            ];
        } else {
            $response = [
                'error' => true,
                'message' => 'Failed to create a new relation!'
            ];
        }

        return response($response);
    }

    public function store_by_beban(Request $request)
    {
        $relation = Relation::where('wali_id', $request->wali_id)->
        where('beban_id', $request->beban_id)->first();

        if (!empty($relation)){
            return [
                'error' => true,
                'message' => 'There is already relation with wali_id by ' . $request->wali_id 
                . ' and beban_id by ' . $request->beban_id
            ];
        }

        $relation = new Relation;
        $relation->created_by = $request->beban_id;
        $relation->wali_id = $request->wali_id;
        $relation->beban_id = $request->beban_id;
        $result = $relation->save();

        if (!empty($result)) {
            $response = [
                'error' => false,
                'message' => 'Created successfully!',
            ];
        } else {
            $response = [
                'error' => true,
                'message' => 'Failed to create a new relation!'
            ];
        }

        return response($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Relation  $relation
     * @return \Illuminate\Http\Response
     */
    public function edit(Relation $relation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Relation  $relation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $relation = Relation::find($request->id);

        if (empty($relation)){
            return [
                'error' => true,
                'message' => 'There is no relation with id ' . $request->id
            ];
        }

        $relation->status = $request->status;
        $result = $relation->save();

        if (!empty($result)) {
            $response = [
                'error' => false,
                'message' => 'Updated successfully!'
            ];
        } else {
            $response = [
                'error' => true,
                'message' => 'Failed to update relation!'
            ];
        }

        return response($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Relation  $relation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $relation = Relation::where('wali_id', $request->wali_id)->
        where('beban_id', $request->beban_id)->get()->first();

        if (empty($relation)) {
            return [
                'error' => true,
                'message' => 'There is no relation wali_id by ' . $request->wali_id 
                . ' and beban_id by ' . $request->beban_id
            ];
        }
        
        $relation = Relation::where('wali_id', $request->wali_id)->
        where('beban_id', $request->beban_id)->delete();

        if (!empty($relation)) {
            $response = [
                'error' => false,
                'message' => 'Deleted successfully!'
            ];
        } else {
            $response = [
                'error' => true,
                'message' => 'Failed to delete relation!'
            ];
        }

        return response($response);
    }
}
