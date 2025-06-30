<?php
class Note extends Model
{
    protected PDO $db;
    public function __construct(){ $this->db = db(); }

    /* ---------- READ ---------- */
    public function all(int $uid): array { /* as before */ }
    public function find(int $id, int $uid): ?array { /* as before */ }

    /* ---------- CREATE ---------- */
    public function insert(int $uid, string $sub, string $body = ''): void { /* as before */ }

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
            "UPDATE notes SET completed = 1
             WHERE id = ? AND user_id = ?"
        )->execute([$id, $uid]);
    }
}
