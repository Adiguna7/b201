<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php foreach ($data['users'] as $usr){ 
     echo $usr['userName'];
     echo $usr['userAddress'];
     echo $usr['userEmail'];  
    }?>
</body>
</html>