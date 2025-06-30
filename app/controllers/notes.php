<?php
/**
 * Notes controller  —  phase 3
 * Adds Edit / Update (R+U)
 */
class Notes extends Controller
{
    /* ---------- LIST ---------- */
    public function index(): void
    {
        $note  = $this->model('Note');
        $notes = $note->all($_SESSION['uid']);
        $this->view('notes/index', compact('notes'));
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

    /** GET /notes/edit/{id} */
    public function edit(int $id): void
    {
        $note     = $this->model('Note');
        $noteRow  = $note->find($id, $_SESSION['uid']);
        $this->view('notes/edit', ['note' => $noteRow]);
    }

    /** POST /notes/update/{id} */
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
}

