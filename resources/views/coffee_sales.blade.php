<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New ☕️ Sales') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <form action="{{ route('sales.store') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <label for="product">Select Product:</label>
                        <select name="product" id="product">
                                <option value="goldCoffee">Gold coffee</option>
                                <option value="arabicCofffe">Arabic coffee</option>
                        </select>
                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" required>
                        <label for="unit_cost">Unit Cost:</label>
                        <input type="number" id="unit_cost" name="unit_cost" step="0.01" required>
                        <label for="selling_price">Selling Price:</label>
                        <input type="number" id="selling_price" name="selling_price" step="0.01" readonly>
                        <div>
                        <button type="submit" class="btn btn-danger">record sale</button>
                        </div>
                    </div>
                    <!-- Add more form rows as needed -->
                    
                </form>


                <h2>Sales Data</h2>

                    <table id="customers">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Unit Cost</th>
                                <th>Selling Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sales as $sale)
                                <tr>
                                    <td>{{ $sale->product }}</td>
                                    <td>{{ $sale->quantity }}</td>
                                    <td>{{ $sale->unit_cost }}</td>
                                    <td>{{ $sale->selling_price }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const productInput = document.getElementById('product');
        const quantityInput = document.getElementById('quantity');
        const unitCostInput = document.getElementById('unit_cost');
        const sellingPriceInput = document.getElementById('selling_price');

        quantityInput.addEventListener('input', calculateSellingPrice);
        unitCostInput.addEventListener('input', calculateSellingPrice);

        function calculateSellingPrice() {
            const quantity = parseFloat(quantityInput.value);
            const unitCost = parseFloat(unitCostInput.value);

            if (!isNaN(quantity) && !isNaN(unitCost)) {
                const sellingPrice = quantity * unitCost;
                sellingPriceInput.value = sellingPrice.toFixed(2);
            }
        }
    });
</script>


