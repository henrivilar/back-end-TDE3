<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="View/style.css" />
  <title>Agencia de Viagens | SafeTravel</title>
</head>

<body>
  <header>
    <img src="View/imgs/logo.png" alt="Logo" />
    <h2>SafeTravel</h2>
  </header>

  <main>
    <section class="text">
      <div class="hero">
        <img src="View/imgs/travel-the-world.png" alt="" />
        <h1>Descubra o mundo!</h1>
      </div>
      <h2>Escolha a SafeTravel e tenha uma experiência inesquecível!</h2>
    </section>

    <section class="form">
      <h2><?= isset($_GET['editar_id']) ? 'Editar viagem' : 'Adicione uma nova viagem' ?></h2>
      <?= $mensagem ?? "" ?>

      <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
        <label>Destino:
          <select name="destino" required>
            <option value="">Selecione</option>
            <option value="Rio de Janeiro" <?= $destino === "Rio de Janeiro" ? "selected" : "" ?>>Rio de Janeiro
            </option>
            <option value="São Paulo" <?= $destino === "São Paulo" ? "selected" : "" ?>>São Paulo</option>
          </select>
        </label><br />

        <label>Data Ida:
          <input type="date" name="data_ida" min="<?= date('Y-m-d') ?>" required value="<?= $data_ida ?>" />
        </label><br />

        <label>Data Volta:
          <input type="date" name="data_volta" min="<?= date('Y-m-d') ?>" required value="<?= $data_volta ?>" />
        </label><br />

        <label>Valor:
          <input type="number" name="valor" step="0.01" min="0.01" required value="<?= $valor ?>" />
        </label><br />

        <?php if ($editar_id): ?>
        <input type="hidden" name="editar_id" value="<?= $editar_id ?>" />
        <button type="submit">Atualizar</button>
        <a href="<?= $_SERVER['PHP_SELF'] ?>">Cancelar edição</a>
        <?php else: ?>
        <button type="submit" name="acao" value="salvar">Salvar</button>
        <?php endif; ?>
      </form>
    </section>
  </main>

  <section class="lista-viagens">
    <h2>Lista de Viagens</h2>
    <ul>
      <?php foreach ($viagens as $v): ?>
      <li>
        <img id="imagemDestino" src="View/imgs/travel-the-world.png" alt="Imagem do destino" />
        <p><strong>Destino:</strong> <?= $v->getDestino() ?></p>
        <p><strong>Ida:</strong> <?= date("d/m/Y", strtotime($v->getData_ida())) ?></p>
        <p><strong>Volta:</strong> <?= date("d/m/Y", strtotime($v->getData_volta())) ?></p>
        <p><strong>Valor:</strong> R$ <?= number_format($v->getValor(), 2, ",", ".") ?></p>
        <div class="botoes">
          <form method="get" action="<?= $_SERVER['PHP_SELF'] ?>" style="display:inline;">
            <input type="hidden" name="editar_id" value="<?= $v->getId() ?>" />
            <button type="submit" class="editar">Editar</button>
          </form>

          <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>" style="display:inline;">
            <input type="hidden" name="excluir_id" value="<?= $v->getId() ?>" />
            <button type="submit" class="excluir"
              onclick="return confirm('Tem certeza que deseja excluir esta viagem?')">Excluir</button>
          </form>
        </div>
      </li>
      <?php endforeach; ?>
    </ul>
  </section>

</body>

</html>