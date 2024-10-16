import http from 'k6/http';
import { check, sleep } from 'k6';

export let options = {
    vus: 100, // Número de usuários virtuais
    duration: '30s', // Duração do teste
};

export default function () {
    // 50% chance de fazer uma leitura
    if (Math.random() < 0.5) {
        // Operação de leitura: Listar registros
        let res = http.get('http://localhost/crudPHP/connect.php');
        check(res, { 'status was 200': (r) => r.status === 200 });
    } 
    // 50% chance de fazer uma escrita
    else {
        // Preparar dados para a operação de escrita
        let payload = JSON.stringify({
            nome: `Teste ${Math.random().toString(36).substring(7)}`, // Nome aleatório
            idade: Math.floor(Math.random() * 100), // Idade aleatória
        });

        // Operação de escrita: Adicionar um novo registro
        let res = http.post('http://localhost/crudPHP/connect.php', payload, {
            headers: { 'Content-Type': 'application/json' },
        });
        check(res, { 'status was 201': (r) => r.status === 201 });

        // Simular atualização (50% das vezes)
        if (Math.random() < 0.5) {
            let id = Math.floor(Math.random() * 100) + 1; // ID aleatório para atualizar (ajuste conforme necessário)
            let updatePayload = JSON.stringify({
                nome: `Teste Atualizado ${Math.random().toString(36).substring(7)}`,
                idade: Math.floor(Math.random() * 100),
            });
            let resUpdate = http.put(`http://localhost/crudPHP/connect.php?id=${id}`, updatePayload, {
                headers: { 'Content-Type': 'application/json' },
            });
            check(resUpdate, { 'status was 200': (r) => r.status === 200 });
        }

        // Simular exclusão (10% das vezes)
        if (Math.random() < 0.1) {
            let id = Math.floor(Math.random() * 100) + 1; // ID aleatório para excluir (ajuste conforme necessário)
            let resDelete = http.del(`http://localhost/crudPHP/connect.php?id=${id}`);
            check(resDelete, { 'status was 204': (r) => r.status === 204 });
        }
    }
    sleep(1); // Intervalo entre requisições
}
