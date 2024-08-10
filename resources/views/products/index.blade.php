<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 border border-green-300 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Product Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
                @foreach ($products as $product)
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover object-center">
                        <div class="p-4">
                            <h3 class="text-lg font-medium text-gray-900">{{ $product->name }}</h3>
                            <p class="text-gray-500 mt-1">${{ number_format($product->price, 2) }}</p>
                            <p class="text-gray-500 mt-1">Stock: {{ $product->stock }}</p>
                        </div>
                        <div class="border-t border-gray-200">
                            <div class="flex justify-center p-4">
                                <a href="{{ route('products.show', $product->id) }}" class="text-indigo-600 hover:text-indigo-900 px-4 py-2 bg-indigo-100 rounded-full">Buy It</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination Links -->
            <div class="mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
