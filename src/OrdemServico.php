<?php


namespace BeeDelivery\Omie;


use BeeDelivery\Omie\Connection;

class OrdemServico
{
    public $http;

    public function __construct($apiKey = null, $apiSecret = null)
    {
        $this->http = new Connection($apiKey, $apiSecret);
    }

    /**
     * Faturar uma OS
     *
     * @see https://app.omie.com.br/api/v1/servicos/osp//#FaturarOS
     * @param $ordemServico
     * @return array
     */
    public function faturar($ordemServico)
    {
        return $this->http->post(

            '/servicos/osp/',
            $ordemServico,
            'FaturarOS'
        );
    }

    /**
     * Incluir uma OS
     *
     * @see https://app.omie.com.br/api/v1/servicos/os//#IncluirOS
     * @param $ordemServico
     * @return array
     */
    public function upsert($ordemServico)
    {
        return $this->http->post(

            '/servicos/os/',
            $ordemServico,
            'IncluirOS'
        );
    }

    /**
     * Consultar OS
     *
     * @see https://app.omie.com.br/api/v1/servicos/os//#ConsultarOS
     * @param $ordemServico
     * @return array
     */
    public function consultar($ordemServico)
    {
        return $this->http->post(

            '/servicos/os/',
            $ordemServico,
            'ConsultarOS'
        );
    }

    /**
     * Status da OS
     *
     * @see https://app.omie.com.br/api/v1/servicos/os//#StatusOS
     * @param $ordemServico
     * @return array
     */
    public function status($ordemServico)
    {
        return $this->http->post(

            '/servicos/os/',
            $ordemServico,
            'StatusOS'
        );
    }
}
