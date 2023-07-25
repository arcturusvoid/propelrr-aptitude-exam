<?php

class SortAndMedian {
    private $data;

    public function __construct($array) {
        $this->data = $array;
    }

    private function bubbleSort() {
        $n = count($this->data);
        for ($i = 0; $i < $n - 1; $i++) {
            for ($j = 0; $j < $n - $i - 1; $j++) {
                if ($this->data[$j] > $this->data[$j + 1]) {
                    $temp = $this->data[$j];
                    $this->data[$j] = $this->data[$j + 1];
                    $this->data[$j + 1] = $temp;
                }
            }
        }
    }

    public function getMedian() {
        $this->bubbleSort();
        $n = count($this->data);
        $middleIndex = floor($n / 2);
        if ($n % 2 == 0) {
            return ($this->data[$middleIndex - 1] + $this->data[$middleIndex]) / 2;
        } else {
            return $this->data[$middleIndex];
        }
    }

    public function getLargestValue() {
        $this->bubbleSort();
        $n = count($this->data);
        return $this->data[$n - 1];
    }
}

class DataProcessor {
    private $data;

    public function __construct($array) {
        $this->data = $array;
    }

    public function process() {
        $sortAndMedian = new SortAndMedian($this->data);
        $median = $sortAndMedian->getMedian();
        $largestValue = $sortAndMedian->getLargestValue();
        echo "Median: " . $median . "<br>";
        echo "Largest Value: " . $largestValue . "<br>";
    }
}

$array = array(5, 3, 1, 4, 2, 10, 20, 55, 99, 129, 500, 7);
$dataProcessor = new DataProcessor($array);
$dataProcessor->process();


