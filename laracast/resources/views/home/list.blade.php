<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User list</title>
</head>
<body>
    <h1>  User list</h1>
 
    <a href="/home"> back</a>
    <a href="/logout"> logout</a>
<br>
    <table border="1">
    <tr>
        <td>ID</td>
        <td>Name</td>
        <td>Email</td>
        <td>Password</td>
        <td> Action</td>
    </tr>
    @for($i=0; $i< count($userlist); $i++)
    <tr>
        <td>{{ $userlist[$i]['id'] }}</td>
        <td>{{ $userlist[$i]['name'] }}</td>
        <td>{{ $userlist[$i]['email'] }}</td>
        <td>{{ $userlist[$i]['password'] }}</td>
        <td>
            <a href="/home/edit/{{ $userlist[$i]['id'] }}"> Edit</a>
            <a href=""> Delete</a>
        </td>
    </tr>
    @endfor
</table>

</body>
</html>