

<?php

function insert_categories() {
    global $conn;
    if(isset($_POST['submit'])){
        $cat_title = $_POST['cat_title'];
        if($cat_title == "" || empty($cat_title)){
            echo "This Field is Empty";
        }else{
            $query = "INSERT INTO category(cat_title) VALUE('{$cat_title}') ";
            $create_category_query = mysqli_query($conn, $query);
            if(!$create_category_query){
                die("QUERY FAILD" . mysqli_error($conn));
            }
         }
    }
}

?>