<?php

namespace EvLimma\OmieIntegrate;

class Oportunidades extends General
{
    protected $endpoint = 'crm/oportunidades/';

    /**
     * 
     * @param string $apiKey
     * @param string $apiSecret
     */
    public function __construct(string $apiKey, string $apiSecret)
    {
        parent::__construct($apiKey, $apiSecret);
    }

    public function listar(int $nRegPorPagina = 500, int $nPagina = 1): ?\stdClass
    {
        $post = [
            'call' => 'ListarOportunidades',
            'param' => [[
                'pagina' => $nPagina,
                'registros_por_pagina' => $nRegPorPagina
            ]]
        ];

        $render = parent::list($post, $this->endpoint);

        if (empty($render->cadastros)) {
            return null;
        }

        return $render;
    }

    public function incluir(array $data): ?\stdClass
    {
        $post = [
            'call' => 'IncluirOportunidade',
            'param' => [[
                'identificacao' => [
                    'cCodIntOp' => $data["cCodIntOp"],
                    'cDesOp' => $data["cDesOp"],
                    'nCodConta' => $data["nCodConta"],
                    'nCodContato' => $data["inOmieContato"],
                    'nCodOrigem' => $data["omor_nCodigo"],
                    'nCodSolucao' => $data["omso_nCodigo"],
                    'nCodVendedor' => $data["nCodVendedor"],
                    'cNumOp' => $data["cNumOp"],
                ]
            ]]
        ];

        $render = parent::list($post, $this->endpoint);

        return $render;
    }

    public function consultar(string $nCodigo = ""): ?\stdClass
    {
        $post = [
            'call' => 'ConsultarOportunidade',
            'param' => [[
                'cCodIntOp' => $nCodigo
            ]]
        ];

        $render = parent::list($post, $this->endpoint);

        if (empty($render->identificacao)) {
            return null;
        }

        return $render;
    }

    public function alterar(array $data): ?\stdClass
    {
        if (empty($data['cCodIntOp'])) {
            return null;
        }

        $post = [
            'call' => 'AlterarOportunidade',
            'param' => [[
                'identificacao' => array_filter([
                    'cCodIntOp'   => $data['cCodIntOp'],
                    'cDesOp'      => $data['cDesOp'] ?? null,
                    // 'nCodConta'   => $data['nCodConta'] ?? null,
                    // 'nCodContato' => $data['inOmieContato'] ?? null,
                    // 'nCodVendedor' => $data['nCodVendedor'] ?? null,
                    'nCodSolucao' => $data['omso_nCodigo'] ?? null,
                    'nCodOrigem'  => $data['omor_nCodigo'] ?? null,
                ], fn($v) => $v !== null)
            ]]
        ];

        return parent::list($post, $this->endpoint);
    }
}
