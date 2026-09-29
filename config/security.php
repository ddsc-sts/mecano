<?php
return [
    'password' => ['min_length' => 10],
    'login' => ['max_attempts' => 5, 'window_seconds' => 900],
    'session' => ['lifetime' => 7200],
];
