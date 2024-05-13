  
  
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
            text-decoration: underline;
            font-family: Arial, sans-serif;
        }

        label {
            font-weight: bold;
            color: #555;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solide #ccc;
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

        .hint {
            font-size: 14px;
            color: #777;
            margin-top: -10px;
            margin-bottom: 20px;
        }

        .instructions {
            font-size: 18px;
            color: #ff0000;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .title {
            text-decoration: underline;
            font-family: monospace;
            font-size: 18px;
            color: #555;
            margin-bottom: 10px;
            text-align: center;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>1. Le Programme Linéaire :</h2>
        <div class="instructions">
            <p>*Assurez-vous d'entrer toutes les valeurs correctement*</p>
        </div>
        
        <form action="vecart.php" method="post" class="form-group">
            <!--Variables -->
            <label class="title" for="variables">1. Variables *:</label>
            <textarea id="variables" name="variables" rows="4" placeholder="x est...produit par semaine/jour/heure... y est...produit par semaine/jour/heure..."></textarea>

            <!--Objectif -->
            <label class="title" for="objectif">2. Objectif max(Z) * :</label>
            <input type="text" id="objectif" name="objectif" placeholder="Z = ax + by + ..." />

            <!--Contraintes--> 
            <label class="title" for="contraintes">3. Contraintes *:</label>
            <textarea id="contraintes" name="contraintes" rows="6" placeholder="ax + by ≤ c"></textarea>
            <h3>Avec :  x>=0 , y >=0 </h3>
            <!--Bouton de soumission -->
            <button type="submit">ETAPES <br> 2 ET 3<br></button>
        </form><br> 
            <form action="intro.php" method="get">
    <button type="submit">Revenir à l'introduction</button>
</form>
        
    </div> 




    
</body>
</html>

    