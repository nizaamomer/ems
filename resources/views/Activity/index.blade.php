<!-- resources/views/activities/index.blade.php -->

<h1>Activity Log</h1>

<table>
    <thead>
        <tr>
            <th>User</th>
            <th>Action</th>
            <th>Timestamp</th>
        </tr>
    </thead>
    <tbody>
        @foreach($activities as $activity)
        <tr>
            <td>{{ $activity->user->name }}</td>
            <td>{{ $activity->action }}</td>
            <td>{{ $activity->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
