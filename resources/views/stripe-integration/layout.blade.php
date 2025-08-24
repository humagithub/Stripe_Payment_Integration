<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stripe Payment</title>
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            text-align: center;
        }
        .container {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        #card-element {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
        }
        .pay-now {
            background-color: #060662;
            color: white;
            border: none;
            padding: 10px;
            margin-top: 10px;
            width: 100%;
            cursor: pointer;
            border-radius: 5px;
        }
        .pay-now:hover {
            background-color: #04044e;
        }
    </style>
</head>
<body>
<div class="container">
    @yield('content')
</div>
</body>
</html>
