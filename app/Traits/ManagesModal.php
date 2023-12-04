<?php

namespace App\Traits;

trait ManagesModal
{
    public bool $showModal = false;

    public function showModal(): void
    {
        $this->showModal = true;
    }

    public function hideModal(): void
    {
        $this->showModal = false;
    }

    public function toggleModal(): void
    {
        $this->showModal = ! $this->showModal;
    }
}