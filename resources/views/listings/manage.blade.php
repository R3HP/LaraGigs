@extends('layout')

@section('content')
<x-card class="bg-gray-50 border border-gray-200 p-10 rounded">
    <header>
        <h1
            class="text-3xl text-center font-bold my-6 uppercase"
        >
            Manage Gigs
        </h1>
    </header>

    <table class="w-full table-auto rounded-sm">
        <tbody>
            @unless($listings->isEmpty())
                @foreach ($listings as $listing)
                    <x-manage-listing-row :listing="$listing" />
                @endforeach
            @else
                <tr class="border-gray-300">
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                    <p class="text-center">No Listings Found</p>
                    </td>
                </tr>
            @endunless
        </tbody>
    </table>
</x-card>
@endsection