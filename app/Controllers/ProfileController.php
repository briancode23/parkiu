<?php

class ProfileController extends Controller
{
    public function index()
    {
        // Simple profile placeholder — redirect to dashboard.
        $this->redirect('?url=dashboard/index');
    }
}
