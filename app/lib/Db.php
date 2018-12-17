<?php 
// connect to database 
// Bind values
// returns rows and column

class Db {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $dbh;
    private  $stmt;
    private $error;

    //consrtuctor 
    public function __construct() {

        //set dsn
        $dsn = 'mysql:host=' . $this->host . ";dbname=" . $this->dbname;
        $options =  array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );


        //CREATE THE PDO INSTANCE
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch(PDOExeption $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    // prepare statements with query 
    public function query($sql) {
        $this->stmt = $this->dbh->prepare($sql); 
    }


    // bind values
    public function bind($param, $value, $type = null) {

        if(is_null($type)) {
            switch(true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default: 
                    $type = PDO::PARAM_STR;      
            }
        }

        // RUN THE BIND VALUE AFTER CHECKING
        $this->stmt->bindValue($param, $value, $type);

    }
     // execute the prepared statements
        public function execute() {
            return $this->stmt->execute();
        }

        //get all results and set as an array of objects

        public function setResult() {
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }
    
        // GET A SINGLE RESULT 
        public function singleData() {
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        }

        //GET THE ROW COUNT
        public function rowcount() {
            return $this->stmt->rowcount();
        }
}