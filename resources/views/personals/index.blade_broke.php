<x-app-layout>
     <form method="post" action="{{ route('personals.store') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{$personals->user_title}}
        

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</x-app-layout>