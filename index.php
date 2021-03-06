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
    $id_name = $pokemon_name = $pokemon_id = $pokemon_image = $moves = $visible = $name_ID_error = $evolutions = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["nameIDPoke"])) {
            $name_ID_error = "Name is required";
        } else {
            $id_name = test_input($_POST["nameIDPoke"]);

            $api_url = "https://pokeapi.co/api/v2/pokemon/";
            $json_data = file_get_contents($api_url . strtolower($id_name) . '/');
            $pokemon_response = json_decode($json_data, true);

            $visible = 'visible';

            $pokemon_name = $pokemon_response['forms']['0']['name'];
            $pokemon_id = $pokemon_response['id'];

            $pokemon_moves = [];
            if (count($pokemon_response['moves']) > 1){
                for ($i = 0; $i < 4; $i++) {
                    $pokemon_move = $pokemon_response['moves'][$i]['move']['name'];
                    array_push($pokemon_moves, $pokemon_move);
                }
            } else if (count($pokemon_response['moves']) === 1){
                $pokemon_one_move = $pokemon_response['moves']['0']['move']['name'];
                array_push($pokemon_moves, $pokemon_one_move);
            }

            $moves = implode(" ", $pokemon_moves); //makes a string of the array

            $pokemon_image = $pokemon_response['sprites']['other']['home']['front_default'];

            //POKEMON SPECIES
            $species_url = $pokemon_response['species']['url'];
            $species = file_get_contents($species_url);
            $species_response = json_decode($species, true);
            //POKEMON EVOLUTION CHAIN
            $evolution_chain_url = $species_response['evolution_chain']['url'];
            $evolution_chain = file_get_contents($evolution_chain_url);
            $evolution_chain_response = json_decode($evolution_chain, true);
            //POKEMON EVOLUTIONS
            $evolutions_array = [];
            $pokemon_born_form = $evolution_chain_response['chain']['species']['name'];
            array_push($evolutions_array, $pokemon_born_form);
            if(count($evolution_chain_response['chain']['evolves_to']) > 0){
                $pokemon_first_evolution = $evolution_chain_response['chain']['evolves_to']['0']['species']['name'];
                array_push($evolutions_array, $pokemon_first_evolution);
                //EEVEE
                if(count($evolution_chain_response['chain']['evolves_to']) > 1){
                    for ($i = 0; $i < 8; $i++) {
                        $pokemon_eevee_evolution = $evolution_chain_response['chain']['evolves_to'][$i]['species']['name'];
                        array_push($evolutions_array, $pokemon_eevee_evolution);
                    }
                }
            }
            if(count($evolution_chain_response['chain']['evolves_to']['0']['evolves_to']) > 0){
                $pokemon_second_evolution = $evolution_chain_response['chain']['evolves_to']['0']['evolves_to']['0']['species']['name'];
                array_push($evolutions_array, $pokemon_second_evolution);
            }
            //$evolutions = array_push($evolutions_array, $pokemon_born_form, $pokemon_first_evolution, $pokemon_second_evolution);
            $evolve = implode(" ", $evolutions_array);


        }
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
                <span class="error">* <?php echo $name_ID_error;?></span>
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
                        <span id="pokemonMoves"><?php echo $moves; ?></span>
                    </div>
                </div>
            </div>

            <div class="evolutionContainer">
                <span id="firstForm"> <?php
                    //echo $pokemon_born_form;
                    //echo $pokemon_first_evolution;
                    //echo $pokemon_second_evolution;
                    echo $evolve;
                    ?></span>
                <span id="firstEvolution"></span>
                <span id="secondEvolution"></span>
            </div>

        </section>

</body>
</html>