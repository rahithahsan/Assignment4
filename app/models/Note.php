<?php
class Note
{
    protected PDO $db;
    public function __construct(){ $this->db = db(); }

    /* ---------- READ ---------- */
    public function all(int $uid): array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM notes
             WHERE user_id = ? AND completed = 0
             ORDER BY created_at DESC"
        );
        $stmt->execute([$uid]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(int $id, int $uid): ?array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM notes
             WHERE id = ? AND user_id = ?"
        );
        $stmt->execute([$id, $uid]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    /* ---------- CREATE ---------- */
    public function insert(int $uid, string $sub, string $body = ''): void
    {
        $this->db->prepare(
            "INSERT INTO notes (user_id, subject, body)
             VALUES (?, ?, ?)"
        )->execute([$uid, $sub, $body]);
    }

    /* ---------- UPDATE ---------- */

    public function update(
        int $id,
        int $uid,
        string $sub,
        string $body,
        int $completed = 0
    ): void {
        $sql = "UPDATE notes
                   SET subject = ?, body = ?, completed = ?
                 WHERE id = ? AND user_id = ?";
        $this->db->prepare($sql)->execute([$sub, $body, $completed, $id, $uid]);
    }

    /* ---------- DELETE (soft) ---------- */

    public function softDelete(int $id, int $uid): void
    {
        $this->db->prepare(
            "UPDATE notes
                SET completed = 1
              WHERE id = ? AND user_id = ?"
        )->execute([$id, $uid]);
    }
}
