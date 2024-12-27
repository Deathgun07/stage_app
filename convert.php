<?php
    require 'vendor/autoload.php';
    require './db.php';

    use PhpOffice\PhpSpreadsheet\IOFactory;
    
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

    if (isset($_POST['import'])) {
        
        $sections = htmlentities($_POST['section']);
        $classes = htmlentities($_POST['classe']);
        $inputFile = $_FILES['file_input']['tmp_name'];
        $outputFile = './csv/sortie.csv';
        
        

        // $inputFile = 'C:/chemin/vers/fichier.xlsx';
        // $outputFile = 'C:/chemin/vers/sortie.csv';
        convertExcelToCsv($inputFile, $outputFile);
    

    $csvFile = './csv/sortie.csv'; // Remplacez par le chemin réel de votre fichier

    // Vérifier si le fichier existe
    if (!file_exists($csvFile) || !is_readable($csvFile)) {
        die("Le fichier CSV est introuvable ou illisible.");
    }

    // Ouvrir le fichier CSV
    $handle = fopen($csvFile, 'r');

    if ($handle !== false) {

        // Lire la première ligne pour ignorer les en-têtes
        // $headers = fgetcsv($handle, 1000, ',');

        // Préparer une requête SQL pour insérer les données
        $stmt = $bd->prepare("INSERT INTO etudiant (matricule, nom, prenom, date, sexe, classe, filiere, niveau, section, photo, statut, solde) VALUES (:matricule, :nom, :prenom, :date, :sexe, :classe, :filiere, :niveau, :section, :photo, :statut, :solde)");

        // Lire les lignes du CSV et les insérer dans la base de données
        while (($row = fgetcsv($handle, 1000, ',')) !== false) {

            if ($row[5] != $classes) {

                $errormsg = "Les classes ne correspondent pas";
                break;
            }

            // Convertir la date au format dd/mm/yyyy (si la date est dans le format mm/dd/yyyy)
            $date_naissance = DateTime::createFromFormat('m/d/Y', $row[4]);

            if ($date_naissance) {
                // Formater la date dans le format souhaité (dd/mm/yyyy)
                $date_naissance = $date_naissance->format('d/m/Y');
            } else {
                // Si la date ne peut pas être convertie, vous pouvez gérer l'erreur ou laisser une valeur par défaut
                $date_naissance = null;
            }
            
            // Utilisation de explode() pour séparer la chaîne au niveau du "/"
            $parts = explode('/', $row[5]);

            // Récupérer le niveau (avant le "/") et la filière (après le "/")
            $niveau = $parts[0];  // "BTS2"
            $filiere = $parts[1];  // "IDA"

            $stmt->execute([
                ':matricule' => $row[0],
                ':nom' => $row[1],
                ':prenom' => $row[2],
                ':sexe' => $row[3],
                ':date' => $date_naissance,
                ':classe' => $row[5],
                ':filiere' => $filiere,
                ':niveau' => $niveau,
                ':section' => $sections,
                ':photo' => 'upload/photo/default.png',
                ':statut' => 'Etudiant(e)',
                ':solde' => -1,
            ]);
        }

        fclose($handle);

        $success = "Importation réussie !";

    } else {
        $errormsg = "Impossible d'ouvrir le fichier CSV.";
    }
}
?>
