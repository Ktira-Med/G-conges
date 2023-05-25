<?php 

function asset(string $path)
{
    return BASE_URL . '/' . $path;
}

function constructUrl(string $routeName, array $params = [])
{
    // Si la route donnée en paramètre n'existe pas on lance une exception
    if (!array_key_exists($routeName, ROUTES)) {
        throw new Exception('ERREUR : pas de route nommée ' . $routeName);
    }

    $url = BASE_URL . '/index.php' . ROUTES[$routeName]['path'];

    if ($params) {
        $url .= '?' . http_build_query($params);
    }

    return $url;
}

