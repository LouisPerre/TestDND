<?php

namespace App\Service;

use App\Entity\Product;
use App\Service\Output\JsonOutput;
use App\Service\Output\TableOutput;
use Symfony\Component\Console\Output\OutputInterface;

class DataProcess
{
    private $jsonOutput;
    private $tableOutput;

    public function __construct(JsonOutput $jsonOutput, TableOutput $tableOutput)
    {
        $this->jsonOutput = $jsonOutput;
        $this->tableOutput = $tableOutput;
    }

    public function csvToArray(string $file, bool $format, OutputInterface $output)
    {

        $skipFirstLine = true;
        $index = 0;
        $productArray = [];

        if (($handle = fopen($file, 'rb')) !== false) {
            while (($data = fgetcsv($handle, 1000, ';')) !== false) {
                if ($skipFirstLine) {
                    $skipFirstLine = false;
                    continue;
                }
                $product = new Product();
                $product
                    ->setSku($data[0])
                    ->setSlug($data[1])
                    ->setStatus($data[2])
                    ->setPrice($data[3])
                    ->setCurrency($data[4])
                    ->setCreatedAt(new \DateTime($data[6]));
                if ($format) {
                    $product->setDescriptionJson($data[5]);
                } else {
                    $product->setDescriptionTable($data[5]);
                }

                $productArray[$index] = [
                    'Sku' => $product->getSku(),
                    'Status' => $product->getStatus() ? 'Enable' : 'Disable',
                    'Price' => $product->getPrice(),
                    'Description' => $product->getDescription(),
                    'Created At' => $product->getCreatedAt()->format('l, j-M-Y H:i:s T'),
                    'Slug' => $product->getSlug()
                ];
                $index++;
            }
            fclose($handle);
        }
        if ($format) {
            $this->jsonOutput->jsonOutput($productArray, $output);
        } else {
            $this->tableOutput->displayTable($output, $productArray);
        }


    }

}