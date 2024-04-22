@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit User</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" required>
                        </div>
                        <div class="form-group">
                            <label for="mobile">Mobile</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" value="{{ $user->mobile }}" required>
                        </div>
                        <div class="form-group">
                            <label for="groups">Groups</label>
                            <select multiple class="form-control" id="groups" name="groups[]" required>
                                @foreach($groups as $group)
                                    <option value="{{ $group->id }}" {{ in_array($group->id, $user->groups->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $group->label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
