<?php
class Note extends Model
{
    protected PDO $db;
    public function __construct(){ $this->db = db(); }

    /* ---------- R ---------- */
    public function all(int $uid): array { /* unchanged from v2 */ }

    /** C – insert new note */
    public function insert(int $uid, string $sub, string $body = ''): void
    {
        $this->db->prepare(
            "INSERT INTO notes (user_id, subject, body)
             VALUES (?, ?, ?)"
        )->execute([$uid, $sub, $body]);
    }

    /** R – fetch single note (for edit) */
    public function find(int $id, int $uid): ?array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM notes WHERE id = ? AND user_id = ?"
        );
        $stmt->execute([$id, $uid]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
}
