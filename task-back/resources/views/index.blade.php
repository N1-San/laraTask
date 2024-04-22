    <div class="container mx-auto">
        <h1 class="text-2xl font-bold my-4">Users</h1>
        <!-- Display table listing all users -->
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Username</th>
                    <th class="border border-gray-300 px-4 py-2">Mobile</th>
                    <th class="border border-gray-300 px-4 py-2">Groups</th>
                    <th class="border border-gray-300 px-4 py-2">Created At</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through users data and display rows -->
                @foreach($users as $user)
            <tr>
                <td class="border px-4 py-2">{{ $user->username }}</td>
                <td class="border px-4 py-2">{{ $user->mobile }}</td>
                <td class="border px-4 py-2">
                    @foreach($user->groups as $group)
                        {{ $group->label }}
                        @if(!$loop->last)
                            ,
                        @endif
                    @endforeach
                </td>
                <td class="border px-4 py-2">{{ $user->created_at }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('users.edit', $user->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                    <form method="POST" action="{{ route('users.destroy', $user->id) }}" class="inline-block">
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
