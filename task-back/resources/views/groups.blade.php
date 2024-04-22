@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold my-4">Groups</h1>
        <!-- Display table listing all groups -->
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Label</th>
                    <th class="border border-gray-300 px-4 py-2">Created Date</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through groups data and display rows -->
                @foreach($groups as $group)
            <tr>
                <td class="border px-4 py-2">{{ $group->label }}</td>
                <td class="border px-4 py-2">{{ $group->created_at }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('groups.edit', $group->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                    <form method="POST" action="{{ route('groups.destroy', $group->id) }}" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
            </tbody>
        </table>
    </div>
@endsection
