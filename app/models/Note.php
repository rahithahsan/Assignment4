<?php
class Note
{
    protected PDO $db;
    public function __construct() { $this->db = db(); }

    /* ---------- READ ---------- */

    /** All *open* (not completed & not deleted) reminders */
    public function open(int $uid): array
    {
        $sql = "SELECT * FROM notes
                WHERE user_id = ? AND completed = 0 AND deleted = 0
                ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$uid]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /** All *done* (completed) reminders that haven’t been deleted */
    public function done(int $uid): array
    {
        $sql = "SELECT * FROM notes
                WHERE user_id = ? AND completed = 1 AND deleted = 0
                ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$uid]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /** Single row (returns null if not found / not owner) */
    public function find(int $id, int $uid): ?array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM notes WHERE id = ? AND user_id = ? AND deleted = 0"
        );
        $stmt->execute([$id, $uid]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    /* ---------- CREATE ---------- */

    public function insert(int $uid, string $sub, string $body = ''): void
    {
        $sql = "INSERT INTO notes (user_id, subject, body)
                VALUES (?, ?, ?)";
        $this->db->prepare($sql)->execute([$uid, $sub, $body]);
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
                   SET subject   = ?,
                       body      = ?,
                       completed = ?
                 WHERE id = ? AND user_id = ? AND deleted = 0";
        $this->db->prepare($sql)->execute([$sub, $body, $completed, $id, $uid]);
    }

    /* ---------- ONE-CLICK TOGGLE ---------- */

    public function toggle(int $id, int $uid): void
    {
        $sql = "UPDATE notes
                   SET completed = 1 - completed
                 WHERE id = ? AND user_id = ? AND deleted = 0";
        $this->db->prepare($sql)->execute([$id, $uid]);
    }

    /* ---------- DELETE / ARCHIVE ---------- */

    /** New preferred deletion – hides row from both lists but keeps DB trail */
    public function archive(int $id, int $uid): void
    {
        $sql = "UPDATE notes
                   SET deleted = 1
                 WHERE id = ? AND user_id = ?";
        $this->db->prepare($sql)->execute([$id, $uid]);
    }

    /** Old “soft delete” kept for backward-compatibility (still flips completed) */
    public function softDelete(int $id, int $uid): void
    {
        // call the new archive so behaviour is consistent everywhere
        $this->archive($id, $uid);
    }
}
