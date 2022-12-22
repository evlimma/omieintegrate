<?php

namespace BeeDelivery\Omie;


use BeeDelivery\Omie\Connection;

class Categoria
{

    public $http;

    public function __construct($apiKey = null, $apiSecret = null)
    {
        $this->http = new Connection($apiKey, $apiSecret);
    }

    /**
     * Lista as categorias cadastradas.
     *
     * @see https://app.omie.com.br/api/v1/geral/categorias/#ListarCategorias
     * @param Integer $pagina, $registros_por_pagina
     * @param String $apenas_importado, S/N
     * @return json
     */
    public function listar($pagina = 1, $registros_por_pagina = 50, $apenas_importado_api = 'N')
    {
        return $this->http->post('/geral/categorias/', [

            'pagina'                => $pagina,
            'registros_por_pagina'  => $registros_por_pagina,
            'apenas_importado_api'  => $apenas_importado_api,

        ],  'ListarCategorias');
    }
}
