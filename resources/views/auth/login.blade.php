<x-layout>

    <x-forms.form-card :isLoggedIn="true">

        <x-logo src="admin/assets/images/icon/logo.png" alt="CoolAdmin" href="/" />

        <div class="login-form">

            <x-forms.form method="POST" action="/login">

                <x-forms.input label="Email" name="email" type="email" placeholder="example@email.com" />
                <x-forms.input label="Password" name="password" type="password" placeholder="password" />

                <x-forms.button>Login</x-forms.button>

                <div class="register-link">
                    <p>
                        Don't you have account?
                        <a href="#">Sign Up Here</a>
                    </p>
                </div>

                <div class="social-login-content" style="margin-bottom: 20px;">
                    <div class="social-button">
                        <button class="au-btn au-btn--block au-btn--blue m-b-20">sign in with facebook</button>
                    </div>
                </div>
            </x-forms.form>


        </div>
    </x-login-card>


</x-layout>
