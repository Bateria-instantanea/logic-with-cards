<?php /* index2.php */ ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Lógica de Programação com Baralho</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
  :root{
    --accent: #b01212;
    --accent-dark:#900e0e;
    --bg: #fafafa;
    --card-border: rgba(0,0,0,0.06);
    --muted: #6c6c6c;
  }

  html,body{ height:100%; }

  body{
    background: linear-gradient(180deg,var(--bg), #f2f2f2 60%);
    color:#111;
    font-family: Inter, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    -webkit-font-smoothing:antialiased;
    -moz-osx-font-smoothing:grayscale;
    margin:0;
  }

  header.site-header{
    background: #0b0b0b;
    color: #fff;
    padding: 22px 0;
    box-shadow: 0 6px 18px rgba(0,0,0,0.18);
  }
  .site-title { font-weight:700; letter-spacing:0.2px; margin:0; font-size:1.35rem; }
  .site-sub { color:#dcdcdc; margin:6px 0 0; font-size:0.95rem; }

  .container-main{
    max-width:1100px;
    margin:28px auto;
    padding: 0 16px 40px;
  }

  .intro {
    background: #fff;
    border-radius: 14px;
    padding: 20px;
    border-left: 6px solid var(--accent);
    box-shadow: 0 10px 30px rgba(16,24,40,0.06);
  }
  .intro h2 { font-size:1.15rem; margin-bottom:6px; }
  .intro p { color: #222; margin-bottom:0.6rem; line-height:1.5; }

  .modules { margin-top:20px; display:grid; gap:18px; grid-template-columns: repeat(3, 1fr); }
  @media (max-width:1000px){ .modules{ grid-template-columns:repeat(2,1fr); } }
  @media (max-width:640px){ .modules{ grid-template-columns:1fr; } }

  .card-module {
    background: #fff;
    border-radius:12px;
    padding:18px;
    border:1px solid var(--card-border);
    display:flex;
    flex-direction:column;
    gap:10px;
    transition: transform .18s cubic-bezier(.2,.9,.2,1), box-shadow .18s;
    position: relative;
  }
  .card-module:hover{
    transform: translateY(-6px);
    box-shadow: 0 18px 40px rgba(11,11,11,0.08);
  }

  .card-module .title {
    display:flex;
    align-items:center;
    gap:12px;
  }
  .card-module h3 { font-size:1rem; margin:0; font-weight:700; }
  .card-module p { margin:0; color:var(--muted); font-size:0.92rem; line-height:1.45; flex:1; }

  .badge-new {
    position: absolute;
    top: 12px;
    right: 12px;
    background: var(--accent);
    color: white;
    font-size: 0.68rem;
    font-weight: 700;
    padding: 2px 8px;
    border-radius: 20px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .card-actions { display:flex; gap:8px; align-items:center; justify-content:flex-end; margin-top:8px; }
  .btn-primary-custom{
    background: var(--accent);
    border: 0;
    color: #fff;
    padding: 8px 14px;
    border-radius:8px;
    font-weight:600;
    text-decoration:none;
  }
  .btn-primary-custom:hover{ background: var(--accent-dark); color:white; }

  .hint { margin-top:18px; color:var(--muted); font-size:0.9rem; }

  footer.site-footer {
    background: #0e0e0e;
    color:#cfcfcf;
    padding:18px 0;
    margin-top:30px;
    border-top: 4px solid rgba(255,255,255,0.02);
  }
  footer a { color: #fff; text-decoration:none; font-weight:600; }
  footer a:hover { text-decoration:underline; }

  .btn-primary-custom:focus, .card-module a:focus { outline: 3px solid rgba(176,18,18,0.16); outline-offset:3px; }

  .divider { height:1px; background: linear-gradient(90deg, transparent, rgba(0,0,0,0.06), transparent); margin:18px 0; border-radius:2px; }

  @media (max-width:480px){
    .site-title{ font-size:1.05rem; }
    .intro{ padding:14px; }
    .card-module{ padding:14px; }
  }
</style>
</head>
<body>

<header class="site-header">
  <div class="container text-center">
    <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-2">
      <div class="text-start w-100">
        <div class="site-title">Lógica de Programação com Baralho</div>
        <div class="site-sub">Aprenda conceitos fundamentais de programação através de cartas</div>
      </div>
      <nav class="text-end w-100 d-none d-md-block">
        <small style="color:#bfbfbf">Menu</small>
      </nav>
    </div>
  </div>
</header>

<main class="container-main" role="main">
  <section class="intro d-flex flex-column flex-md-row gap-3 align-items-start">
    <div style="flex:1">
      <h2>Proposta do Projeto</h2>
      <p>
        Usamos um baralho como recurso visual para ensinar lógica de programação: estruturas de repetição,
        condições, operadores, busca sequencial, busca binária e algoritmos de ordenação. O aluno manipula cartas para compreender como
        as operações mudam o estado passo a passo.
      </p>
      <p class="mb-0">
        A experiência prioriza prática ativa: você vê o algoritmo em ação e depois testa ordenando as cartas
        exatamente como o algoritmo faria.
      </p>
    </div>

    <div style="width:260px" class="d-none d-md-block">
      <div style="background:#fff;border-radius:10px;padding:12px;border:1px solid var(--card-border)">
        <strong>Configuração rápida</strong>
        <div class="divider"></div>
        <div style="font-size:0.92rem;color:var(--muted);">
          • 5 cartas por padrão<br>
          • Prioridade de pinta opcional<br>
          • Visualização + área do usuário
        </div>
      </div>
    </div>
  </section>

  <section class="modules" aria-label="Módulos principais">

    <article class="card-module" aria-labelledby="m-ordenacao">
      <div class="title">
        <h3 id="m-ordenacao">Ordenação</h3>
      </div>
      <p>
        Visualização e prática de algoritmos de ordenação usando cartas.
        Métodos disponíveis: Bubble Sort, Insertion Sort e Selection Sort.
      </p>
      <div class="card-actions">
        <a class="btn-primary-custom" href="ordenacao.php" role="button" aria-label="Abrir Ordenação">Acessar</a>
      </div>
    </article>

    <article class="card-module" aria-labelledby="m-repeticao">
      <div class="title">
        <h3 id="m-repeticao">Repetição</h3>
      </div>
      <p>
        Simulação interativa de estruturas for, while e do...while. Visualize iterações e destaque por pinta.
      </p>
      <div class="card-actions">
        <a class="btn-primary-custom" href="repeticao.php" role="button" aria-label="Abrir Repetição">Acessar</a>
      </div>
    </article>

    <article class="card-module" aria-labelledby="m-condicao">
      <div class="title">
        <h3 id="m-condicao">Condição</h3>
      </div>
      <p>
        Exercícios com if / else (e if aninhado). Arraste cartas para as decisões e verifique se a condição foi satisfeita.
      </p>
      <div class="card-actions">
        <a class="btn-primary-custom" href="condicao.php" role="button" aria-label="Abrir Condição">Acessar</a>
      </div>
    </article>

    <article class="card-module" aria-labelledby="m-operadores">
      <div class="title">
        <h3 id="m-operadores">Operadores</h3>
      </div>
      <p>
        Atividades práticas sobre operadores relacionais, lógicos e aritméticos aplicados sobre cartas (comparações e combinações).
      </p>
      <div class="card-actions">
        <a class="btn-primary-custom" href="operadores.php" role="button" aria-label="Abrir Operadores">Acessar</a>
      </div>
    </article>

    <article class="card-module" aria-labelledby="m-bseq">
      <span class="badge-new">Novo</span>
      <div class="title">
        <h3 id="m-bseq">Busca Sequencial</h3>
      </div>
      <p>
        Encontre a carta alvo verificando uma a uma, da esquerda para a direita. Entenda na prática o conceito de complexidade O(n).
      </p>
      <div class="card-actions">
        <a class="btn-primary-custom" href="buscasequencial.php" role="button" aria-label="Abrir Busca Sequencial">Acessar</a>
      </div>
    </article>

    <article class="card-module" aria-labelledby="m-bbin">
      <span class="badge-new">Novo</span>
      <div class="title">
        <h3 id="m-bbin">Busca Binária</h3>
      </div>
      <p>
        O baralho já vem ordenado. Divida ao meio e elimine metade a cada passo. Veja por que O(log n) é muito mais eficiente.
      </p>
      <div class="card-actions">
        <a class="btn-primary-custom" href="buscabinaria.php" role="button" aria-label="Abrir Busca Binária">Acessar</a>
      </div>
    </article>

  </section>

</main>

<footer class="site-footer">
  <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
    <div class="text-center text-md-start">
      <div style="font-weight:700;color:#fff">Lógica de Programação com Baralho</div>
      <div style="color:#bfbfbf;font-size:0.92rem">Projeto educacional interativo</div>
    </div>
    <div class="text-center mt-3 mt-md-0">
      <div style="font-size:0.95rem;color:#fff">Siga nas redes</div>
      <div style="margin-top:6px"><a href="https://instagram.com/vhf73" target="_blank" rel="noopener noreferrer">@vhf73</a></div>
    </div>
  </div>
</footer>

</body>
</html>