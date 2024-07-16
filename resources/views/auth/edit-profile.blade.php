<x-layout>

    <x-forms.form-card :isLoggedIn="true">

        <x-logo src="{{ asset('admin/assets/images/icon/logo.png') }}" alt="CoolAdmin" href="/" />

        <div class="profile-update-form">

            <x-forms.form method="POST" action="profile.update">
                {{-- @csrf --}}
                @method('PUT')

                <x-forms.input label="Name" name="name" type="text" value="{{ auth()->user()->name }}" />
                <x-forms.input label="Email" name="email" type="email" value="{{ auth()->user()->email }}"
                    readonly />
                <x-forms.input label="Role" name="role" type="text" value="{{ auth()->user()->role->role }}"
                    readonly />
                <x-forms.button>Update Profile</x-forms.button>

            </x-forms.form>

        </div>
    </x-forms.form-card>

</x-layout>
