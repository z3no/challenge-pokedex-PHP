<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Pokédex</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<?php

    //POKEMON API URL
    //$api_url = "https://pokeapi.co/api/v2/pokemon/";

    //TEST WITH ID VARIABLE
    //$id = 2;

    //TEST WITH FORM DATA
    $id_name = $pokemon_name = $pokemon_id = $pokemon_image = $moves = $visible = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_name = test_input($_POST["nameIDPoke"]);

        $api_url = "https://pokeapi.co/api/v2/pokemon/";
        $json_data = file_get_contents($api_url.$id_name.'/');
        $pokemon_response = json_decode($json_data, true);

        $visible = 'visible';

        $pokemon_name = $pokemon_response['forms']['0']['name'];
        $pokemon_id = $pokemon_response['id'];

        /*$pokemon_moves = [];
        for ($i = 0; $i < 4; $i++){
            $pokemon_move = $pokemon_response['moves'][$i]['move']['name'];
            array_push($pokemon_moves, $pokemon_move);
        }
        $moves = implode(" ", $pokemon_moves); //makes a string of the array
        */
        //$pokemon_moves = $pokemon_response['moves'][0]['move']['name'];

        $pokemon_image = $pokemon_response['sprites']['other']['home']['front_default'];

        $species_url = $pokemon_response['species']['url'];
        $species = file_get_contents($species_url);
    }

    function test_input ($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //READ THE JSON FILE
    //$json_data = file_get_contents($api_url.$id_name.'/');

    //DECODE JSON DATA INTO PHP ARRAY
    //$pokemon_response = json_decode($json_data, true);

    //THE POKEMON NAME
    //$pokemon_name = $pokemon_response['forms']['0']['name'];
    //var_dump($pokemon_name);
    //THE POKEMON ID
    //$pokemon_id = $pokemon_response['id'];
    //var_dump($pokemon_id);
    //THE POKEMON MOVES
    /*$pokemon_moves = [];
    for ($i = 0; $i < 4; $i++){
        $pokemon_move = $pokemon_response['moves'][$i]['move']['name'];
        array_push($pokemon_moves, $pokemon_move);
    }*/
    //var_dump($pokemon_moves);
    //THE POKEMON IMAGE
    //$pokemon_image = $pokemon_response['sprites']['other']['home']['front_default'];
    //var_dump($pokemon_image);

?>
        <section class="logo">
            <img src="images/pokemon-logo.png" alt="Pokémon logo">
        </section>

        <section class="search">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <input type="text" id="pokemon" name="nameIDPoke" placeholder="ID or Name"/>
                <div class="actions">
                    <button type="submit" id="search" value="search" name="searchPokemon">Search</button>
                </div>
            </form>
        </section>

        <!--<section>
            <p>
                <?php
                    echo $pokemon_name;
                ?>
            </p>
            <p>
                <?php
                    echo $pokemon_id;
                ?>
            </p>
            <p>
                <?php
                    echo $moves;
                ?>
            </p>
            <img src="<?php echo $pokemon_image ?>" alt="Pokemon Image">
        </section>-->

        <section class="display hidden <?php echo $visible ?>">

            <div class="card">
                <div class="imageContainer" id="pokemonImageContainer"><img src="<?php echo $pokemon_image ?>" alt="Pokemon Image"></div>

                <div class="cardContent">
                    <h1 id="pokemonName"><?php echo $pokemon_name; ?></h1>

                    <div class="id">
                        <h2>ID : </h2>
                        <span id="pokemonID"><?php echo $pokemon_id; ?></span>
                    </div>

                    <div class="moves">
                        <h2>Moves :</h2>
                        <span id="pokemonMoves">
                            <?php
                                if (isset($_POST["nameIDPoke"])) {
                                    for ($i = 0; $i < 4; $i++){
                                        echo $pokemon_response['moves'][$i]['move']['name'];
                                    }
                                } ?></span>
                    </div>
                </div>
            </div>

            <div class="evolutionContainer">
                <span id="firstForm"></span>
                <span id="firstEvolution"></span>
                <span id="secondEvolution"></span>
            </div>

        </section>

</body>
</html>