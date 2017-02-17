<html>
    <head>
        <link rel="stylesheet" type="text/css" href="index.css">
    </head>
    <body>
        <div id="action">
            <a href="index.php">首頁</a>
            <a href="select.php">select</a>
            <a href="delete.php">delete</a>
            <a href="insert.php">insert</a>
            <a href="update.php">update</a>
        </div>
<?php
    /*
    if (($table_name = $_GET['name']) == True) { 
        echo $table_name;
    }
    */
    foreach ($_POST as $key => $value) {
        $$key=$value; 
    }
    #echo $select_table;
    #echo $select_input[0];
    #echo $select_input[1];
    #echo $select_condition;
    #echo count($select_input);

    
    #連接資料庫
    include("mysql_connect.php");

    $conn = @mysqli_connect($servername, $username, $password, $dbname);                                               
    if(mysqli_connect_errno($conn))
        die("fail in connection to mysql");
    #else
    #    echo "connect";

    mysqli_set_charset($conn,"utf8");

    $sql="select * from ".$select_table;

    # 執行SQL
    $result = mysqli_query($conn, $sql);

                        
    # 取得筆數
    $row_total = mysqli_num_rows($result);
    # 取得欄位數
    $field = mysqli_num_fields($result);
                    

    # 取得欄位名稱，並將欄位名稱存到 field_name 陣列
    for ($i=0 ; $i<$field ; $i++) {
        $meta = mysqli_fetch_field($result);
        $fields_name[$i] = $meta->name;
    }
    #echo "<br>筆數 = ".$row_total." 欄位數 = ".$field."<br>";
    
    #select 欄位名, 欄位名, 欄位名 from 資料表名稱 where 條件式
    $link_field="";

    for($k=0;$k<count($select_input);$k++){
        if($link_field == "")
            $link_field = $fields_name[$select_input[$k]];
        else
            $link_field = $link_field.", ".$fields_name[$select_input[$k]];
    }

    #echo $link_field;
    
    $sql = "select ".$link_field." from ".$select_table." where ".$select_condition;
    #echo $sql;


    #連接資料庫
    include("mysql_connect.php");

    $conn = @mysqli_connect($servername, $username, $password, $dbname);
    if(mysqli_connect_errno($conn))
        die("fail in connection to mysql");
    else
        #echo "connect";
    

    mysqli_set_charset($conn,"utf8");

    # 執行SQL
    $result = mysqli_query($conn, $sql);
    if($result){
        #echo "select success";
    }
    else{
        echo "select failed";
    }


    # 取得筆數
    $row_total = mysqli_num_rows($result);
    # 取得欄位數
    $field = mysqli_num_fields($result);


    # 取得欄位名稱，並將欄位名稱存到 field_name 陣列
    for ($i=0 ; $i<$field ; $i++) {
        $meta = mysqli_fetch_field($result);
        $fields_name[$i] = $meta->name;
    }
    #echo "<br>筆數 = ".$row_total." 欄位數 = ".$field."<br>";

    #先將資料存入
    for($j=0 ; $j<$row_total ; $j++) {
        $row=mysqli_fetch_array($result);
        $db_data[$j] = $row;
    }
    # 輸出資料
    echo $select_table." table content";
    echo '<table border="1">';
        for ($y=-1 ; $y<$row_total ; $y++){
            echo '<tr>';
            for ($x=0 ; $x<$field ; $x++){
                //假如y等於-1就先輸出資料表欄位名稱
                if ($y == -1){
                    echo '<td class="field_name_td" align="center">'.$fields_name[$x].'</td>';
                }
                else{
                    echo '<td align="center">'.$db_data[$y][$x].'</td>';
                }
            }
            echo '</tr>';
        }
    echo '</table>';
    /**/
?>
</body>
</html>
