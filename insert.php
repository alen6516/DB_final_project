<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="index.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script type="text/javascript" src="index.js"></script>    
        <script type="text/javascript" src="insert.js"></script>    

        <style type="text/css">
            div{
                margin:20px;
            }
            #table_list > div{
                float:left;
            }
        </style>
    </head>
    <body>
        <div id="grap">
            <div id="action">
                <a href="index.php">首頁</a>
                <a href="select.php">select</a>
                <a href="delete.php">delete</a>
                <a href="insert.php">insert</a>
                <a href="update.php">update</a>
            </div>
            
            <!-- 拿table 清單 -->
            <div id="right">
                <div id="table_list">
                <?php
                    #連接資料庫
                    include("mysql_connect.php");

                    $conn = @mysqli_connect($servername, $username, $password, $dbname);
                    if(mysqli_connect_errno($conn))
                        die("fail in connection to mysql");

                    mysqli_set_charset($conn,"utf8");

                    $sql="select name from all_table";

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

                    # 先將資料存入
                    for($j=0 ; $j<$row_total ; $j++) {
                        $row=mysqli_fetch_array($result);
                        $db_data[$j] = $row;
                    }

                    # 輸出資料
                    echo '<form action="insert_receive.php" method="post">';
                    echo '<div><p>請先選擇table</p>';
                    echo '<select name="select_table" size=10>';
                    for ($y=-1 ; $y<$row_total ; $y++){
                        for ($x=0 ; $x<$field ; $x++){
                                                        //假如y等於-1就先輸出資料表欄位名稱
                            if ($y == -1){
                                #echo '<option value="'.$fields_name[$x].'" disabled=disabled> table list</option>';
                            }
                            elseif($y == 0){
                                echo '<option class="table_option selected_table" value="'.$db_data[$y][$x].'">'.$db_data[$y][$x].'</option>';
                            }
                            else{
                                echo '<option class="table_option" value="'.$db_data[$y][$x].'">'.$db_data[$y][$x].'</option>';
                            }
                        }
                    }
                    echo '</select>';
                    echo '</div>';



                    # =============產生眾多 table 的 fileds============
                    for($k=0 ; $k<$row_total ; $k++){
                    
                        # fetch field list
                        $sql_2 = "select * from ".$db_data[$k][0];

                        # 執行SQL
                        $result_2 = mysqli_query($conn, $sql_2);

                            
                        # 取得筆數
                        $row_total_2 = mysqli_num_rows($result_2);
                        # 取得欄位數
                        $field_2 = mysqli_num_fields($result_2);
                        

                        # 取得欄位名稱，並將欄位名稱存到 field_name 陣列
                        for ($i=0 ; $i<$field_2 ; $i++) {
                            $meta_2 = mysqli_fetch_field($result_2);
                            $fields_name_2[$i] = $meta_2->name;
                        }
                        #echo "<br>筆數 = ".$row_total." 欄位數 = ".$field."<br>";

                        # 先將資料存入
                        for($j=0 ; $j<$row_total_2 ; $j++) {
                            $row_2=mysqli_fetch_array($result_2);
                            $db_data_2[$j] = $row_2;
                        }

                        # 輸出資料
                        if ($k != 0) { # 預設只有第一個table的field要輸出
                            echo '<div class="field_div hide_div '.$db_data[$k][0].'"><p>fields of '.$db_data[$k][0].'</p>';
                        }
                        else {
                            echo '<div class="field_div '.$db_data[$k][0].'"><p>fields of '.$db_data[$k][0].'</p>';
                        }

                        #echo '<form action="insert_receive.php" method="post">';
                        
                        for ($y=-1 ; $y<$row_total_2 ; $y++){
                            for ($x=0 ; $x<$field_2 ; $x++){
                                                            //假如y等於-1就先輸出資料表欄位名稱
                                if ($y == -1){
                                    echo '<span>'.$fields_name_2[$x].'</span>';
                                    if ($k == 0){
                                        echo '<input type="text" size=40 class="insert_input" name="insert_input[]"><br>';
                                    }
                                    else {
                                        echo '<input type="text" size=40 class="insert_input" name="insert_input[]" disabled="disabled"><br>';
                                    }
                                    
                                }
                                else{
                                    #echo '<option class="option" value="'.$db_data[$y][$x].'">'.$db_data[$y][$x].'</option>';
                                }
                             }
                        }
                        echo '</div>';
                        /**/
                    }# end of for
                    echo '<input type="submit" name="insert_send" value="send">';
                    echo '</form>';
                ?>
                </div style="clear:both"><!-- table list -->
            </div><!-- right -->
        </div style="clear:both">
    </body>
</html>
