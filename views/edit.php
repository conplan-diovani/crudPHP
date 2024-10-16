<html>
<head></head>
<body>
    <h1>Editar Cliente</h1>
    <form method="POST" action="index.php?a=update">
        <input type="hidden" name="id" value="<?=$client['id']?>">
        <input type="text" name="name" value="<?=$client['name']?>" required>
        <input type="email" name="email" value="<?=$client['email']?>" required>
        <input type="text" name="phone" value="<?=$client['phone']?>" required>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>
