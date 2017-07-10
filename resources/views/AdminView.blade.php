<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>查看用户信息</title>
</head>
<body>
    <table border="1">
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Age</td>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->user_name}}</td>
                <td>{{$user->user_age}}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>