<?php
/**
 * Notes controller -- phase 1  
 * Only lists current (open) reminders.
 */
class Notes extends Controller
{
    /** GET /notes  →  list reminders */
    public function index(): void
    {
        $note          = $this->model('Note');
        $data['notes'] = $note->all($_SESSION['uid']);
        $this->view('notes/index', $data);
    }
}
