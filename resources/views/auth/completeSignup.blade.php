<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('user.signup.store') }}" enctype="multipart/form-data" id="regForm">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" readonly autofocus value="{{$user->name}}"    />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email"  readonly value="{{$user->email}}" />
            </div>
            <div class="mt-4">
                <x-jet-label for="dialcode_phoneno" value="{{ __('Code and Phone number') }}" />
                <x-jet-input id="dialcode_phoneno" class="block mt-1 w-full" type="text" name="dialcode_phoneno"  />
            </div>
            <div class="mt-4">
                <x-jet-label for="Profile" value="{{ __('Profile') }}" />
                <x-jet-input type="file" name="profile"  />
            </div>
            <div class="mt-4">
                <x-jet-label for="user_type" value="{{ __('User Type') }}" />
                <select id="user_type" class="block mt-1 w-full" name="user_type" >
                        <option>Select User Type</option>
                        <option value="client">Client</option>
                        <option value="designer">Designer</option>
                </select>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
<script src= "//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
   <script>
    $(document).ready(function () {
    $('#regForm').validate({ 
        rules: {
            'dialcode_phoneno': {
                required: true,
                'remote': {
                        url:"{{route('users.checkphoneunique')}}",
                        data: {
                            _token: function() {
                                return "<?php echo csrf_token(); ?>";
                            },
                        }
                }
            },
            // email: {
            //     required: true,
            //     email: true
            // },
            // number: {
            //     required: true,
            //     digits: true
                
            // },
        },
          // errorElement: 'span',
          // errorPlacement: function (error, element) {
          //   error.addClass('invalid-feedback');
          //   element.closest('.form-group').append(error);
          // },
          // highlight: function (element, errorClass, validClass) {
          //   $(element).addClass('is-invalid');
          // },
          // unhighlight: function (element, errorClass, validClass) {
          //   $(element).removeClass('is-invalid');
          // }
    });
});
</script> 
