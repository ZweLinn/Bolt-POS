<section>
    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" class="text-slate-700 font-semibold" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full border-slate-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-sm" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <x-input-label for="update_password_password" :value="__('New Password')" class="text-slate-700 font-semibold" />
                <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full border-slate-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-sm" autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="update_password_password_confirmation" :value="__('Confirm New Password')" class="text-slate-700 font-semibold" />
                <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full border-slate-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-sm" autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center gap-4 pt-2">
            <x-primary-button class="bg-blue-600 hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 rounded-xl px-6 py-2.5 shadow-lg shadow-blue-200 transition-all border-none">
                <i class="fas fa-key mr-2"></i> {{ __('Update Password') }}
            </x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-emerald-600 font-medium flex items-center"
                >
                    <i class="fas fa-shield-check mr-2"></i> {{ __('Password updated successfully.') }}
                </p>
            @endif
        </div>
    </form>
</section>
