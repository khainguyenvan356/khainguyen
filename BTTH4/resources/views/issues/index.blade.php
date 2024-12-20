@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Issues List</h1>

        <a href="{{ route('issues.create') }}" class="btn btn-success mb-3">Create New Issue</a>
        <style>
            table, th, td {
                color: black;
            }

            td {
                color: black;
            }

            td span.badge {
                color: black; 
            }
        </style>

        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Mã vấn đề</th>
                            <th>Tên máy tính</th>
                            <th>Tên phiên bản</th>
                            <th>Người báo cáo sự cố</th>
                            <th>Thời gian báo cáo</th>
                            <th>Mức độ sự cố</th>
                            <th>Trạng thái hiện tại</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($issues as $issue)
                            <tr>
                                <td>{{ $issue->id }}</td>
                                <td>{{ $issue->computer->computer_name }}</td> <!-- Tên máy tính -->
                                <td>{{ $issue->computer->operating_system }}</td> <!-- Tên phiên bản (Operating System) -->
                                <td>{{ $issue->reported_by }}</td>
                                <td>{{ \Carbon\Carbon::parse($issue->reported_date)->format('d/m/Y') }}</td>
                                <td>
                                    <span class="badge 
                                        @if($issue->urgency == 'Low') badge-success 
                                        @elseif($issue->urgency == 'Medium') badge-warning 
                                        @else badge-danger 
                                        @endif">
                                        {{ $issue->urgency }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge 
                                        @if($issue->status == 'Open') badge-info 
                                        @elseif($issue->status == 'In Progress') badge-primary 
                                        @else badge-success 
                                        @endif">
                                        {{ $issue->status }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('issues.edit', $issue->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('issues.destroy', $issue->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this issue?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="d-flex justify-content-center mt-4">
                    <div>
                        {{ $issues->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
