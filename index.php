<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Pokédex</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

        <section class="logo">
            <img src="images/pokemon-logo.png" alt="Pokémon logo">
        </section>

        <section class="search">
            <input type="text" name="pokemon" id="pokemon" placeholder="ID or Name"/>
            <div class="actions">
                <button type="button" id="search">Search</button>
            </div>
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