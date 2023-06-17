<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('personals.update', $personal) }}">
            @csrf
            @method('patch')
            <table align="left" border="0">
            @foreach($personals as $personalDetails)
                <tr>
                    <td align="left">Title:</td>
                    <td>{{$personalDetails->user_title}}</td>
                </tr>
                <tr>
                    <td align="left">Address:</td>
                    <td>{{$personalDetails->user_address}}</td>
                </tr>
                <tr>
                    <td align="left">Contact Number:</td>
                    <td>{{$personalDetails->user_contact}}</td>
                </tr>
            
                @if ($personalDetails->user->is(auth()->user()))
                    <button href="personals.edit'">{{ __('Edit Details') }}</button>
                @endif
            @endforeach
        </table>
            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('tickets.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>