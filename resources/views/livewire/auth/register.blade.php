<x-layouts.auth>
    <div class="flex flex-col gap-6">
        <x-auth-header title="Создать аккаунт" description="Введите ваши данные для регистрации" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-6">
            @csrf
            <!-- Фамилия -->
            <flux:input
                name="lastname"
                label="Фамилия"
                :value="old('lastname')"
                type="text"
                required
                autofocus
                placeholder="Иванов"
            />

            <!-- Имя -->
            <flux:input
                name="firstname"
                label="Имя"
                :value="old('firstname')"
                type="text"
                required
                placeholder="Иван"
            />

            <!-- Отчество -->
            <flux:input
                name="middlename"
                label="Отчество"
                :value="old('middlename')"
                type="text"
                required
                placeholder="Иванович"
            />

            <!-- Телефон -->
            <flux:input
                name="tel"
                label="Телефон"
                :value="old('tel')"
                type="tel"
                required
                placeholder="+79999999999"
            />

            <!-- Email Address -->
            <flux:input
                name="email"
                label="Адрес электронной почты"
                :value="old('email')"
                type="email"
                required
                autocomplete="email"
                placeholder="email@example.com"
            />

            <!-- Логин -->
            <flux:input
                name="login"
                label="Логин"
                :value="old('login')"
                type="text"
                required
                placeholder="username"
            />

            <!-- Password -->
            <flux:input
                name="password"
                label="Пароль"
                type="password"
                required
                autocomplete="new-password"
                placeholder="Пароль"
                viewable
            />

            <!-- Confirm Password -->
            <flux:input
                name="password_confirmation"
                label="Подтверждение пароля"
                type="password"
                required
                autocomplete="new-password"
                placeholder="Подтвердите пароль"
                viewable
            />

            <div class="flex items-center justify-end">
                <flux:button type="submit" variant="primary" class="w-full" data-test="register-user-button">
                    Зарегистрироваться
                </flux:button>
            </div>
        </form>

        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
            <span>Уже есть аккаунт?</span>
            <flux:link :href="route('login')" wire:navigate>Войти</flux:link>
        </div>
    </div>
</x-layouts.auth>