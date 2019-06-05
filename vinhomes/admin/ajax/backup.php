<?php
    $host=$config['database']['servername']; // Mặc định là localhost
    $uname=$config['database']['username'];
    $pass=$config['database']['password'];
    $database = $config['database']['database'];
    // Hàm bỏ qua lỗi kết nối
    error_reporting(E_ALL ^ E_DEPRECATED);
    // Xử lý kết nối database
    $connection=mysql_pconnect($host,$uname,$pass) or die("Database Connection Failed");
    // Xử lý lấy dữ liệu ngôn ngữ utf8
    mysql_set_charset('utf8',$connection);
    // Kết nối đến cơ sở dữ liệu
    $selectdb=mysql_select_db($database) or die("Database could not be selected");
    $result=mysql_select_db($database) or die("Database cannot be selected");

    function backup_db($dbname = 'db'){
        global $filename;
        // Lưu trữ tất cả tên Table vào một mảng
        $return='SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";' . "\n" . 'SET time_zone = "+00:00";';
        $allTables = array();
        $result = mysql_query('SHOW TABLES');
        while($row = mysql_fetch_row($result)){
             $allTables[] = $row[0];
        }
         
        foreach($allTables as $table){
            $result = mysql_query('SELECT * FROM '.$table);
            $num_fields = mysql_num_fields($result);
             
            $return.= 'DROP TABLE IF EXISTS '.$table.';';
            $row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
            $return.= "\n\n".$row2[1].";\n\n";
             
            for ($i = 0; $i < $num_fields; $i++) {
                while($row = mysql_fetch_row($result)){
                    // if($table == "tbl_online") continue;
                    $return.= 'INSERT INTO '.$table.' VALUES(';
                    for($j=0; $j<$num_fields; $j++){
                        $row[$j] = addslashes($row[$j]);
                        $row[$j] = str_replace("\n","\\n",$row[$j]);
                        if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; }
                        else { $return.= '""'; }
                        if ($j<($num_fields-1)) { $return.= ','; }
                    }
                    $return.= ");\n";
                }
            }
            $return.="\n\n";
        }
         
        // Tạo thư mục Backup
        $folder = 'DB_Backup/';
        if (!is_dir($folder))
        mkdir($folder, 0777, true);
        chmod($folder, 0777);   
        // Đặt tên file
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $date = date('d-m-Y_H-i-s', time());
        $filename = $folder.$dbname."-backup-".$date.".sql";
        //Tạo file .sql
        $handle = fopen($filename,'w+');
        $result = fwrite($handle,($return));
        fclose($handle);
        return $result==false ? false : true;
    }
?>