<?php

class ItemController {

    public function __construct() {
        $this->db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }

    public function list(int $start = 0, int $limit = 10) {
        $limit = "LIMIT ".$start.", ".$limit;
        $sql = "
            SELECT itemid, description, quantity, datecreated, dateupdated
            FROM item
            WHERE datedeleted IS NULL
            ".$limit."
        ;";

        $records = $this->db->select($sql, [
            'start' => $start,
            'limit' => $limit
        ]);

        // get total
        $total = 100;

        return [
            'records' => $records,
            'total' => $total
        ];
    }

    public function add(string $description, int $quantity = 1) {
        $sql = "
            INSERT INTO `item` SET
            description = :description,
            quantity = :quantity,
            datecreated = NOW();
        ";
        return $this->db->insert($sql, [
            'description' => $description,
            'quantity' => $quantity
        ]);
    }

    public function edit(int $itemid, string $description, int $quantity = 1) {
        $sql = "
            UPDATE `item` SET
            description = :description,
            quantity = :quantity,
            dateupdated = NOW()
            WHERE
            datedeleted IS NULL AND
            itemid = :itemid;
        ";
        $this->db->execute($sql, [
            'itemid' => $itemid,
            'description' => $description,
            'quantity' => $quantity
        ]);
        return $itemid;
    }

    public function delete(int $itemid = 0) {
        // Chose to go with soft deletes
        // - Allows for a recycle bin
        $sql = "
            UPDATE `item` SET
            datedeleted = NOW()
            WHERE
            datedeleted IS NULL AND
            itemid = :itemid;
        ";
        return $this->db->execute($sql, [
            'itemid' => $itemid
        ]);
    }

}
