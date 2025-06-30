<?php
/**
 * Notes controller  —  phase 2
 * + create()  + store()  (C in CRUD)
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

    /** GET /notes/create */
    public function create(): void
    {
        $this->view('notes/create');
    }

    /** POST /notes/store */
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
}

