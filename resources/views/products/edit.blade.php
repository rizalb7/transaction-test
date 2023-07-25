<x-app-layout>
  <x-slot name="header">
      <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{__('Edit Product')}}
        </h2>
        <Link href="{{ route('product.create') }}" class="px-4 py-2 bg-indigo-400 hover:bg-indigo-600 text-white rounded-md">
        New Product</Link>
      </div>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <x-splade-form :default="$product" method="PUT" :action="route('product.update', $product->id)" class="max-w-md mx-auto p-4 bg-white rounded-md">
        <x-splade-input name="name" label="Name" />
        <x-splade-input name="price" type="number" label="Price" />
        <x-splade-input name="stock" type="number" label="Stock" />
        <x-splade-textarea name="description" label="Description" autosize />
        <x-splade-submit class="mt-4" />
      </x-splade-form>
    </div>
  </div>
</x-app-layout>
