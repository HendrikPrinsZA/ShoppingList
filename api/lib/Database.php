<?php

class Database {

    public function __construct($host, $user, $pass, $name) {
        try {
            $dbh = new PDO('mysql:host='.$host.';dbname='.$name, $user, $pass);
            $dbh->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );
            $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        } catch (PDOException $e) {
            throw new Exception('Unable to connect to database '.$e->getMessage());
        }

        if ($dbh === false) {
            throw new Exception('Unable to connect to database');
        }

        $this->dbh = $dbh;
    }

    public function select($sql, $params = array()) {
        $sth = $this->dbh->prepare($sql);
        $sth->execute($params);
        $return = $sth->fetchAll();
        return $return;
    }

    public function insert($sql, $params = array()) {
        try {
            $sth = $this->dbh->prepare($sql);
            $sth->execute($params);
            $lastInsertId = intval($this->dbh->lastInsertId());
            return $lastInsertId;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function execute($sql, $params = array()) {
        try {
            $sth = $this->dbh->prepare($sql);
            $return = $sth->execute($params);
            return $return;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
