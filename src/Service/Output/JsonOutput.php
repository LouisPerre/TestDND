<?php

namespace App\Service\Output;

use Symfony\Component\Console\Output\OutputInterface;

class JsonOutput
{

    public function jsonOutput(array $productArray, OutputInterface $output)
    {
        $output->write(json_encode($productArray, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT));
    }

}