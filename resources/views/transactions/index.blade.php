<x-app-layout>
  <x-slot name="header">
      <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{__('Transactions')}}
        </h2>
        <Link href="{{ route('transaction.create') }}" class="px-4 py-2 bg-indigo-400 hover:bg-indigo-600 text-white rounded-md">
        New Transaction</Link>
      </div>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <x-splade-table :for="$transactions">
      </x-splade-table>
    </div>
  </div>
</x-app-layout>
