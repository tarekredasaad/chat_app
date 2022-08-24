<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="robots" content="noindex, nofollow">
      <title>Login Form</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <style>
            .form{
                width:300px;
                margin:100px auto;
            }
            #blue_bar{
            background-color:#405d9b;
            height:50px;
            }
        </style>
    </head>
<body style="font-family: tohoma; background-color:#d0d8e4;">
    <div  id="blue_bar">
        <div style="width: 800px; ">
            MyBook &nbsp &nbsp

        </div>
    </div>


    <div class="container">
        <form class="signup form" action="{{url('signups')}}" method="POST">
        @csrf
            <h4 class="text-center"> </h4>
            <div class="form-group">
            <input class="form-control" type="text" name="name" placeholder="name " autocomplete="off" require>

            <input class="form-control" type="password" name="password" placeholder="Password" autocomplete="new-password" required>
            <input class="form-control" type="password" name="pass2" placeholder="Password again" autocomplete="new-password" required>
            <input class="form-control" type="email" name="email" placeholder="Email" required>
            {{-- <label>Your Image</label>
            <input class="form-control" type="file" name="img" placeholder="your image" > --}}
            <label>Gender</label>
            <select name="gender" id="">
                <option ><?php echo '...' ; ?></option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            </div>
            <input class="btn btn-success btn-block" type="submit" name="signup" value="signup">

        </form>
    </div>
</body>
