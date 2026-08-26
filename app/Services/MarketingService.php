<?php

namespace App\SolucoesDigitais\Services;

class MarketingService
{
    public function getMarketingData(): array
    {
        return [
            'empresa' => '80u80 Soluções Digitais',
            'status'  => 'Área Pública Ativa',
            'cases'   => [
                ['id' => 1, 'titulo' => 'Campanha Black Friday', 'resultado' => '+140% em vendas'],
                ['id' => 2, 'titulo' => 'SEO Avançado B2B', 'resultado' => 'Top 1 no Google']
            ]
        ];
    }
}
