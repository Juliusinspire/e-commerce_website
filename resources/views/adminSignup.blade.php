
<form method="POST" action="adminSignup">
        @csrf
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name"><br>
        <span style="color:red">@error('name'){{$message}}@enderror</span><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br>
        <span style="color:red">@error('email'){{$message}}@enderror</span><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br>
        <span style="color:red">@error('password'){{$message}}@enderror</span><br>

        <label for="password_confirmation">Confirm Password:</label><br>
        <input type="password" id="password_confirmation" name="password_confirmation"><br>
        <span style="color:red">@error('password_confirmation'){{$message}}@enderror</span><br>
        <button type="submit">Signup</button><br>
    </form>
