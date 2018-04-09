<?php
  /**
   *
   */
  class Database
  {
    private static $instance = null;
    private $mysqli,
            $host = "localhost",
            $username = "root",
            $pass = "root",
            $dbname = "tutorial";

    //apakah defaultnya null?
    /*
    singleton patern menguji koneksi agar ridak double
    asal mula nilai ini adalah null
    */

    private function __construct()
    {
      $this->mysqli = new mysqli($this->host, $this->username, $this->pass, $this->dbname);
      if (mysqli_connect_error()) {
        die("koneksi ke database error");
      }
    }

    public static function getInstance(){
      //kalau dia null
      if (!isset(self::$instance)) {
        self::$instance = new Database();
      }

      return self::$instance;
    }

    public function insert($table, $isi = array())
    {
      //methode untuk mengambil key(kolom) dari arrray dan di pisah dengan koma oleh methode implode()
      $colum = implode(",", array_keys($isi));
      //mengambil nilai
      $i = 0;
      $nilaiArrays = array();
      foreach ($isi as $key => $nilai) {
        if (is_int($nilai)) {
          $nilaiArrays[$i] = $this->escape($nilai);
        }else {
          $nilaiArrays[$i] = "'". $this->escape($nilai) ."'";
        }
        $i++;
      }
      //methode untuk mengambil key(kolom) dari arrray dan di pisah dengan koma oleh methode implode()
      $nilai = implode(",",$nilaiArrays);

      $query = "INSERT INTO $table ($colum) VALUES ($nilai)";
      return $this->run_query($query,'maaf');

    }

    public function getInfo($table, $column, $value)
    {
      if (!is_int($value)) {
        $value = "'". $value."'";
      }else {
        $value = $value = $value;
      }
      //memnilih table dari database
      $query = "SELECT * FROM $table WHERE username =$value";
      //eksekusi query
      $hasil = $this->mysqli->query($query);
      //mengambil isi data dari database
      while ($row = $hasil->fetch_assoc()) {
        return $row;
      }
    }

    public function run_query($query, $pesan)
    {
      if ($this->mysqli->query($query)) return true;
      else return $pesan;
    }

    public function escape($name)
    {
      return $this->mysqli->real_escape_string($name);
    }
  }





?>
