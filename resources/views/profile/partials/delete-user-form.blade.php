<section class="space-y-6">
    <header>
        <p class="text-sm text-slate-600 leading-relaxed">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-red-500 hover:bg-red-600 active:bg-red-700 rounded-xl px-6 py-2.5 shadow-lg shadow-red-100 transition-all border-none"
    >
        <i class="fas fa-user-times mr-2"></i> {{ __('Delete Account') }}
    </x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8">
            @csrf
            @method('delete')

            <h2 class="text-xl font-bold text-slate-900 flex items-center">
                <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-3 text-sm text-slate-600 leading-relaxed">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Confirm Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full border-slate-300 focus:border-red-500 focus:ring-red-500 rounded-xl shadow-sm"
                    placeholder="{{ __('Enter your password to confirm...') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-8 flex justify-end items-center space-x-3">
                <x-secondary-button x-on:click="$dispatch('close')" class="rounded-xl border-slate-200 hover:bg-slate-50">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="bg-red-500 hover:bg-red-600 active:bg-red-700 rounded-xl px-6 py-2 transition-all border-none shadow-lg shadow-red-100">
                    {{ __('Delete Permanently') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
