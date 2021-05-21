
<?php
require_once ('dadb.php');
        $sql="show tables from museum";
        $res=$conn->query($sql);
        // var_dump($res);
        if (!$res) {
            echo mysqli_error($conn) . "\n";
        }
        while($tablename=mysqli_fetch_array($res)){
	        $tableslist[]=$tablename;
	    }
	    var_dump($tableslist);
	    if($tableslist==null){
	        echo '<script>alert("数据库为空");location="index.php"</script>';
	    }
       // 

?>