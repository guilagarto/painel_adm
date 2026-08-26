<?php

namespace App\SolucoesDigitais\Services;

use App\SolucoesDigitais\Core\Database;

class AdminService
{
    public function getDashboardStats(): array
    {
        $db = Database::getConnection();

        $queryUsuarios = $db->query("SELECT COUNT(*) as total FROM usuarios");
        $totalUsuarios = $queryUsuarios->fetch()['total'];

        $queryProjetos = $db->query("SELECT COUNT(*) as total FROM projetos");
        $totalProjetos = $queryProjetos->fetch()['total'];

        $queryDesenvolvimento = $db->query("SELECT COUNT(*) as total FROM projetos WHERE status = 'Em Desenvolvimento'");
        $totalDesenvolvimento = $queryDesenvolvimento->fetch()['total'];

        return [
            'usuarios_ativos' => $totalUsuarios,
            'novos_leads'     => $totalProjetos,
            'projetos_ativos' => $totalDesenvolvimento,
            'alertas_sistema' => [
                ['tipo' => 'aviso', 'mensagem' => 'Painel de controle sincronizado com o XAMPP.']
            ]
        ];
    }
}
