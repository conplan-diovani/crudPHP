<html>
    <head>

    </head>
    <body>
        <h1>Lista de Clientes</h1>
        <div class="content">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOME</th>
                        <th>EMAIL</th>
                        <th>NUMERO</th>
                    </tr>
                </thead>
                <tbody>
                    <?
                        foreach($resultData as $data): 
                    ?>
                    <td><?=$data['id']?></td> 
                    <td><?=$data['name']?></td>
                    <td><?=$data['email']?></td>
                    <td><?=$data['phone']?></td>
                    <button>Excluir</button>
                    <button>Editar</button>
                    <?endforeach;?>
                </tbody>
            </table>
        </div>
    </body>
</html>