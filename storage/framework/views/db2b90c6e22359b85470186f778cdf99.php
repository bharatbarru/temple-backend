<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Error - 500</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f8fafc;
            font-family: 'Roboto', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            text-align: center;
            color: #333;
        }
        .container {
            max-width: 500px;
            padding: 20px;
        }
        h1 {
            font-size: 5rem;
            margin-bottom: 10px;
            color: #e53e3e;
        }
        p {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }
        a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3182ce;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        a:hover {
            background-color: #2b6cb0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>500</h1>
        <p>Oops! Something went wrong on our end.</p>
        <a href="<?php echo e(url('/')); ?>">Go Home</a>
    </div>
</body>
</html>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\errors\500.blade.php ENDPATH**/ ?>