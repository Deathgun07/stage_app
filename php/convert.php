<?php
    require 'vendor/autoload.php';

    use PhpOffice\PhpSpreadsheet\IOFactory;

    if (isset($_POST['validate'])) {
        $inputFile = $_FILES['file_input_name']['tmp_name'];
        $outputFile = './csv';
    }

    function convertExcelToCsv($inputFilePath, $outputFilePath) {
        try {
            $spreadsheet = IOFactory::load($inputFilePath);
            $writer = IOFactory::createWriter($spreadsheet, 'Csv');
            $writer->save($outputFilePath);
            echo "Conversion réussie ! Le fichier CSV a été enregistré à : $outputFilePath";
        } catch (Exception $e) {
            echo "Erreur lors de la conversion : " . $e->getMessage();
        }
    }

    // $inputFile = 'C:/chemin/vers/fichier.xlsx';
    // $outputFile = 'C:/chemin/vers/sortie.csv';
    convertExcelToCsv($inputFile, $outputFile);
?>
