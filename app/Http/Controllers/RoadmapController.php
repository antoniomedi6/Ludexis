<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ExecutableFinder;

class RoadmapController extends Controller
{
    public function index()
    {
        $executableFinder = new ExecutableFinder();
        $gitPath = $executableFinder->find('git', 'git');

        $process = new Process([
            $gitPath,
            'log',
            '--no-merges',
            '--pretty=format:%h|%s|%ad',
            '--date=short',
            '-n',
            '30'
        ], base_path());

        $process->run();

        if (!$process->isSuccessful()) {
            return view('roadmap', ['commits' => collect(), 'error' => 'No se pudo cargar el historial.']);
        }

        $commits = collect(explode("\n", trim($process->getOutput())))
            ->filter(fn($line) => !empty($line) && substr_count($line, '|') === 2)
            ->map(function ($line) {
                [$hash, $message, $date] = explode('|', $line);
                return compact('hash', 'message', 'date');
            });

        return view('roadmap', compact('commits'));
    }
}