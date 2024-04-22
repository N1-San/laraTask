@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Group</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('groups.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="label">Label</label>
                            <input type="text" class="form-control" id="label" name="label" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Group</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
