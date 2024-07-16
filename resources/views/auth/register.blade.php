<x-layout>

    <x-forms.form-card :isLoggedIn="true">


        <x-logo src="admin/assets/images/icon/logo.png" alt="CoolAdmin" href="/" />

        <div class="login-form">
            <x-forms.form method="POST" action="/register">

                <x-forms.input label="Name" name="name" />

                <x-forms.input label="Email" name="email" type="email" />
                <x-forms.input label="Password" name="password" type="password" />
                <x-forms.input label="Password Confirmation" name="password_confirmation" type="password" />

                <x-forms.role :roles="$roles" name="role_id" id="role_id" />

                <x-forms.button>Register</x-forms.button>

                <div class="register-link">
                    <p>
                        Already have account?
                        <a href="#">Sign In</a>
                    </p>

                </div>

                <div class="social-login-content">
                    <div class="social-button">

                        <button class="au-btn au-btn--block au-btn--blue2">register with twitter</button>
                    </div>
                </div>

            </x-forms.form>


        </div>
    </x-login-card>

</x-layout>
