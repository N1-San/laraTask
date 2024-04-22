@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Group</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('groups.update', $group->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="label">Label</label>
                            <input type="text" class="form-control" id="label" name="label" value="{{ $group->label }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Group</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
