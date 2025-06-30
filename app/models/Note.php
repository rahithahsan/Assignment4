<?php
/**
 * Note model – (step 1) connect to DB
 */
class Note extends Model
{
    /** @var PDO */
    protected PDO $db;

    public function __construct()
    {
        // use existing PDO singleton helper
        $this->db = db();
    }
}