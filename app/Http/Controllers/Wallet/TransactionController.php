<?php

namespace App\Http\Controllers\Wallet;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{


    /**
     * Show the form for creating a new Transaction.
     *
     * @return Response
     */
    public function index()
    {
        $transactions = Transaction::userTransactions()
            ->get();
        return response()->json(["transactions" => $transactions], 200);

        // return view('wallet.transaction.index')->with(compact('transactions'));
    }

    /**
     * Show the form for creating a new Transaction.
     *
     * @return Response
     */
    public function create()
    {

        $incomeCategories =  Category::where('type', '=', 'income')->get();
        $expanseCategories =  Category::where('type', '=', 'expanse')->get();


        return view('wallet.transaction.create')->with(compact('incomeCategories', 'expanseCategories'));
    }

    /**
     * Store a new transaction.
     *
     * @param  Request  $request
     * @return Response
     */
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'amount' => 'required|numeric|min:1',
            'category_id' => 'exists:categories,id'
        ]);
        if ($request->type == "expanse") {
            $newBalance = 0;
            $oldExpanse = Transaction::where('type', '=', 'expanse')
                ->userTransactions()
                ->sum('amount');


            $oldincome = Transaction::where('type', '=', 'income')
                ->userTransactions()
                ->sum('amount');

            $oldBalance = $oldincome - $oldExpanse;
            $newBalance = $oldBalance - $request->amount;
            Log::info('new balance is: ' . $newBalance);
            $validator->after(function ($validator) use ($newBalance) {
                if ($newBalance < 0) {
                    $validator->errors()->add('amount', 'You do not have enough balance to add this expanse transaction');
                }
            });
        }

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        Log::info('inserted record');
        return Transaction::create([

            'type' =>  $request->type,
            'amount' => $request->amount,
            'category_id' => $request->category_id,


        ]);
    }
}
