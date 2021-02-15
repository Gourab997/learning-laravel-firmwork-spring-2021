<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create User</title>
</head>
<body>
    <form action="create" method="POST">
        @csrf
            <fieldset>
                <legend>Edit User {{ $user['id'] }}</legend>
                <table>
                    <tr>
                        <td>name</td>
                        <td><input type="text" name="username" value="{{ $user['name'] }}"></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><input type="password" name="password" value="{{ $user['password'] }}"></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input type="email" name="email" value="{{ $user['email'] }}"></td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="submit" value="update"></td>
                       
                    </tr>
                </table>
            </fieldset>
        
        </form> 
</body>
</html>