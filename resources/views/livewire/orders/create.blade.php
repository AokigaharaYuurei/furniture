<?php

use App\Models\Order;
use Livewire\Volt\Component;

new class extends Component {
    public $address = '';
    public $type = '';
    public $count = 1;
    public $date = '';
    public $time = '';
    public $payment = '';

    public $prices = [
        'табурет' => 500,
        'стул' => 1500,
        'кресло' => 3000,
        'диван' => 10000,
    ];

    public function save()
    {
        $validated = $this->validate([
            'address' => 'required|string|max:255',
            'type' => 'required|in:табурет,стул,кресло,диван',
            'count' => 'required|integer|min:1|max:10',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'payment' => 'required|in:наличными,банковская карта,безналичный расчет',
        ]);

        $total = $this->prices[$validated['type']] * $validated['count'];

        Order::create([
            'address' => $validated['address'],
            'type' => $validated['type'],
            'count' => $validated['count'],
            'date' => $validated['date'],
            'time' => $validated['time'],
            'payment' => $validated['payment'],
            'total' => $total,
            'user_id' => auth()->id(),
        ]);

        $this->reset();
        
        $typeNames = [
            'табурет' => 'табурета',
            'стул' => 'стула', 
            'кресло' => 'кресла',
            'диван' => 'дивана',
        ];
        
        $message = "Ваша заявка принята! Вы выбрали ремонт {$typeNames[$validated['type']]} в количестве {$validated['count']} на общую сумму $total рублей.";
        
        session()->flash('success', $message);
        $this->redirect(route('orders.index'));
    }
}; ?>

<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Создать заявку
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form wire:submit="save" class="space-y-6">
                        <div>
                            <label for="address" class="block text-sm font-medium">Адрес</label>
                            <input type="text" id="address" wire:model="address" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                placeholder="Введите адрес">
                            @error('address') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="type" class="block text-sm font-medium">Тип мебели</label>
                            <select id="type" wire:model="type" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="">Выберите тип</option>
                                <option value="табурет">табурет (500 руб.)</option>
                                <option value="стул">стул (1,500 руб.)</option>
                                <option value="кресло">кресло (3,000 руб.)</option>
                                <option value="диван">диван (10,000 руб.)</option>
                            </select>
                            @error('type') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="count" class="block text-sm font-medium">Количество единиц мебели (от 1 до 10)</label>
                            <input type="number" id="count" wire:model="count" min="1" max="10"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @error('count') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                            
                            @if($type)
                                <p class="mt-1 text-sm text-gray-500">
                                    Цена за единицу: {{ number_format($prices[$type], 0, ',', ' ') }} руб.
                                </p>
                                <p class="mt-1 text-sm font-semibold text-indigo-600">
                                    Итого: {{ number_format($prices[$type] * $count, 0, ',', ' ') }} руб.
                                </p>
                            @endif
                        </div>

                        <div>
                            <label for="date" class="block text-sm font-medium">Дата начала работ</label>
                            <input type="date" id="date" wire:model="date" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @error('date') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="time" class="block text-sm font-medium">Время начала работ</label>
                            <input type="time" id="time" wire:model="time" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @error('time') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="payment" class="block text-sm font-medium">Способ оплаты</label>
                            <select id="payment" wire:model="payment" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="">Выберите способ</option>
                                <option value="наличными">Наличными</option>
                                <option value="банковская карта">Банковская карта</option>
                                <option value="безналичный расчет">Безналичный расчет</option>
                            </select>
                            @error('payment') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex gap-4">
                            <button type="submit" 
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                                Создать заявку
                            </button>
                            <a href="{{ route('orders.index') }}" 
                                class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                                Отмена
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>