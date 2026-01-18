<?php

use App\Models\Order;
use Livewire\Volt\Component;

new class extends Component {
    public function with(): array
    {
        return [
            'orders' => Order::with('user')->latest()->get(),
        ];
    }
}; ?>

<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Панель администратора - Все заявки
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($orders->isEmpty())
                        <p class="text-gray-500">Заявок пока нет</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">ФИО</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Телефон</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Адрес</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Тип мебели</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Количество</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Сумма</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Дата и время</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Оплата</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($orders as $order)
                                        <tr>
                                            <td class="px-4 py-4 text-sm">{{ $order->user->fullName() }}</td>
                                            <td class="px-4 py-4 text-sm">{{ $order->user->tel }}</td>
                                            <td class="px-4 py-4 text-sm">{{ $order->user->email }}</td>
                                            <td class="px-4 py-4 text-sm">{{ $order->address }}</td>
                                            <td class="px-4 py-4 text-sm">{{ $order->type }}</td>
                                            <td class="px-4 py-4 text-sm">{{ $order->count }}</td>
                                            <td class="px-4 py-4 text-sm">{{ number_format($order->total, 0, ',', ' ') }} руб.</td>
                                            <td class="px-4 py-4 text-sm">
                                                {{ $order->date->format('d.m.Y') }} {{ $order->time }}
                                            </td>
                                            <td class="px-4 py-4 text-sm">{{ $order->payment }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>