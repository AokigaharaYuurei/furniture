<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        @if(auth()->user()->isAdmin())
            <div class="grid gap-4 md:grid-cols-1">
                <div class="p-6 bg-white rounded-xl border border-neutral-200 dark:border-neutral-700 dark:bg-gray-800">
                    <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">Панель администратора</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">Управление всеми заявками пользователей</p>
                    <a href="{{ route('admin.orders') }}" 
                        class="inline-block px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                        Админ-панель
                    </a>
                </div>
            </div>
        @else
            <div class="grid gap-4 md:grid-cols-2">
                <div class="p-6 bg-white rounded-xl border border-neutral-200 dark:border-neutral-700 dark:bg-gray-800">
                    <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">Мои заявки</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">Просмотр и управление вашими заявками на ремонт</p>
                    <a href="{{ route('orders.index') }}" 
                        class="inline-block px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                        Перейти к заявкам
                    </a>
                </div>

                <div class="p-6 bg-white rounded-xl border border-neutral-200 dark:border-neutral-700 dark:bg-gray-800">
                    <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">Создать заявку</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">Подать новую заявку на ремонт помещения</p>
                    <a href="{{ route('orders.create') }}" 
                        class="inline-block px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                        Создать заявку
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-layouts.app>