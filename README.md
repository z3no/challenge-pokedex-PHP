# `The Pokedex Challenge with PHP`
****
****
## `Our learning objectives`
- Starting with PHP `(entering a new world)`
  * We should be able to write a simple condition and a simple loop
  * Learn how to access external resources (API)
- Know where to search for PHP documentation
- Find out how much easier it is to learn a second programming language

## `The Mission`
Today we are re-creating the Pokédex we made with JavaScript, only this time it is obvious we will be using PHP instead of JS.

So let's take a deep breath and see how we can tackle this. Let's do this!

## `Some Tips`
We got a few links to some functions that will help us get on our way.

- [file_get_contents()](http://php.net/file_get_contents)
- [json_decode()](http://php.net/json_decode)
- [var_dump() - to help you debug](http://php.net/var_dump) - `console.log family?!`

Be careful to get an `array`, not an `object`, back from **_json_decode()_**. Read the documentation on how to do this.
You could do it with `objects`, but it will be more difficult.

## `How to search for PHP documentation`
PHP has very good documentation available on www.php.net. There is a nice trick you can use to quickly get documentation on any php function. Just type in the browser php.net/FUNCTION_NAME and you will arrive at the correct documentation page. Also spend some time clicking on the "See also" section at the bottom of each page, this will quickly get you a good overview of what is possible with PHP.

## `PHP the right way`
Another interesting read is http://phptherightway.com. This is not so much documentation over each separate function, but gives you more an overview of best practices and how different components work together.

## `Getting started`
I think I will first look into the documentation of php.net and phptherightway.com and see how I should takle this step by step. I can re-use a lot of code from my previously made Pokédex, so let's take some time to read and take it step by step.

1) So first I copied the html file from my previous Pokédex and renamed the index.html to index.php. I put the files into the becode.localhost we made yesterday, there I can see the new repo I made with index.php, so it shows all the styling I had before and now I have to make sure the JavaScript code I used is replaced with php to make everything work.
2) I was really struggling, getting the response from the API was fine, but then accessing the data inside the API was some serious searching. In the end I found a way, I'm first focussing on how to get all the data I need and afterwards seeing how I can get this data by filling in the input field. Taking it step by step.
