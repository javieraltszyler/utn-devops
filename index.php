<html>
    <head>
        <title>Equipo 2</title>
    </head>

    <body>
        <h1>Test Mysql DB Connection</h1>
        <?php
            try{
                $pdo = new PDO("mysql:host=db;dbname=mysql","root","root");
                $stmt = $pdo->prepare("SELECT User from user");
                $stmt->execute();
                $users= $stmt->fetchAll(PDO::FETCH_ASSOC);

            }
            catch(PDOException $e){
                die("Could not connect to the database mysql :" . $e->getMessage());
            }
        ?>
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $user): ?>
                    <tr>
                        <td><?=$user['User'] ?></td>
                    </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </body>
</html>