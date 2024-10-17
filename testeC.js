import http from 'k6/http';
import { check, sleep } from 'k6';

export let options = {
    vus: 100, // 100 usu�rios virtuais
    duration: '30s', // Dura��o do teste
};

export default function () {
    if (Math.random() < 0.25) {
        // 25% chance de leitura
        let res = http.get('http://localhost/crudPHP/configuration/api.php');
        check(res, { 'status was 200': (r) => r.status === 200 });
    } else {
        // 75% chance de escrita
        let payload = JSON.stringify({
            nome: `Teste ${Math.random().toString(36).substring(7)}`,
            idade: Math.floor(Math.random() * 100),
        });
        let res = http.post('http://localhost/crudPHP/configuration/api.php', payload, {
            headers: { 'Content-Type': 'application/json' },
        });
        check(res, { 'status was 201': (r) => r.status === 201 });
    }
    sleep(1);
}
