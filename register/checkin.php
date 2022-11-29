<html>
    <head>
        <title>calculator</title>  
        <meta charset="UTF-8">
    </head>
    <body>

        <form action="calculator.php" method="get">

            <label for="num1"><b>数値1</b></label>
            <input type="text" name ="num1"><br><br>
            <label for = "num2"><b>数値2</b></label>
            <input type="text" name="num2"><br><br>

            <input type ="radio" name = "r1" value="Add">+ 
            <input type = "radio" name = "r1" value="Sub">-<br>
            <input type="radio" name="r1" value ="mul">* 
            <input type = "radio" name="r1" value="div">/<br><br>

            <input type="submit" value="submit">
        </form>
    </body>
</html>