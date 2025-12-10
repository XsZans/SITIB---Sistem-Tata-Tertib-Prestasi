<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <div class="relative">
                <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full pr-10" autocomplete="current-password" />
                <button type="button" onclick="togglePasswordVisibility('update_password_current_password')" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                    <i class="fas fa-eye text-gray-400 hover:text-gray-600" id="update_password_current_password_icon"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <div class="relative">
                <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full pr-10" autocomplete="new-password" oninput="validateNewPassword()" />
                <button type="button" onclick="togglePasswordVisibility('update_password_password')" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                    <i class="fas fa-eye text-gray-400 hover:text-gray-600" id="update_password_password_icon"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <div class="relative">
                <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full pr-10" autocomplete="new-password" oninput="validatePasswordConfirmation()" />
                <button type="button" onclick="togglePasswordVisibility('update_password_password_confirmation')" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                    <i class="fas fa-eye text-gray-400 hover:text-gray-600" id="update_password_password_confirmation_icon"></i>
                </button>
            </div>
            <div id="password_confirmation_feedback" class="mt-1 text-sm hidden"></div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

<script>
    function togglePasswordVisibility(inputId) {
        const passwordInput = document.getElementById(inputId);
        const toggleIcon = document.getElementById(inputId + '_icon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }
    
    function validateNewPassword() {
        validatePasswordConfirmation();
    }
    
    function validatePasswordConfirmation() {
        const password = document.getElementById('update_password_password');
        const confirmation = document.getElementById('update_password_password_confirmation');
        const feedback = document.getElementById('password_confirmation_feedback');
        
        if (!password || !confirmation || !feedback) return;
        
        const passwordValue = password.value;
        const confirmationValue = confirmation.value;
        
        if (confirmationValue.length === 0) {
            feedback.classList.add('hidden');
            confirmation.classList.remove('border-red-300', 'border-green-300');
            return;
        }
        
        feedback.classList.remove('hidden');
        
        if (passwordValue === confirmationValue && passwordValue.length >= 8) {
            feedback.innerHTML = '<i class="fas fa-check text-green-600 mr-1"></i><span class="text-green-600">Password cocok</span>';
            confirmation.classList.remove('border-red-300');
            confirmation.classList.add('border-green-300');
        } else {
            feedback.innerHTML = '<i class="fas fa-times text-red-600 mr-1"></i><span class="text-red-600">Password tidak cocok</span>';
            confirmation.classList.remove('border-green-300');
            confirmation.classList.add('border-red-300');
        }
    }
</script>
