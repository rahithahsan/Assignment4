<?php
class Notes extends Controller
{
    public function index(): void
    {
        $note = $this->model('Note');

        $data = [
            'open' => $note->open($_SESSION['uid']),   // not-completed
            'done' => $note->done($_SESSION['uid']),   // completed
        ];

        $this->view('notes/index', $data);
    }

    /* ---------- 1-click toggle ✔︎ ---------- */
    public function toggle(int $id): void
    {
        $this->model('Note')->toggle((int)$id, $_SESSION['uid']);
        header('Location: /notes');
        exit;
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
        header('Location: /notes');
        exit;
    }

    /* ---------- EDIT / UPDATE ---------- */
    public function edit(int|string $id): void
    {
        $id = (int)$id;
        $note = $this->model('Note')->find($id, $_SESSION['uid']);
        $this->view('notes/edit', ['note' => $note]);
    }

    public function update(int $id): void
    {
        $this->model('Note')->update(
            (int)$id,
            $_SESSION['uid'],
            $_POST['subject'] ?? '',
            $_POST['body']    ?? '',
            isset($_POST['completed']) ? 1 : 0
        );
        $_SESSION['flash'] = 'Reminder updated.';
        header('Location: /notes');
        exit;
    }

    /* ---------- DELETE (archive) ---------- */
    public function delete(int $id): void
    {
        $this->model('Note')->archive((int)$id, $_SESSION['uid']);
        $_SESSION['flash'] = 'Reminder removed.';
        header('Location: /notes');
        exit;
    }
}
