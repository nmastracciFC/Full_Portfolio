<?php
//this is the URL path to get a JSON object http://localhost:8888/movies_a/admin/scripts/getMovies.php
//this is the URL path to get the results http://localhost:8888/movies_a/admin/scripts/getMovies.php?filter=action
//the results will not look like anything other than SQL and should give you an error
ini_set('display_errors', 1);
error_reporting(E_ALL);

//label in the URL.. go and collect whatevr is being stored in filter $_GET is a SUPERGLOBAL
// $filter = $_GET['filter'];
// echo $filter;


//include just takes the files and runs them completely
include('connect.php');
//if the filter is set
if(isset($_GET['filter'])) {
	//1.) showing movies by genre
	// echo "Yes!"
	$filter = $_GET['filter'];
	$filterQuery = "SELECT m.movies_id, m.movies_cover, m.movies_title, m.movies_year FROM tbl_movies m, tbl_genre g, tbl_mov_genre mg WHERE m.movies_id = mg.movies_id AND g.genre_id = mg.genre_id AND g.genre_name = '{$filter}'";
	// echo $filterQuery;
	$getMovies=mysqli_query($link, $filterQuery);

} else if (isset($_GET['id'])){
	//Select single movie
	$id = $_GET['id'];
	$singleQuery = "SELECT * FROM tbl_movies WHERE movies_id = {$id}";
	$getMovies = mysqli_query($link, $singleQuery);


} else if (isset($_GET['srch'])) {
	//select movie that user searched
	$srch = $_GET['srch'];
	$srchQuery = "SELECT movies_id, movies_cover, movies_title, movies_year FROM tbl_movies WHERE movies_title LIKE '$srch%' ORDER BY movies_title ASC";
	echo $srchQuery;
	$getMovies = mysqli_query($link, $srchQuery);


}else {
	//4.) select all movies
	$movieQuery = "SELECT movies_id, movies_cover, movies_title, movies_year FROM tbl_movies ORDER BY movies_title ASC"; 
	//Sets up the connection between the gateway and the query
	$getMovies = mysqli_query($link, $movieQuery);
}

//having this empty forces the variable to empty every time
$grpResult = "";

//build the structure of the JSON(open)
echo "[";

//loop though the associative array
while($movResult = mysqli_fetch_assoc($getMovies)) {
	// echo $movResult['movies_title']; //returns all the movie titles

	//makes the associative array a json object
	$jsonResult = json_encode($movResult); //except by itself there is no comma!
	$grpResult .= $jsonResult.","; //places the comma between all the results through concatenation
	// echo $jsonResult;
	//but wait theres a comma on the last result that we shouldn't have
}
//go inside the string and remove the last comma
echo substr($grpResult, 0, -1); //grpResult, go back from zero, minus one, and delete the object there

//build the structure of the JSON(close)
echo "]";

//kill and destroys the connection so that the port does not stay open to hack
mysqli_close($link);






?>