<?php




    class DB {

        public $conn ;
        function __construct() {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "mega" ;
            $this->conn = new mysqli($servername, $username, $password ,$dbname );
            
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            }
        }

        function get(){
            $sql = "select * from admin where 1 " ;
            $result = $this->conn->query($sql);
            $data = [] ;
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $data[] = $row ;
                }
            }

            return $data ;
        }

        function post($data) {
            $set = [] ;
            foreach($data as $k => $v){
                if($k==='ID') continue ;
                $set[] = $k ."='". $v . "'" ;
            }

            $sql =  "update  admin set ".join(",",$set) ." where ID = ".$data["ID"]." " ;

            if (!$this->conn->query($sql)) {
                echo $sql . "Error updating record: " . $this->conn->error;
            }
        }
    }


?>