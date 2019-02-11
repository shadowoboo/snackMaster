    <?php

        try{
            $dsn = 'mysql:host=localhost;port=3306;dbname=cd105g2;charset=utf8';
            $user = 'cd105g2';
            $password = 'cd105g2';
            $options = array( PDO::ATTR_CASE => PDO::CASE_NATURAL, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
            $pdo = new PDO($dsn, $user, $password, $options);

            $sql = 'select * from products';
            $products =  $pdo -> query($sql);
        } catch(PDOException $e) {
            echo $e -> getMessage();
            echo '<br>Something in line ', $e -> getLine(),' has error or  is failed';
        }

    
    
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <table border=1>
        <tr>
            <th>Psn</th>
            <th>Pname</th>
            <th>Price</th>
            <th>Author</th>
            <th>Pages</th>
        </tr>

        <?php
            while( $row = $products->fetch() ){
        ?>        
            <tr>
                <td><?php echo $row[0] ?></td>       <!-- PDO::PDO::FETCH_NUM -->
                <td><?php echo $row["pname"] ?></td> <!-- PDO::FETCH_ASSOC -->
                <td><?php echo $row["price"] ?></td> <!-- PDO::FETCH_ASSOC -->
                <td><?php echo $row[3] ?></td>       <!-- PDO::PDO::FETCH_NUM -->
                <td><?php echo $row["pages"] ?></td> <!-- PDO::FETCH_ASSOC -->
            </tr>
        <?php
             }
        ?>

    </table>


        


    
</body>
</html>