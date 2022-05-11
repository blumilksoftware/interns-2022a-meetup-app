@extends('layouts.app')

@section('content')
    <div class="container md:w-[800px] mx-auto">
        <div class="bg-white p-6 mt-20 rounded-20 shadow-xl">
            <div>
                <a href="{{ route('organizations') }}">Go back to organization list</a>
            </div>
            <div>
                {{ $organization->name }}
            </div>
            <div>
                <img src="{{ $organization->logoPath }}" alt="{{ $organization->name }} logo">
            </div>
            <div>
                Location: {{ $organization->location }}
            </div>
            <div>
                Organization type: {{ $organization->organizationType }}
            </div>
            <div>
                Foundation date: {{ $organization->foundationDate }}
            </div>
            <div>
                Number of employees: {{ $organization->numberOfEmployees }}
            </div>
            <h1 class="text-lg font-medium text-gray-900">About organization</h1>
            <div>
                {{ $organization->description }}
            </div>
            <h1>Meetups:</h1>
            <div>
                @forelse ($organization->meetups as $meetup)
                    <a href="{{ route('meetups.show', $meetup) }}">
                        <div>
                            {{ $meetup->title }}
                            <img src="{{ $meetup->logoPath }}" alt="{{ $meetup->title }} logo"
                                 class="w-[397px] h-[100px]">
                        </div>
                    </a>
                @empty
                    <p>There are no meetups</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
