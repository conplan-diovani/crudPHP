<html>
<head></head>
<body>
    <h1>Lista de Clientes</h1>
    <a href="index.php?a=addForm">Adicionar Cliente</a>
    <div class="content">
        <table class="table">
            <thead>
                <tr>
                    <th>NÚMERO</th>
                    <th>ID</th>
                    <th>NOME</th>
                    <th>EMAIL</th>
                    <th>NUMERO</th>
                    <th>AÇÕES</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=0; foreach($resultData as $data): $i++?>
                    <tr>
                        <td><?=$i?></td>
                        <td><?=$data['id']?></td> 
                        <td><?=$data['name']?></td>
                        <td><?=$data['email']?></td>
                        <td><?=$data['phone']?></td>
                        <td>
                            <a href="index.php?a=editForm&id=<?=$data['id']?>">Editar</a>
                            <a href="index.php?a=delete&id=<?=$data['id']?>" onclick="return confirm('Deseja realmente excluir este cliente?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
