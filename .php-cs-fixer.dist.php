<?php

declare(strict_types=1);

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = Finder::create()
    ->in([
        __DIR__ . '/src',
        __DIR__ . '/config',
        __DIR__ . '/Helpers',
    ])
    ->name('*.php');

return (new Config())
    ->setRiskyAllowed(false)
    ->setRules([
        '@auto' => true,

        // 🔥 Important additions
        'array_syntax' => ['syntax' => 'short'],
        'no_unused_imports' => true,
        'ordered_imports' => true,
        'no_extra_blank_lines' => true,
        'single_quote' => true,
    ])
    ->setFinder($finder);