<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('personals.store') }}">
            @csrf
            @method('patch')
            <div class="flex items-center gap-4">
                <table align="left" border="0">
                    @foreach($personals as $personalDetails)
                        <tr>
                            <td align="left">Title:</td>
                            <td><input type="text" name="newTitle" value={{$personalDetails->user_title}}></td>
                        </tr>
                        <tr>
                            <td align="left">Address:</td>
                            <td><input type="text" name="newTitle" value={{$personalDetails->user_address}}></td>
                        </tr>
                        <tr>
                            <td align="left">Contact Number:</td>
                            <td><input type="text" name="newTitle" value={{$personalDetails->user_contact}}></td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <br>
            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('personals.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>