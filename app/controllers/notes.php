<?php
/**
 * Notes controller  —  phase 4
 * Adds Delete (soft-delete) to complete CRUD
 */
class Notes extends Controller
{
    public function index(): void
    {
        $note  = $this->model('Note');
        $notes = $note->all($_SESSION['uid']);      // ← declare

        /*  pass as named variable */
        $this->view('notes/index', ['notes' => $notes]);
    }

    /* ---------- CREATE ---------- */
    public function create(): void { $this->view('notes/create'); }

    public function store(): void
    {
        $this->model('Note')->insert(
            $_SESSION['uid'],
            $_POST['subject'] ?? '',
            $_POST['body']    ?? ''
        );
        $_SESSION['flash'] = 'Reminder created!';
        header('Location: /notes'); exit;
    }

    /* ---------- EDIT / UPDATE ---------- */
    public function edit(int $id): void
    {
        $noteRow = $this->model('Note')->find($id, $_SESSION['uid']);
        $this->view('notes/edit', ['note' => $noteRow]);
    }

    public function update(int $id): void
    {
        $this->model('Note')->update(
            $id,
            $_SESSION['uid'],
            $_POST['subject'] ?? '',
            $_POST['body']    ?? '',
            isset($_POST['completed']) ? 1 : 0
        );
        $_SESSION['flash'] = 'Reminder updated.';
        header('Location: /notes'); exit;
    }

    /* ---------- DELETE (soft) ---------- */
    public function delete(int $id): void
    {
        $this->model('Note')->softDelete($id, $_SESSION['uid']);
        $_SESSION['flash'] = 'Reminder removed.';
        header('Location: /notes'); exit;
    }
}


