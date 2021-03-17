<?php

namespace App\Http\Controllers\Wallet;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    public function index()
    {
        $data = Category::all()->groupBy('type');
        
        return response()->json([
            'categories' => $data
        ], 200);
    }
}
