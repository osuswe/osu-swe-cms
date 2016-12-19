<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 48px;

        }

        label, input, button {
            font-size: 20px;
        }
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/css/bootstrap.min.css"
          integrity="sha384-2hfp1SzUoho7/TsGGGDaFdsuuDL0LX2hnUp6VkX3CUQ2K4K+xjboZdsXyp4oUHZj" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="content">
        <h1 class="title">SWE CMS Login</h1>

        @if(isset($status) && $status =='failed')

            <div class="alert alert-danger">
                <strong>Login Failed</strong>Please try again.
            </div>

        @endif

        <form method="POST" action="/admin/manage/login">
            <div class="form-group row">
                <label for="username" class="col-xs-2 col-form-label">Username</label>
                <input name="username" class="form-control" type="text" id="username" required="required">
            </div>
            <div class="form-group row">
                <label for="password" class="col-xs-2 col-form-label">Password</label>
                <input name="password" class="form-control" type="text" id="password" required="required">
            </div>
            <div class="form-group row">
                <input type="submit" value="Login" class="btn btn-primary form-control">
            </div>
        </form>
    </div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"
        integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js"
        integrity="sha384-Plbmg8JY28KFelvJVai01l8WyZzrYWG825m+cZ0eDDS1f7d/js6ikvy1+X+guPIB"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/js/bootstrap.min.js"
        integrity="sha384-VjEeINv9OSwtWFLAtmc4JCtEJXXBub00gtSnszmspDLCtC0I4z4nqz7rEFbIZLLU"
        crossorigin="anonymous"></script>
</html>
