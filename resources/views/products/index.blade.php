<x-app-layout>
  <x-slot name="header">
      <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{__('Products')}}
        </h2>
        <Link href="{{ route('product.create') }}" class="px-4 py-2 bg-indigo-400 hover:bg-indigo-600 text-white rounded-md">
        New Product</Link>
      </div>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <x-splade-table :for="$products">
        @cell('action', $product)
        <Link href="{{ route('product.edit', $product->id) }}" class="text-blue-600 hover:text-blue-400 font-semibold">Edit</Link>
        &nbsp;|&nbsp;
        <Link class="text-red-600 hover:text-red-400 font-semibold"
          confirm="Delete Product..."
          confirm-text="Are you sure?"
          confirm-button="Yes"
          cancel-button="Cancel"
          href="{{ route('product.destroy', $product->id) }}" method="DELETE" preserve-scroll>
          Delete
        </Link>
        @endcell
      </x-splade-table>
    </div>
  </div>
</x-app-layout>
