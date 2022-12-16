<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>



    <section id="main">
        <div class="container">
            <h2 id="title">
                Counter</h2>
            <h3 id="counter">
                0</h3>
            <div class="btn-container">
                <button id="add" onclick="add()">Add Count</button>
                <button id="lower" onclick="lower()">Lower Count</button>
            </div>
        </div>
    </section>

    <script type="text/javascript" src="http://code.jquery.com/jquery-1.4.3.min.js"></script>
    <script type="text/javascript">
        var count = 0;

        function add() {
            count += 1;
            document.getElementById('counter').innerHTML = count;
        }

        function lower() {
            count -= 1;
            document.getElementById('counter').innerHTML = count;
        }
    </script>




</body>

</html>
