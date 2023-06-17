<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">

        <form method="POST" action="{{ route('tickets.store') }}">
            @csrf
            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                <label for="title" class="col-md-4 control-label">Title</label>
                <div class="col-md-6">
                    <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}">
                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                <label for="category" class="col-md-4 control-label">Category</label>
                <div class="col-md-6">
                    <select id="category" type="category" class="form-control" name="category">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('category'))
                        <span class="help-block">
                            <strong>{{ $errors->first('category') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
                                
            <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                <label for="category" class="col-md-4 control-label">Ticket Details</label>
                <div class="col-md-6">
                <textarea
                    name="message"
                    placeholder="{{ __('Please capture Ticket details') }}"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                >{{ old('message') }}</textarea>
                </div>
            </div>
            <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                <div class="col-md-6">
                    <x-input-error :messages="$errors->store->get('message')" class="mt-2" />
                    <x-primary-button class="mt-4">{{ __('Log') }}</x-primary-button>
                </div>
            </div>
        </form>
 
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @foreach ($tickets as $ticket)
                @if ($ticket->user->is(auth()->user()) || auth()->user()->is_admin == 1)
                    <div class="p-6 flex space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-gray-800">{{ $ticket->user->name }}</span>
                                    <small class="ml-2 text-sm text-gray-600">{{ $ticket->created_at->format('j M Y, g:i a') }}</small>
                                    @unless ($ticket->created_at->eq($ticket->updated_at))
                                        <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                                    @endunless
                                </div>
                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('tickets.edit', $ticket)">
                                            {{ __('Edit') }}
                                        </x-dropdown-link>
                                    </x-slot>
                                </x-dropdown>

                            </div>
                            <p class="mt-4 text-lg text-gray-900">{{ $ticket->message }}</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</x-app-layout>