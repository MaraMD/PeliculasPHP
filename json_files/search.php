<?php
// Ruta al archivo JSON
$jsonFilePath = 'json_files/peliculas.json';

// Leer y decodificar el archivo JSON
$data = file_get_contents($jsonFilePath);
$movies = json_decode($data, true);

// Obtener el término de búsqueda desde la URL
$query = $_GET['q'] ?? '';

// Filtrar las películas basándose en el término de búsqueda
$filteredMovies = array_filter($movies, function($movie) use ($query) {
    return stripos($movie['title'], $query) !== false && $movie['status'] == 'activo';
});

// Devolver los resultados en formato JSON
echo json_encode(array_values($filteredMovies));
?>
