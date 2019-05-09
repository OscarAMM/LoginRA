<?php 
    //We create the connection to the DB localhost, username from your db, the password and the db name
    $connection = mysqli_connect('localhost','root','', 'rasystem');
    if(mysqli_connect_errno()){
        //Verify if the connection was made, if it's not we display an echo!
        echo "Something is wrong!";
        exit();
    }
    //We pass the fields to check and register
    $username = $_POST["name"];
    $password = $_POST["password"];
    //We verify if the name exist
    $nameCheckQuery = "SELECT username FROM users WHERE username='".$username."';";
    $namecheck = mysqli_query($connection, $nameCheckQuery) or die("2:Name check query failed!"); // Message in case if the validation fails

    if(mysqli_num_rows($namecheck)>0){ //Mesagge if the name is alredy into the DB
        echo "Name alredy exists!";
        exit();
    }
    //User addition
    $salt = "\$5\$rounds=5000\$"."steamedhams".$username. "\$";
    $hash = crypt($password, $salt);
    $InsertQuery = "INSERT INTO users (username, hash, salt) VALUES ('".$username. "','".$hash. "','".$salt."');";
    mysqli_query($connection, $InsertQuery) or die ("User insertion failed!");
    echo "success!";
?>