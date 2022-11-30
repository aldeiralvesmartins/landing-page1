<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Landing Page</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&family=Open+Sans:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="assets/css/elementes.css">
  <link rel="stylesheet" href="assets/css/classes.css">
  <link rel="stylesheet" href="assets/css/variables.css">
  <link rel="stylesheet" href="assets/css/menu.css">
  <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body class="main-bg">
  <aside class="menu">
    <div class="main-content menu-content">
      <h1><a href="#home">HOME</a></h1>
      <div id="div"><input type="search" name="pesquisar" placeholder="Pesquisar" id="pesquisar"><button onclick="searchData()" id="pesquisar">pesquisar</button></div>
      <nav>
        <ul>
          <li><a href="#intro">intro</a></li>
          <li><a href="#grid-one">grid-one</a></li>
          <li><a href="#gallery">gallery</a></li>
          <li><a href="#pricing">pricing</a></li>
          <li><a href="#contact">contact</a></li>
        </ul>
      </nav>
    </div>
  </aside>
  <div class="menu-spacing"></div>

  <section id="home" class="intro main-bg section">
    <div class="main-content intro-content">


      <div class="contact-form">
        <fieldset class="form-grid">
          <legend>Contact me</legend>

          <div class="form-group">
            <label>Nome</label>
            <input type="text" placeholder=" " name="nomeCliente" v id="nomeCliente">
          </div>
          <div class="form-group">
            <label>Data da compra</label>

            <input type="date" name="dtPedido" id="dtPedido" value="<?php echo $dtPedido ?>"><br><br>

          </div>
          <div class="form-group">
            <label>CPF</label>

            <input type="text" placeholder="" name="cpfCliente" id="cpf"><br><br>
          </div>
          <div class="form-group full-width">
            <label for="message">Message</label>
            <textarea name="message" id="message" cols="30" rows="10" placeholder="You message"></textarea>
          </div>
          <div class="form-group full-width">
            <button type="submit">Send message</button>
          </div>

        </fieldset>
      </div>
    </div>



  </section>
  <section id="intro" class="white-bg section">
    <div class="main-content top3-content">

    </div>
  </section>


  <section id="grid-one" class="grid-one main-bg section">
    <div class="main-content grid-one-content">

    </div>
  </section>

  <section id="gallery" class="grid-one white-bg section">
    <div class="main-content grid-one-content">

    </div>
  </section>

  <section id="pricing" class="white-bg section">
    <div class="main-content top3-content">
      <h2>Listagem de Cliente</h2>

      <div class="responsive-table">


      </div>

    </div>
  </section>



</body>

</html>