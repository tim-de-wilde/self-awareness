<?php

namespace App\Traits;

trait ManagesModal
{
    public bool $showModal = false;

    public function openModal(): void
    {
        $this->showModal = true;
    }

    public function closeModal(): void
    {
        $this->showModal = false;
    }

    public function toggleModal(): void
    {
        $this->showModal = ! $this->showModal;
    }
}