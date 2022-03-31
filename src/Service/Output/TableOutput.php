<?php

namespace App\Service\Output;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Output\OutputInterface;

class TableOutput
{

    public function displayTable(OutputInterface $output, array $productArray)
    {
        $table = new Table($output);
        $table
            ->setHeaders(['Sku', 'Status', 'Price', 'Description', 'Created At', 'Slug'])
            ->setRows($productArray);
        $table->render();
    }

}