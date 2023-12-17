<?php
// src/Message/CheckUrl.php

namespace App\Message;

use App\Entity\Watcher;

class CheckUrl
{

    public function __construct(
        private Watcher $watcher
    )
    {
        $this->watcher = $watcher;
    }

    /**
     * Get the value of watcher
     */
    public function getWatcher()
    {
            return $this->watcher;
    }
}
