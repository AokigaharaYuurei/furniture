<x-layouts.auth>
    <div class="flex flex-col gap-6">
        <x-auth-header title="Вход в аккаунт" description="Введите логин и пароль для входа" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-6">
            @csrf

            <!-- Login -->
            <flux:input
                name="login"
                label="Логин"
                :value="old('login')"
                type="text"
                required
                autofocus
                placeholder="username"
            />

            <!-- Password -->
            <div class="relative">
                <flux:input
                    name="password"
                    label="Пароль"
                    type="password"
                    required
                    autocomplete="current-password"
                    placeholder="Пароль"
                    viewable
                />

                @if (Route::has('password.request'))
                    <flux:link class="absolute top-0 text-sm end-0" :href="route('password.request')" wire:navigate>
                        Забыли пароль?
                    </flux:link>
                @endif
            </div>

            <!-- Remember Me -->
            <flux:checkbox name="remember" label="Запомнить меня" :checked="old('remember')" />

            <div class="flex items-center justify-end">
                <flux:button variant="primary" type="submit" class="w-full" data-test="login-button">
                    Войти
                </flux:button>
            </div>
        </form>

        @if (Route::has('register'))
            <div class="space-x-1 text-sm text-center rtl:space-x-reverse text-zinc-600 dark:text-zinc-400">
                <span>Нет аккаунта?</span>
                <flux:link :href="route('register')" wire:navigate>Зарегистрироваться</flux:link>
            </div>
        @endif
    </div>
</x-layouts.auth>