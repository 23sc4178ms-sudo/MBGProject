<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #111827; font-size: 12px; }
        h1 { margin-bottom: 6px; }
        .meta { margin: 0 0 14px; color: #4b5563; }
        table { width: 100%; border-collapse: collapse; margin-top: 18px; }
        th, td { border: 1px solid #d1d5db; padding: 7px; text-align: left; vertical-align: top; }
        th { background: #f3f4f6; }
        .empty { text-align: center; color: #6b7280; padding: 18px; }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>
    <p class="meta">Generated: {{ $date }} | Total Students: {{ $students->count() }}</p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Degree</th>
                <th>Date Added</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ trim($student->name.' '.($student->mname ? $student->mname.' ' : '').$student->lname) }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->contact }}</td>
                    <td>{{ optional($student->degree)->Degree ?? 'N/A' }}</td>
                    <td>{{ optional($student->created_at)->format('Y-m-d') }}</td>
                </tr>
            @empty
                <tr>
                    <td class="empty" colspan="6">No students found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>