<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;

class SaleController extends Controller
{

    public function index()
    {
        $sales = Sale::all();
        return view('coffee_sales', compact('sales'));
    }

    public function store(Request $request)
    {
        // Validate form data
        $validatedData = $request->validate([
            'product' => 'required',
            'quantity' => 'required|integer|min:1',
            'unit_cost' => 'required|numeric|min:0',
            // You can add more validation rules as needed
        ]);

        // Calculate selling price
        $sellingPrice = $request->quantity * $request->unit_cost;

        // Save data to database
        $sale = new Sale();
        $sale->product = $validatedData['product'];
        $sale->quantity = $validatedData['quantity'];
        $sale->unit_cost = $validatedData['unit_cost'];
        $sale->selling_price = $sellingPrice;
        $sale->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Sale added successfully.');
    }
}
