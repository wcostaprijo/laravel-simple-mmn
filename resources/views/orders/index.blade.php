<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Pedidos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                @if(!$isAdmin)
                    <div class="text-right mt-2 mr-2">
                        <x-primary-link-clone-button class="ml-3" href="/orders/new">
                            Cadastrar Pedido
                        </x-primary-link-clone-button>
                    </div>
                @endif

                <div class="p-4">
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                </div>

                <table class="border-collapse table-auto w-full text-sm">
                    <thead class="bg-gray text-white">
                        <tr>
                            <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-3 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                Produto
                            </th>
                            @if($isAdmin)
                                <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-3 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                    Cliente
                                </th>
                            @endif
                            <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-3 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                Valor
                            </th>
                            <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-3 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                Data
                            </th>
                            <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-3 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                Status
                            </th>
                            @if($isAdmin)
                                <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-3 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                    Ações
                                </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @forelse($orders as $order)
                            <tr>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500">
                                    {{ $order->description }}
                                </td>
                                @if($isAdmin)
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500">
                                        {{ $order->user->name }}
                                    </td>
                                @endif
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500">
                                    R$ {{ number_format($order->value, 2, ',', '.') }}
                                </td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500">
                                    {{ $order->created_at->format('d/m/Y H:i:s') }}
                                </td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500">
                                    @if($order->status == 'aprovado')
                                        <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                            Aprovado
                                        </span>
                                    @elseif($order->status == 'cancelado')
                                        <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                                            Cancelado
                                        </span>
                                    @else
                                        <span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">
                                            Em Analise
                                        </span>
                                    @endif
                                </td>
                                @if($isAdmin)
                                    <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-3 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                        @if($order->status === 'analise')
                                            <a href="/orders/status/a/{{$order->id}}" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-3 py-2 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                Aprovar
                                            </a>
                                            <a href="/orders/status/c/{{$order->id}}" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                                Cancelar
                                            </a>
                                        @else
                                            ---
                                        @endif
                                    </th>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="@if($isAdmin) 6 @else 4 @endif" class="text-center border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                    Nenhum pedido foi encontrado.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
