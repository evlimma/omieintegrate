<?php

namespace EvLimma\OmieIntegrate;

/**
 * Description of General
 *
 * @author evlimma
 */
abstract class General
{
    protected $urlLink = 'https://app.omie.com.br/api/v1';
    protected $typeHeader = ['Content-Type: application/json'];
    protected $apiKey;
    protected $apiSecret;

    /**
     * 
     * @param string $apiKey
     * @param string $apiSecret
     */
    public function __construct(string $apiKey, string $apiSecret)
    {
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
    }

    /**
     * 
     * @param string $call
     * @param int $nRegPorPagina
     * @param int $nPagina
     * @param int $nCodigo
     * @param string $endpoint
     * @return \stdClass|null
     */
    public function list(string $call, int $nRegPorPagina, int $nPagina, int $nCodigo, string $endpoint): ?\stdClass
    {
        $curl = curl_init();

        $post = [
            'call' => $call,
            'app_key' => $this->apiKey,
            'app_secret' => $this->apiSecret,
            'param' => [[
                'pagina' => $nPagina,
                'registros_por_pagina' => $nRegPorPagina,
                'apenas_importado_api' => 'N'
            ]]
        ];
        
        // Adiciona o paramentro para filtro o c�digo
        if ($nCodigo) {
            $post['param'][0]['nCodigo'] = $nCodigo;
        }

        curl_setopt_array($curl, [
            CURLOPT_URL => "{$this->urlLink}/{$endpoint}",
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_HTTPHEADER => $this->typeHeader,
            CURLOPT_POSTFIELDS => json_encode($post)
        ]);

        $response = json_decode(curl_exec($curl));

        curl_close($curl);

        return is_object($response) ? $response : null;
    }

}
