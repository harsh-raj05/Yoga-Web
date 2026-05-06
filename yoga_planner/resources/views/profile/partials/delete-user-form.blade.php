<section class="space-y-6">
    <header>
        <h2 class="profile-section-title">
            {{ __('Delete Account') }}
        </h2>

        <p class="profile-section-copy">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before continuing, make sure there is nothing you still need from this account.') }}
        </p>
    </header>

    <div class="rounded-3xl border border-[#C87941]/15 bg-[#F0D5BC]/25 px-5 py-5">
        <p class="text-sm leading-7 text-[#6B6B63]">
            {{ __('This action cannot be undone. Deleting your account removes your saved profile and app data permanently.') }}
        </p>
    </div>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="profile-button-danger"
    >{{ __('Delete Account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="profile-modal-panel p-6 sm:p-8">
            @csrf
            @method('delete')

            <h2 class="profile-section-title text-[1.75rem]">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="profile-section-copy mt-3">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="profile-label sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="profile-input mt-1 block w-full sm:w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')" class="profile-button-secondary">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="profile-button-danger">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
