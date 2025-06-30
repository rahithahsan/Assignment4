<?php
class Note extends Model
{
    protected PDO $db;
    public function __construct(){ $this->db = db(); }

    /** Return all *open* notes for current user */
    public function all(int $uid): array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM notes
             WHERE user_id = ?
             AND completed = 0
             ORDER BY created_at DESC"
        );
        $stmt->execute([$uid]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
