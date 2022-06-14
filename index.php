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
    $api_url = "https://pokeapi.co/api/v2/pokemon/";

    //TEST WITH ID VARIABLE
    $id = 2;

    //READ THE JSON FILE
    $json_data = file_get_contents($api_url.$id.'/');

    //DECODE JSON DATA INTO PHP ARRAY
    $pokemon_response = json_decode($json_data);

    //THE POKEMON NAME
    $pokemon_name = $pokemon_response->name;
    var_dump($pokemon_name);
    //THE POKEMON ID
    $pokemon_id = $pokemon_response->id;
    var_dump($pokemon_id);
    //THE POKEMON MOVES
    $pokemon_moves = [];
    for ($i = 0; $i < 4; $i++){
        $pokemon_move = $pokemon_response->moves[$i]->move->name;
        array_push($pokemon_moves, $pokemon_move);
    }
    var_dump($pokemon_moves);

?>
        <section class="logo">
            <img src="images/pokemon-logo.png" alt="Pokémon logo">
        </section>

        <section class="search">
            <form action="" method="post">
                <input type="text" id="pokemon" name="pokemonIdName" placeholder="ID or Name"/>
                <div class="actions">
                    <button type="button" id="search" value="search" name="searchPokemon">Search</button>
                </div>
            </form>
        </section>

        <section>
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
                    echo $pokemon_moves[0].'<br>'.$pokemon_moves[1].'<br>'.$pokemon_moves[2].'<br>'.$pokemon_moves[3];
                ?>
            </p>
        </section>

        <section class="display">

            <div class="card">
                <div class="imageContainer" id="pokemonImageContainer"></div>

                <div class="cardContent">
                    <h1 id="pokemonName"></h1>

                    <div class="id">
                        <h2>ID : </h2>
                        <span id="pokemonID"></span>
                    </div>

                    <div class="moves">
                        <h2>Moves :</h2>
                        <span id="pokemonMoves"></span>
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