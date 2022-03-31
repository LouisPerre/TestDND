<?php

namespace App\Command;

use App\Entity\Product;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use App\Service\DataProcess;

class appCommand extends Command
{
    protected static $defaultName = 'app:csvtotable';
    private $dataProcess;

    public function __construct($projectDir, DataProcess $dataProcess)
    {
        $this->projectDir = $projectDir;
        $this->dataProcess = $dataProcess;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->addArgument('fileName', InputArgument::REQUIRED, 'Name of the CSV File')
            ->addOption('json', '-j', InputOption::VALUE_NONE, 'Convert the CSV File to Json')
            ->setHelp('Give the name of your CSV file, add -j if you want the output to be in JSON format');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $fileName = $input->getArgument('fileName');
        $file = $this->projectDir . '/public/product/' . $fileName . '.csv';
        $this->dataProcess->csvToArray($file, $input->getOption('json'), $output);
        $output->write('File added successfully');

        return 1;
    }

}