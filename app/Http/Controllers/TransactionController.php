<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = Transaction::get()->first();

        if (!empty($transaction)) {
            $transaction = Transaction::with(['category', 'user'])->get();
            $response = [
                'error' => false,
                'message' => 'Data load successfully',
                'transactions' => $transaction
            ];
            
        } else {
            $response = [
                'error' => true,
                'message' => 'Data not found',
                'transactions' => null
            ];
        }
        
        return response($response);
    }

    public function index_by_user($id)
    {
        $transaction = Transaction::where('user_id', $id)->get()->first();

        if (!empty($transaction)) {
            $transaction = Transaction::with('category')->where('user_id', $id)->get();
            $response = [
                'error' => false,
                'message' => 'Data load successfully',
                'transactions' => $transaction
            ];
            
        } else {
            $response = [
                'error' => true,
                'message' => 'Data not found',
                'transactions' => null
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

        $transaction = new Transaction;
        $transaction->amount = $request->amount;
        $transaction->user_id = $request->user_id;
        $transaction->category_id = $request->category_id;
        $result = $transaction->save();

        if (!empty($result)) {
            $response = [
                'error' => false,
                'message' => 'Created successfully!'
            ];
        } else {
            $response = [
                'error' => true,
                'message' => 'Failed to create a new Transaction!'
            ];
        }

        return response($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $transaction = Transaction::find($request->id);

        if (empty($transaction)){
            return [
                'error' => true,
                'message' => 'There is no Transaction with id ' . $request->id
            ];
        }

        $transaction->amount = $request->amount;
        $transaction->category_id = $request->category_id;
        $result = $transaction->save();

        if (!empty($result)) {
            $response = [
                'error' => false,
                'message' => 'Updated successfully!'
            ];
        } else {
            $response = [
                'error' => true,
                'message' => 'Failed to update Transaction!'
            ];
        }

        return response($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = Transaction::find($id);

        if (empty($transaction)) {
            return [
                'error' => true,
                'message' => 'There is no Transaction id by '.$id
            ];
        }
        
        $transaction = $transaction->delete($id);

        if (!empty($transaction)) {
            $response = [
                'error' => false,
                'message' => 'Deleted successfully!'
            ];
        } else {
            $response = [
                'error' => true,
                'message' => 'Failed to delete Transaction!'
            ];
        }

        return response($response);
    }
}
