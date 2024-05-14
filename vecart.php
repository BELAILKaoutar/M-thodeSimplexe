<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    
    <title>Programme Linéaire</title>
    <style>
        body {
            background-image: url('https://img.freepik.com/vecteurs-libre/arriere-plan-texture-aquarelle-vert-doux-moderne_1055-18276.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .form-group {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            max-width: 90%;
            text-align: center;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-top: 0;
            text-decoration: underline; /* Souligner le titre */
            font-family: Arial, sans-serif; /* Utiliser une autre police */
        }

        label {
            font-weight: bold;
            color: #555;
            display: block; /* Afficher chaque label sur une nouvelle ligne */
            margin-bottom: 5px; /* Ajouter un peu d'espacement en bas */
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        button[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        h2 {
            color: #333;
            text-decoration: underline;
            text-align: center;
        }

        .resultat {
            font-size: 18px;
            margin-top: 20px;
        }
        h4 {
            color: #ff0000;
        }
        table {
    width: 100%; /* Utiliser 100% de la largeur disponible */
    border-collapse: collapse; /* Fusionner les bordures des cellules */
}

table, th, td {
    border: 1px solid #ccc; /* Ajouter une bordure aux cellules */
}

th, td {
    padding: 10px; /* Ajouter de l'espace autour du contenu dans les cellules */
    text-align: center; /* Centrer le contenu dans les cellules */
}

.container {
    /* Supprimer la largeur maximale pour permettre au tableau de s'agrandir */
    max-width: none;
    /* Ajuster la largeur du conteneur pour s'adapter au contenu du tableau */
    width: fit-content;
}
    </style>
</head>
<body>
    <div class="container">
        
        <h2><br>2.Variable d'écart</h2>
    <h4>Pour résoudre le programme linéaire il faut d'abord ajouter des variables d'écart aux contraintes d'inégalité pour les transformer en équations d'égalité</h4>
    <form action="index.php" method="post" class="form-group">
        <?php
        // Fonction qui génère l'équation économique
        function create_objective_equation($objectif) {
            $equation = "Z  ";
            preg_match_all('/(\d+)([a-zA-Z]+)/', trim($objectif), $matches);
            $coefficients = array_combine($matches[2], $matches[1]);
            foreach ($coefficients as $var => $coeff) {
                $equation .= $coeff >= 0 ? " - $coeff$var" : " + " . abs($coeff) . "$var";
            }
            $equation .= " = 0";
            return $equation;
        }
// Fonction qui génère l'équation économique avec les variables d'écart
function create_objective_equation_with_slack($objectif, $num_slacks) {
    $equation = "Z";  // Initialisation
    preg_match_all('/(\d+)([a-zA-Z]+)/', trim($objectif), $matches);
    $coefficients = array_combine($matches[2], $matches[1]);
    
    foreach ($coefficients as $var => $coeff) {
        $equation .= " - $coeff$var";
    }

    // Ajouter les variables d'écart avec coefficient 0
    for ($i = 1; $i <= $num_slacks; $i++) {
        $equation .= " + 0e$i"; // Coefficient 0 pour les variables d'écart
    }

    $equation .= " = 0"; // Fermeture de l'équation
    return $equation;
}

        // Fonction qui génère les équations avec variables d'écart
        function create_constraints_with_slack($contraintes) {
            $equations = [];
            $lines = explode("\n", trim($contraintes));
            foreach ($lines as $index => $line) {
                preg_match('/(.*)(<=|<=|≤)(\d+)/', $line, $matches);
                $equation = trim($matches[1]) . " + e$index = " . trim($matches[3]);
                $equations[] = $equation;
            }
            return $equations;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $objectif = $_POST["objectif"];
            $contraintes = $_POST["contraintes"];
            $equation_economique = create_objective_equation($objectif);
            $equations = create_constraints_with_slack($contraintes);

            // Afficher l'équation économique
            echo "<div class='resultat'><h3>Équation économique :</h3>$equation_economique</div>";

            // Afficher les contraintes avec les variables d'écart
            echo "<div class='resultat'><h3>Contraintes :</h3>";
            foreach ($equations as $equation) {
                echo "$equation<br>";
            }
            echo "</div> <br>";
        }
        
      
// Afficher le tableau du simplexe
function afficherTableauSimplexe($tableau, $noms_variables) {
    echo "<table border='1'>";
    echo "<tr> ";
    foreach ($noms_variables as $nom) {
        echo "<th>$nom</th>";
    }
    echo "</tr>";

    foreach ($tableau as $ligne) {
        echo "<tr>";
        foreach ($ligne as $valeur) {
            echo "<td>$valeur</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $objectif = $_POST["objectif"];
    $contraintes = $_POST["contraintes"];

    // Générer des contraintes avec des variables d'écart
    $contraintes_avec_slack = create_constraints_with_slack($contraintes);
    
    // Générer la fonction objective avec des variables d'écart
    $equation_objective = create_objective_equation_with_slack($objectif, count($contraintes_avec_slack));

    // Noms des variables pour le tableau
    $noms_variables = [];
    preg_match_all('/[a-zA-Z]+/', $objectif, $matches);
    $noms_variables = array_merge($matches[0], array_map(fn($i) => "e$i", range(1, count($contraintes_avec_slack))));
    
 

// Construire le tableau du simplexe 
$tableau = [];

// Ajouter la fonction objective au tableau avec les variables d'écart remplies de zéros
$fonction_objective = preg_split('/[+-]/', trim($equation_objective), -1, PREG_SPLIT_NO_EMPTY);
$coefficients_objective = [];

foreach ($fonction_objective as $i => $terme) {
    // Vérifier si le terme contient un signe "-"
    $signe = (strpos($terme, '') !== false) ? -1 : 1; // Conserver le signe "-" si présent
    
    // Remplacer les zéros par une chaîne vide pour les variables d'écart
    if (strpos($terme, 'e') !== false) {
        $coefficients_objective[] = '0'; // Remplacer les zéros par une chaîne vide
    } else {
        $coefficients_objective[] = $signe * floatval(preg_replace('/[^0-9.]/', '', $terme));
    }
}

// La première colonne doit être 1 dans l'équation objective
$coefficients_objective[0] = 1;

// Ajouter des zéros pour les variables d'écart dans la fonction objectif
foreach ($contraintes_avec_slack as $contrainte) {
    preg_match('/=(.*)/', $contrainte, $matches); // Récupérer la partie après le signe "="
    $valeur_variable_ecart = floatval(trim($matches[1])); // Convertir en nombre
    $coefficients_objective[] = $valeur_variable_ecart; // Ajouter avec le signe "-"
    
}
$tableau[] = $coefficients_objective;

// Ajouter les contraintes au tableau
foreach ($contraintes_avec_slack as $i => $equation) {
    $coefficients = [];
    preg_match_all('/([+-]?[\d.]+)([a-zA-Z]+)/', $equation, $matches);
    foreach ($noms_variables as $nom) {
        $index = array_search($nom, $matches[2]);
        $coefficients[] = $index !== false ? floatval($matches[1][$index]) : 0;
    }
    
    // La variable d'écart correspondante doit être 1
    $coefficients[count($noms_variables) - count($contraintes_avec_slack) + $i] = 1;
    
    // Ajouter la valeur après le signe "=" dans une colonne supplémentaire
    preg_match('/=(.*)/', $equation, $matches);
    $valeur_contrainte = floatval(trim($matches[1]));
    $coefficients[] = $valeur_contrainte;
    
    $tableau[] = $coefficients; // Ajouter le terme constant
}



// Assurez-vous que l'avant-dernière colonne de la ligne de l'équation objective est toujours 0
$tableau[0][count($tableau[0]) - 2] = 0;


// Supprimer la dernière colonne de la ligne de l'équation objective
array_pop($tableau[0]);

// Afficher le tableau du simplexe
echo "<h2>3.Tableau du Simplexe:</h2>";
afficherTableauSimplexe($tableau, array_merge($noms_variables, ['=']));
}





            // Function to extract basic and non-basic variables
            function extractBasicAndNonBasicVariables($tableau, $noms_variables) {
                $basic_variables = [];
                $non_basic_variables = [];

                // Iterate over each column of the tableau
                for ($col = 1; $col < count($tableau[0]) - 1; $col++) {
                    $non_zero_count = 0;
                    $non_zero_row = -1;

                    // Count the number of non-zero entries in the column and track the row index
                    for ($row = 0; $row < count($tableau); $row++) {
                        if ($tableau[$row][$col] != 0) {
                            $non_zero_count++;
                            $non_zero_row = $row;
                        }
                    }

                    // If there is exactly one non-zero entry in the column, it's a basic variable
                    if ($non_zero_count == 1) {
                        $basic_variables[] = $noms_variables[$col]; // Add the variable to the basic variables list
                    } else {
                        $non_basic_variables[] = $noms_variables[$col]; // Add the variable to the non-basic variables list
                    }
                }

                return ['basic' => $basic_variables, 'non_basic' => $non_basic_variables];
            }

            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                // Your existing PHP code here...

                // Extract basic and non-basic variables
                $variable_info = extractBasicAndNonBasicVariables($tableau, $noms_variables);
                $basic_variables = $variable_info['basic'];
                $non_basic_variables = $variable_info['non_basic'];

                // Output the results
                echo "<h2>Variables de base :</h2>";
                echo implode(", ", $basic_variables);
                echo "<h2>Variables hors base :</h2>";
                echo implode(", ", $non_basic_variables);
                echo "<h4>Z=0</h4>";
            }
            
            // Function to identify the entering variable
            function identifyEnteringVariable($tableau, $noms_variables) {
                $coefficients_objective = $tableau[0];
                $most_negative_index = null;
                $most_negative_value = PHP_FLOAT_MAX;
            
                // Find the index of the most negative coefficient
                for ($i = 1; $i < count($coefficients_objective) - 1; $i++) {
                    if ($coefficients_objective[$i] < $most_negative_value) {
                        $most_negative_value = $coefficients_objective[$i];
                        $most_negative_index = $i;
                    }
                }
            
                // Return the name of the entering variable
                return $noms_variables[$most_negative_index];
            }
            
            // Identify the entering variable
            $entering_variable = identifyEnteringVariable($tableau, $noms_variables);
            
            // Display the corresponding equation
            echo"<h2>4. les iterations</h2><br>";
            echo "<h2> 4.1 Colonne pivot :  Ve= $entering_variable";

            function selectPivotRow($tableau, $entering_variable, $noms_variables) {
                $column_index = array_search($entering_variable, $noms_variables); // Trouver l'index de la variable entrante
            
                $min_ratio = PHP_FLOAT_MAX; // Initialiser le ratio minimum avec une valeur maximale
                $pivot_row_index = -1; // Index de la ligne pivot
            
                // Parcourir les lignes du tableau, à l'exception de la première (fonction objectif)
                for ($i = 1; $i < count($tableau); $i++) {
                    $value = $tableau[$i][$column_index];
                    // Vérifier si la valeur est positive pour éviter la division par zéro
                    if ($value > 0) {
                        $ratio = $tableau[$i][count($tableau[0]) - 1] / $value; // Calculer le ratio
                        // Mettre à jour le minimum si le ratio est plus petit que le minimum actuel
                        if ($ratio < $min_ratio) {
                            $min_ratio = $ratio;
                            $pivot_row_index = $i;
                        }
                    }
                }
            
                return $pivot_row_index;
            }
            
            // Sélectionner la ligne pivot
            $pivot_row_index = selectPivotRow($tableau, $entering_variable, $noms_variables);
            
            // Afficher la ligne pivot
            echo "<h2> 4.2 Ligne Pivot : Lp=L$pivot_row_index </h2>";

            function extractPivot($tableau, $pivot_row_index, $entering_variable, $noms_variables) {
                $column_index = array_search($entering_variable, $noms_variables); // Trouver l'index de la variable entrante
                return $tableau[$pivot_row_index][$column_index]; // Récupérer la valeur du pivot
            }
            
            // Extraire le pivot
            $pivot_value = extractPivot($tableau, $pivot_row_index, $entering_variable, $noms_variables);
            
            // Afficher la valeur du pivot
            echo "<h2>4.3 Pivot : p=$pivot_value</h2>";
         
            function gaussElimination($tableau, $pivot_row_index, $entering_variable, $noms_variables) {
                $column_index = array_search($entering_variable, $noms_variables); // Trouver l'index de la variable entrante
                $pivot_value = $tableau[$pivot_row_index][$column_index]; // Récupérer la valeur du pivot
            
                // Étape 1 : Divisez la ligne pivot par la valeur du pivot
                $tableau[$pivot_row_index] = array_map(function($value) use ($pivot_value) {
                    return $value / $pivot_value;
                }, $tableau[$pivot_row_index]);
            
                // Étape 2 : Pour chaque ligne autre que la ligne pivot, effectuez la soustraction
                for ($i = 0; $i < count($tableau); $i++) {
                    if ($i !== $pivot_row_index) {
                        $factor = $tableau[$i][$column_index]; // Valeur de la cellule correspondante dans la colonne de la variable entrante
                        $tableau[$i] = array_map(function($pivot, $cell) use ($factor) {
                            return $cell - ($factor * $pivot);
                        }, $tableau[$pivot_row_index], $tableau[$i]);
                    }
                }
            
                return $tableau;
            }
            
            // Appliquer la méthode d'élimination de Gauss
$tableau = gaussElimination($tableau, $pivot_row_index, $entering_variable, $noms_variables);

// Afficher le tableau mis à jour
echo "<h2>4.4 Changement -> GAUSS :</h2>";
afficherTableauSimplexe($tableau, array_merge($noms_variables, ['=']));  



function hasNegativeValues($tableau) {
    foreach ($tableau[0] as $value) {
        if ($value < 0) {
            return true; // If any negative value is found, return true immediately
        }
    }
    return false; // If no negative values are found, return false after checking all values
}

// Test if there are negative values in the tableau
if (hasNegativeValues($tableau)) {
    echo "<p><h2> 4.5 Test négatif : </h2> <h4>Il y a des valeurs négatives dans le tableau.</h4>";

    do {
        // Identifier la variable entrante
        $entering_variable = identifyEnteringVariable($tableau, $noms_variables);
        
        // Sélectionner la ligne pivot
        $pivot_row_index = selectPivotRow($tableau, $entering_variable, $noms_variables);
        
        // Extraire la valeur pivot
        $pivot_value = extractPivot($tableau, $pivot_row_index, $entering_variable, $noms_variables);
        
        // Effectuer l'élimination de Gauss
        $tableau = gaussElimination($tableau, $pivot_row_index, $entering_variable, $noms_variables);

        // Afficher le tableau final
        echo "<h2>Tableau final :</h2>";
        afficherTableauSimplexe($tableau, array_merge($noms_variables, ['=']));
         
           // Récupérer la valeur de Z à partir de la première ligne
    $valeur_Z = $tableau[0][count($tableau[0]) - 1];
    
    // Initialiser la conclusion avec Z*
    $conclusion = "Z* = " . $valeur_Z; // Récupérer la valeur de Z
        // Extraire et afficher les variables de base et hors base
        $infos_variables = extractBasicAndNonBasicVariables($tableau, $noms_variables);
        $variables_base = $infos_variables['basic'];
        $variables_hors_base = $infos_variables['non_basic'];
        
        echo "<h2><br><br>Variables de Base :</h2>";
        echo implode(", ", $variables_base);
        echo "<h2><br>Variables Hors Base :</h2>";
        echo implode(", ", $variables_hors_base);
        echo "<h4>Z=0</h4>";
 

    foreach ($variables_base as $variable) {
        // Trouver l'index de la colonne correspondant à cette variable
        $colonne_variable = array_search($variable, $noms_variables);
    
        // Parcourir chaque ligne pour trouver la valeur correspondant à cette variable
        foreach ($tableau as $ligne) {
            // Si la valeur dans cette colonne est égale à 1, prendre la valeur de la dernière colonne de cette ligne
            if ($ligne[$colonne_variable] == 1) {
                $valeur_variable_base = $ligne[count($tableau[0]) - 1]; // Récupérer la valeur de la variable de base
                $conclusion .= ", $variable* = $valeur_variable_base"; // Ajouter cette valeur à la conclusion
                break; // Sortir de la boucle une fois que la valeur a été trouvée
            }
        }
    }
    
    // Afficher la conclusion
    echo "<h2>Conclusion :</h2>";
    echo $conclusion;
    
    } while (hasNegativeValues($tableau));
} else {
    echo "<p><h2>Test positif :</h2>  Il n'y a pas de valeurs négatives dans le tableau.</p>";

    // Récupérer la valeur de Z à partir de la première ligne
    $valeur_Z = $tableau[0][count($tableau[0]) - 1];
    
    // Initialiser la conclusion avec Z*
    $conclusion = "Z* = " . $valeur_Z; // Récupérer la valeur de Z
    
    // Parcourir chaque variable de base
    $infos_variables = extractBasicAndNonBasicVariables($tableau, $noms_variables);
    $variables_base = $infos_variables['basic'];
    $variables_hors_base = $infos_variables['non_basic'];
    echo "<h2><br><br>Variables de Base :</h2>";
    echo implode(", ", $variables_base);
    echo "<h2><br>Variables Hors Base :</h2>";
    echo implode(", ", $variables_hors_base);
    echo "<h4>Z=0</h4>";
    foreach ($variables_base as $variable) {
        // Trouver l'index de la colonne correspondant à cette variable
        $colonne_variable = array_search($variable, $noms_variables);
    
        // Parcourir chaque ligne pour trouver la valeur correspondant à cette variable
        foreach ($tableau as $ligne) {
            // Si la valeur dans cette colonne est égale à 1, prendre la valeur de la dernière colonne de cette ligne
            if ($ligne[$colonne_variable] == 1) {
                $valeur_variable_base = $ligne[count($tableau[0]) - 1]; // Récupérer la valeur de la variable de base
                $conclusion .= ", $variable* = $valeur_variable_base"; // Ajouter cette valeur à la conclusion
                break; // Sortir de la boucle une fois que la valeur a été trouvée
            }
        }
    }
    
    // Afficher la conclusion
    echo "<h2>Conclusion :</h2>";
    echo $conclusion;
}




?>
      
          
          <form action="index.php" method="get">
   <br>
    <button type="submit">Revenir à l'étape précèdente</button>
</form>
    </div>
</body>
</html>
