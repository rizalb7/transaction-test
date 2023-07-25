<x-app-layout>
  <x-slot name="header">
      <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{__('New Transaction')}}
        </h2>
        <Link href="{{ route('transaction.create') }}" class="px-4 py-2 bg-indigo-400 hover:bg-indigo-600 text-white rounded-md">
        New Transaction</Link>
      </div>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <x-splade-form :action="route('transaction.store')" class="max-w-md mx-auto p-4 bg-white rounded-md">
        <x-splade-select name="product_id" :options="$products" label="Product" placeholder="Select Product" />
        <x-splade-input name="quantity" type="number" label="Quantity" />
        <x-splade-submit class="mt-4" />
      </x-splade-form>
    </div>
  </div>
</x-app-layout>
