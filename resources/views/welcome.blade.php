<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Information -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', config('app.name'))</title>

    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600' rel='stylesheet' type='text/css'>

    <style>
        body, html {
            background-color: #252E42;
            background: url('/img/background-home.png');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
            height: 100%;
            margin: 0;
        }

        .full-height {
            min-height: 100%;
        }

        .flex-column {
            display: flex;
            flex-direction: column;
        }

        .flex-fill {
            flex: 1;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }


        .text-center {
            text-align: center;
        }

        .links {
            padding: 1em;
            text-align: right;
        }

        .links a {
            text-decoration: none;
        }

        .links button {
            background-color: transparent;
            border-radius: 4px;
            color: white;
            cursor: pointer;
            font-family: 'Open Sans';
            font-size: 14px;
            font-weight: 600;
            padding: 15px 50px;
            text-transform: uppercase;
            border: 1px solid #b3d8ff;
            transition: 0.3s ease-in-out;
        }

        .links button:hover{
            background-color: #ecf5ff;
            color: #409eff;
            border: 1px solid #b3d8ff;
            transition: 0.3s ease-in-out;
        }
    </style>
</head>
<body>
    <div class="full-height flex-column">
        <nav class="links">
            <a href="/login" style="margin-right: 15px;">
                <button class="btn-view-more">
                    {{__('Se connecter')}}
                </button>
            </a>

            <a href="/register">
                <button>
                    {{__('S\'inscrire')}}
                </button>
            </a>
        </nav>

        <div class="flex-fill flex-center">
            <h1 class="text-center">
                <img src="/img/logo-breedy.png">
            </h1>
        </div>
    </div>
</body>
</html>
