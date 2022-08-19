<?php
/**
 * PDO Database Class 
 * Connect to databse
 * Create prepared statments
 * Bind values 
 * Return rows and result
 */
class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $dataBaseHost;
    private $stmt;
    private $error;

    public function __construct()
    {
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;

        // cretat a couple options theres a lot differnt options that i can use PDO Php Data Object 
        /**
         * PDO::ATTR_PERSISTENT (mixed)
         * Request a persistent connection, rather than creating a new connection.Connections are established by creating instances of the PDO base class. 
         * It doesn't matter which driver you want to use; you always use the PDO class name. The constructor accepts parameters for specifying the database source (known as the DSN) and optionally for the username and password (if any).
         * 
         * PDO::ATTR_ERRMODE (int)
         * See the Errors and error handling section for more information about this attribute.
         * https://www.php.net/manual/en/pdo.constants.php#pdo.constants.attr-errmode
         *
         * PDO::ERRMODE_EXCEPTION (int)
         * Throw a PDOException if an error occurs. PDO offers you a choice of 3 different error handling strategies, to fit your style of application development.
         * https://www.php.net/manual/en/pdo.error-handling.php
         */
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION

        );

        // Creat a  pdo object instance
        try {

            $this->dataBaseHost = new PDO($dsn, $this->user, $this->pass, $options);

        }
        catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }

    }

    // Prepare statment with query 

    public function query($sql)
    {
        $this->stmt = $this->dataBaseHost->prepare($sql);
    }
    // this method to Bind the Values
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
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
                    break;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }
    // EXECUTE the prepared statment 
    public function execute()
    {
        return $this->stmt->execute();
    }

    // Get result set as array of object and this method get all record in the table  
    public function resultset()
    {
        $this->execute();
        //Specifies that the fetch method shall return each row as an object with property names that correspond to the column names returned in the result set.
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //this method single to get one record from the table in mysql 
    public function single()
    {
        $this->execute();
        //Specifies that the fetch method shall return each row as an object with property names that correspond to the column names returned in the result set.
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // Get Row Count 
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
}
?>