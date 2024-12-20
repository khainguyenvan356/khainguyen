@extends('layouts.app')

@section('content')
    <h1>Create New Issue</h1>

    <form action="{{ route('issues.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="computer_id" class="form-label">Tên máy tính</label>
            <select class="form-select" id="computer_id" name="computer_id" required>
                @foreach($computers as $computer)
                    <option value="{{ $computer->id }}">{{ $computer->computer_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="reported_by" class="form-label">Người báo cáo sự cố</label>
            <input type="text" class="form-control" id="reported_by" name="reported_by" required>
        </div>

        <div class="mb-3">
            <label for="reported_date" class="form-label">Thời gian báo cáo</label>
            <input type="date" class="form-control" id="reported_date" name="reported_date" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label for="urgency" class="form-label">Mức độ sự cố</label>
            <select class="form-select" id="urgency" name="urgency" required>
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Trạng thái hiện tại</label>
            <select class="form-select" id="status" name="status" required>
                <option value="Open">Open</option>
                <option value="In Progress">In Progress</option>
                <option value="Resolved">Resolved</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Save Issue</button>
    </form>
@endsection
