<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Méthode du Simplexe</title>
    <style>
        body {
            background-image: url('https://img.freepik.com/vecteurs-libre/arriere-plan-texture-aquarelle-vert-doux-moderne_1055-18276.jpg');
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }
       
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            line-height: 1.6;
        }
        h1, h2 {
            text-align: center;
        }
        h1 {
            color: #004085;
            margin-top: 0;
            font-size: 36px;
            text-decoration: underline;
        }
        .encadrer-h1 {
            border: 2px solid #333; /* Couleur et épaisseur de la bordure */
            padding: 10px; /* Espace à l'intérieur du cadre */
            border-radius: 5px; /* Coins arrondis */
            background-color: #f9f9f9; /* Couleur de fond */
        }
        h2 {
            color: #1e7e34;
            margin-top: 20px;
            text-decoration: underline;
        }
        p, ul {
            margin-bottom: 20px;
            text-align: center;
        }
        ul {
            padding-left: 20px;
        }
        pre {
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
            overflow-x: auto;
        }
        pre code {
            font-family: Consolas, Monaco, 'Andale Mono', 'Ubuntu Mono', monospace;
            font-size: 14px;
            color: #333;
        }
        .button {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #0056b3;
        }
        .logo {
            position: absolute;
            top: 20px;
            left: 20px;
            width: 250px; /* ajustez la taille selon vos besoins */
            height: auto;
        }
        .highlight {
            text-decoration: underline;
        }
        button[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 30px;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }
        .form-group {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

    </style>
</head>
<body>
<img src="https://emsi.ma/wp-content/uploads/2020/07/logo-1.png" alt="Logo" class="logo">
    <div class="container">
    <h1 class="encadrer-h1">Méthode Simplexe</h1>
        
        
        
        <p>-La méthode du Simplexe est un algorithme d'optimisation utilisé pour résoudre les problèmes de programmation linéaire. <br>-Elle a été développée par <span class="highlight">George Dantzig</span> dans les années 1940.<br> -Cette méthode est largement utilisée dans de nombreux domaines tels que :<br>-l'économie,<br> -la gestion, <br>-l'ingénierie, etc.</p>
        
        <h2>Pourquoi utiliser cette méthode   ?</h2>
        <p>-La méthode du Simplexe est utilisée pour résoudre des problèmes d'optimisation linéaire. <br> Elle permet de trouver la solution optimale d'un problème de maximisation ou de minimisation, tout en respectant un ensemble de contraintes linéaires.</p>
        </div>

        <div class="container">
        <h1 class="encadrer-h1">les étapes à suivre pour la maximisation du programme </h1>
        
       
       <h2>ETAPE 1 : *le programme linéaire*</h2>
           <h3> *les variables.</h3>
           <h3> *l'objectif max(z).</h3>
           <h3> *les contraintes.</h3>
           
       <h2>ETAPE 2 : * Variable d'écart*</h2>
       <h3> *L'ajout des variables d'écarts aux contraintes d'inégalité pour les transformer en équations d'égalité.</h3> 
       <h3>Exemple : <br> l'equation économique : "Z=ax+by" -> "Z-ax-by = 0" </h3>
       <h3> la contrainte : "ax+by ≤ c"  -> "ax+by+e = c" </h3>
    <br>

      <h2>ETAPE 3 : *Tableau*</h2>
       <h3> *Afficher les variables avec ses valeurs correspond dans un tableau ,pour nous aidez dans l'étape 4 (L'itération)  .</h3>
       <h3> *Extraire du tableau VB ET VHB . </h3>

       <h2>ETAPE 4 : *l'itérations*</h2>
       <h3> 4.1 : colonne pivot*</h3>
       <h3> 4.2 : ligne pivot*</h3>
       <h3> 4.3 : le pivot*</h3>
       <h3> 4.4 : GAUSS*</h3>
       <h3> 4.5 : test* </h3> <br>

       <form action="index.php" method="post" class="form-group">    
       <button type="submit"> START </button>
       </form>   
    </div><br>

</body>
</html> 