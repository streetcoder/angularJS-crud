<?php
define("HOST", "YOUR_HOST");
define("USER", "YOUR_USER");
define("DB", "YOUR_DB");

$con=mysqli_connect(HOST,USER,"",DB);

// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

function read(){
    global $con;
    $result = mysqli_query($con,"SELECT * FROM products");
    $return_arr = array();
    while($row = $result->fetch_array(MYSQLI_ASSOC))
    {
        $rowArr = array(
            'id' => $row['id'],
            'name' => $row['p_name'],
            'code' => $row['code'],
            'price' => $row['price']
        );
        $return_arr[] = $rowArr;
    }
    echo json_encode($return_arr);

}

function insert(){
    global $con;
    $data = json_decode(file_get_contents("php://input"));
    $name = mysql_real_escape_string($data->name);
    $code = mysql_real_escape_string($data->code);
    $description   = mysql_real_escape_string($data->description);
    $imgName   = '';
    $price      = mysql_real_escape_string($data->price);


    if( !mysqli_query($con,"INSERT INTO products ( p_name, code, description, image, price)
VALUES ('$name', '$code','$description', '$imgName', '$price')") )
        die('Error: ' . mysqli_error($con));
    echo mysqli_insert_id($con);
}

function delete(){
    global $con;
    $data = json_decode(file_get_contents("php://input"));
    $id = mysql_real_escape_string($data->id);



    if( !mysqli_query($con,"DELETE FROM products WHERE id='$id'") )
        die('Error: ' . mysqli_error($con));
}

switch ($_GET['action']){
    case 'read':
        read();
        break;
    case 'insert':
        insert();
        break;
    case 'delete':
        delete();
        break;
}


?>