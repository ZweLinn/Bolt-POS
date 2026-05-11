<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" class="text-slate-700 font-semibold" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full border-slate-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-sm" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email Address')" class="text-slate-700 font-semibold" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full border-slate-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-sm" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 p-4 bg-amber-50 rounded-xl border border-amber-100">
                    <p class="text-sm text-amber-800 flex items-center">
                        <i class="fas fa-envelope-open-text mr-2"></i>
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="ml-2 underline text-sm text-amber-600 hover:text-amber-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 font-semibold">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-2">
            <x-primary-button class="bg-blue-600 hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 rounded-xl px-6 py-2.5 shadow-lg shadow-blue-200 transition-all border-none">
                <i class="fas fa-save mr-2"></i> {{ __('Save Changes') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-emerald-600 font-medium flex items-center"
                >
                    <i class="fas fa-check mr-2"></i> {{ __('Saved successfully.') }}
                </p>
            @endif
        </div>
    </form>
</section>
