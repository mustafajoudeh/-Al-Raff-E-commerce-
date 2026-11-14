<!DOCTYPE html>
<html lang="ar" dir="rtl">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UserList</title>
    <style>
        .user-table {
            border-collapse: collapse;
            width: 100%;
        }

        .user-table th,
        .user-table td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }
    </style>
</head>

<body>
    <table class="user-table">
        <thead>
            <th>Username</th>
            <th>email</th>
            <th>Role</th>
            <th>Status</th>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{$user['user_name']}}</td>
                    <td>{{$user['email']}}</td>
                    <td>{{$user['role']}}</td>
                    <td>{{$user['status']}}</td>

                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>