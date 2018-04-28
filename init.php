<?php




    class Init {

        public $conn ;
        function __construct() {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "mega" ;
            $this->conn = new mysqli($servername, $username, $password ,$dbname );
            
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            }else{
                $this->getCURL();
            }
        }

        function getCURL(){
            $url = "http://jsonplaceholder.typicode.com/users" ;
            $content = json_decode(file_get_contents($url),true) ;
            for($i=0 ; $i<count($content) ; $i++){
                $this->post($content[$i] ) ;
            }
        }

        function post($data) {
            $name = $data['name'] ;
            $username = $data['username'] ;
            $email = $data['email'] ;
            $sql = " insert into admin (name , username , email ) values( '$name' , '$username' ,'$email'  )
             ON DUPLICATE KEY UPDATE name = '$name', username =  '$username', email = '$email' ";
            $this->conn->query($sql);
            if (!$this->conn->query($sql)) {
                echo "Error: " . $sql . " > " . $this->conn->error. "<br>" ;
            }
        }
    }


?>