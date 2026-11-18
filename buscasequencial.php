<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>Busca Sequencial - Lógica com Baralho</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    * { box-sizing: border-box; }

    body {
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
        min-height: 100vh;
        padding: 20px;
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
    }

    .main-container {
        background: rgba(255,255,255,0.98);
        border-radius: 25px;
        padding: 30px;
        box-shadow: 0 25px 80px rgba(0,0,0,0.4);
        max-width: 1300px;
        margin: 0 auto;
    }

    h1 {
        font-size: 36px;
        font-weight: 800;
        background: linear-gradient(135deg, #ff4757 0%, #e84118 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 6px;
        text-align: center;
    }

    /* Stats */
    .stats-header {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
        gap: 12px;
        margin-bottom: 20px;
        padding: 15px;
        background: linear-gradient(135deg, rgba(255,71,87,0.08), rgba(232,65,24,0.08));
        border-radius: 15px;
    }

    .stat-box {
        text-align: center;
        padding: 12px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: transform 0.3s;
    }

    .stat-box:hover { transform: translateY(-4px); }

    .stat-value {
        font-size: 28px;
        font-weight: 800;
        background: linear-gradient(135deg, #ff4757, #e84118);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .stat-label {
        font-size: 11px;
        color: #666;
        text-transform: uppercase;
        font-weight: 600;
        letter-spacing: 0.5px;
        margin-top: 4px;
    }

    /* Controls */
    .controls-panel {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        align-items: center;
        padding: 15px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        margin-bottom: 20px;
    }

    .btn-game {
        padding: 11px 22px;
        border: none;
        border-radius: 10px;
        font-weight: 700;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .btn-game:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(0,0,0,0.25); }
    .btn-primary-game { background: linear-gradient(135deg, #ff4757, #e84118); color: white; }
    .btn-success-game { background: linear-gradient(135deg, #56ab2f, #a8e063); color: white; }
    .btn-warning-game { background: linear-gradient(135deg, #f09819, #ff512f); color: white; }
    .btn-dark-game    { background: linear-gradient(135deg, #2d2d2d, #1a1a1a); color: white; }

    /* Layout principal */
    .game-area {
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: 20px;
        margin-bottom: 20px;
    }

    .play-zone {
        background: linear-gradient(to bottom, #f8f9fa, #e9ecef);
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }

    /* Alvo */
    .target-box {
        background: linear-gradient(135deg, #ff4757, #e84118);
        color: white;
        border-radius: 15px;
        padding: 18px 25px;
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 20px;
        box-shadow: 0 8px 25px rgba(255,71,87,0.3);
    }

    .target-label { font-size: 14px; font-weight: 600; opacity: 0.9; }
    .target-card-display {
        width: 60px;
        height: 85px;
        background: white;
        border-radius: 8px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 22px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }
    .target-card-display.red { color: #dc3545; }
    .target-card-display.black { color: #111; }

    /* Baralho de busca */
    .deck-row {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
        align-items: flex-end;
        min-height: 140px;
        padding: 25px 15px 40px;
        background: white;
        border-radius: 15px;
        border: 3px dashed #dee2e6;
    }

    /* Cartas */
    .card {
        width: 75px;
        height: 108px;
        border: 3px solid #2c2c2c;
        border-radius: 10px;
        background: linear-gradient(145deg, #fff, #f5f5f5);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 24px;
        cursor: pointer;
        user-select: none;
        position: relative;
        box-shadow: 0 5px 12px rgba(0,0,0,0.15);
        transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
    }

    .card:hover:not(.checked):not(.found):not(.blocked):not(.facedown:not(.current)) {
        transform: translateY(-10px) scale(1.05);
        box-shadow: 0 15px 30px rgba(0,0,0,0.25);
    }

    .card.red   { color: #dc3545; }
    .card.black { color: #111; }

    /* Carta virada para baixo (modo manual) */
    .card.facedown {
        background: repeating-linear-gradient(45deg, #c0392b, #c0392b 7px, #e74c3c 7px, #e74c3c 14px);
        border-color: #7f1d1d;
        color: transparent;
    }

    .card.facedown::before {
        content: "";
        position: absolute;
        inset: 5px;
        border: 2px solid rgba(255,255,255,0.7);
        border-radius: 6px;
    }

    .card.facedown .card-content { visibility: hidden; }
    .card.facedown:not(.current) { cursor: not-allowed; }

    /* Ponteiro i */
    .card-pointer {
        display: none;
        position: absolute;
        bottom: -34px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 12px;
        font-weight: 800;
        color: #d35400;
        white-space: nowrap;
        text-align: center;
        line-height: 1.1;
    }

    .card.current .card-pointer { display: block; }

    /* Estados */
    .card.current {
        border-color: #ffc107;
        box-shadow: 0 0 25px rgba(255,193,7,0.8);
        animation: pulse-yellow 0.8s ease infinite;
    }

    .card.checked {
        opacity: 0.4;
        transform: scale(0.93);
        cursor: default;
        border-color: #aaa;
        background: #e9ecef;
    }

    .card.found {
        border-color: #28a745;
        box-shadow: 0 0 35px rgba(40,167,69,0.7);
        animation: found-anim 0.6s ease;
        cursor: default;
    }

    .card.blocked { cursor: default; }

    .card-index {
        position: absolute;
        top: -18px;
        font-size: 11px;
        font-weight: 700;
        color: #888;
    }

    @keyframes pulse-yellow {
        0%,100% { box-shadow: 0 0 15px rgba(255,193,7,0.6); }
        50%      { box-shadow: 0 0 30px rgba(255,193,7,1); }
    }

    @keyframes found-anim {
        0%,100% { transform: scale(1); }
        50%      { transform: scale(1.2); }
    }

    /* Progresso */
    .progress-bar-container {
        background: #e9ecef;
        height: 22px;
        border-radius: 15px;
        overflow: hidden;
        margin: 12px 0 4px;
    }

    .progress-bar-fill {
        height: 100%;
        background: linear-gradient(90deg, #ff4757, #e84118);
        transition: width 0.5s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 11px;
    }

    /* Painel lateral */
    .side-panel { display: flex; flex-direction: column; gap: 16px; }

    .info-panel {
        background: white;
        border-radius: 15px;
        padding: 18px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    }

    .panel-title {
        font-weight: 700;
        font-size: 16px;
        margin-bottom: 12px;
        color: #333;
        border-bottom: 2px solid #f8f9fa;
        padding-bottom: 8px;
    }

    /* Console */
    .console {
        background: #1e1e1e;
        color: #00ff00;
        padding: 12px;
        border-radius: 10px;
        font-family: 'Courier New', monospace;
        font-size: 12px;
        height: 220px;
        overflow-y: auto;
        box-shadow: inset 0 2px 8px rgba(0,0,0,0.3);
    }

    .console-line { margin-bottom: 4px; padding: 2px 4px; border-radius: 3px; animation: fadeIn 0.3s ease; }
    .console-line.success { color: #00ff00; }
    .console-line.error   { color: #ff4444; }
    .console-line.warning { color: #ffaa00; }
    .console-line.info    { color: #00aaff; }
    .console-line.found   { color: #ffd700; font-weight: bold; }

    @keyframes fadeIn {
        from { opacity:0; transform: translateX(-8px); }
        to   { opacity:1; transform: translateX(0); }
    }

    /* Modal resultado */
    .result-modal {
        display: none;
        position: fixed;
        top:0; left:0; width:100%; height:100%;
        background: rgba(0,0,0,0.8);
        z-index: 1000;
        justify-content: center;
        align-items: center;
    }

    .result-modal.show { display: flex; animation: modalFade 0.3s ease; }

    @keyframes modalFade { from{opacity:0} to{opacity:1} }

    .result-content {
        background: white;
        padding: 40px;
        border-radius: 25px;
        max-width: 420px;
        text-align: center;
        box-shadow: 0 25px 80px rgba(0,0,0,0.5);
        animation: modalSlide 0.4s ease;
    }

    @keyframes modalSlide {
        from { transform: translateY(-40px) scale(0.9); }
        to   { transform: translateY(0) scale(1); }
    }

    .result-icon  { font-size: 70px; margin-bottom: 15px; }
    .result-title { font-size: 28px; font-weight: 800; margin-bottom: 10px; }

    .result-stats {
        display: grid;
        grid-template-columns: repeat(3,1fr);
        gap: 12px;
        margin: 20px 0;
    }

    .result-stat {
        padding: 12px;
        background: #f8f9fa;
        border-radius: 10px;
    }

    .result-stat-value { font-size: 22px; font-weight: 700; color: #ff4757; }
    .result-stat-label { font-size: 11px; color: #666; margin-top: 4px; }

    /* Hint */
    .hint-box {
        background: linear-gradient(135deg, #ffeaa7, #fdcb6e);
        padding: 12px 15px;
        border-radius: 10px;
        margin-bottom: 12px;
        border-left: 5px solid #f39c12;
        font-size: 14px;
    }

    .hint-box strong { display: block; margin-bottom: 4px; color: #d35400; }

    /* Speed */
    .speed-label { font-size: 13px; color: #555; font-weight: 600; }

    /* Modo Auto */
    .mode-selector {
        display: flex;
        gap: 8px;
        margin-bottom: 15px;
    }

    .mode-btn {
        flex: 1;
        padding: 10px;
        border: 2px solid #dee2e6;
        border-radius: 10px;
        background: white;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
        font-size: 13px;
        text-align: center;
    }

    .mode-btn.active {
        background: linear-gradient(135deg, #ff4757, #e84118);
        color: white;
        border-color: transparent;
        box-shadow: 0 4px 12px rgba(255,71,87,0.4);
    }

    /* Pseudo-código */
    .pseudo-code {
        background: #2d2d2d;
        color: #f8f8f2;
        padding: 14px;
        border-radius: 10px;
        font-family: 'Courier New', monospace;
        font-size: 12px;
        line-height: 1.7;
    }

    .kw  { color: #ff79c6; }
    .fn  { color: #50fa7b; }
    .cm  { color: #6272a4; }
    .nm  { color: #bd93f9; }

    .pseudo-line.active-line {
        background: rgba(255,193,7,0.2);
        border-radius: 3px;
        display: block;
    }

    @media (max-width:1100px) {
        .game-area { grid-template-columns: 1fr; }
    }
</style>
</head>
<body>
<div class="container-fluid" style="max-width:1400px;margin:0 auto;padding:0 15px;">
<div class="main-container">

    <h1>🔍 Busca Sequencial</h1>
    <p class="text-center text-muted mb-4">O baralho está ordenado. Encontre a carta alvo verificando uma a uma — do início ao fim!</p>

    <!-- Stats -->
    <div class="stats-header">
        <div class="stat-box">
            <div class="stat-value" id="stat-comp">0</div>
            <div class="stat-label">🔎 Comparações</div>
        </div>
        <div class="stat-box">
            <div class="stat-value" id="stat-pos">—</div>
            <div class="stat-label">📍 Posição</div>
        </div>
        <div class="stat-box">
            <div class="stat-value" id="stat-total">0</div>
            <div class="stat-label">🃏 Cartas</div>
        </div>
        <div class="stat-box">
            <div class="stat-value" id="stat-score">0</div>
            <div class="stat-label">⭐ Pontos</div>
        </div>
    </div>

    <!-- Controles -->
    <div class="controls-panel">
        <select id="num-cards" class="form-select" style="width:160px;">
            <option value="5">Fácil (5 cartas)</option>
            <option value="8" selected>Médio (8 cartas)</option>
            <option value="13">Difícil (13 cartas)</option>
        </select>

        <button class="btn-game btn-primary-game" onclick="newGame()">🎲 Novo Jogo</button>
        <button class="btn-game btn-success-game" onclick="autoSearch()">▶️ Auto Buscar</button>
        <button class="btn-game btn-warning-game" onclick="showHint()">💡 Dica</button>
        <a href="index2.php" class="btn-game btn-dark-game">🏠 Menu</a>

        <div class="ms-auto d-flex align-items-center gap-2">
            <span class="speed-label">Velocidade:</span>
            <input type="range" id="speedControl" min="300" max="1800" value="800" style="width:130px;">
            <span class="speed-label" id="speedLabel">800ms</span>
        </div>
    </div>

    <div class="game-area">
        <!-- Zona de Jogo -->
        <div class="play-zone">

            <div class="mode-selector">
                <div class="mode-btn active" id="btn-manual" onclick="setMode('manual')">👆 Manual</div>
                <div class="mode-btn" id="btn-auto" onclick="setMode('auto')">🤖 Automático</div>
            </div>

            <!-- Alvo -->
            <div class="target-box" id="target-box">
                <div>
                    <div class="target-label">🎯 Procurando a carta:</div>
                    <div style="font-size:13px;opacity:0.8;margin-top:4px;">Vire as cartas uma a uma, da esquerda pra direita</div>
                </div>
                <div class="target-card-display" id="target-display">—</div>
            </div>

            <!-- Dica -->
            <div id="hint-container"></div>

            <!-- Deck -->
            <div class="deck-row" id="deckArea"></div>

            <!-- Progresso -->
            <div class="mt-3">
                <div class="progress-bar-container">
                    <div class="progress-bar-fill" id="progressBar" style="width:0%">0%</div>
                </div>
                <small class="text-muted">Progresso da busca</small>
            </div>
        </div>

        <!-- Painel Lateral -->
        <div class="side-panel">

            <!-- Pseudo-código -->
            <div class="info-panel">
                <div class="panel-title">📝 Algoritmo</div>
                <div class="pseudo-code">
<span class="cm">// Busca Sequencial</span>
<span id="pl1"><span class="kw">função</span> <span class="fn">buscaSequencial</span>(lista, alvo):</span>
<span id="pl2">  <span class="kw">para</span> i <span class="kw">de</span> <span class="nm">0</span> <span class="kw">até</span> lista.tamanho:</span>
<span id="pl3">    <span class="kw">se</span> lista[i] == alvo:</span>
<span id="pl4">      <span class="kw">retornar</span> i  <span class="cm">// encontrado!</span></span>
<span id="pl5">  <span class="kw">retornar</span> <span class="nm">-1</span>  <span class="cm">// não encontrado</span></span>
                </div>
                <div class="mt-2" style="font-size:12px;color:#888;">
                    ⏱️ Complexidade: <strong>O(n)</strong> — pior caso verifica todas as cartas
                </div>
            </div>

            <!-- Console -->
            <div class="info-panel">
                <div class="panel-title">📊 Console</div>
                <div class="console" id="console">
                    <div class="console-line info">Pronto! Clique em "Novo Jogo" para começar.</div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal Resultado -->
<div class="result-modal" id="resultModal">
    <div class="result-content">
        <div class="result-icon" id="resultIcon">🎉</div>
        <div class="result-title" id="resultTitle">Carta Encontrada!</div>
        <div id="resultMsg" style="color:#666;margin-bottom:15px;font-size:15px;"></div>
        <div class="result-stats">
            <div class="result-stat">
                <div class="result-stat-value" id="modalComp">0</div>
                <div class="result-stat-label">Comparações</div>
            </div>
            <div class="result-stat">
                <div class="result-stat-value" id="modalPos">0</div>
                <div class="result-stat-label">Posição</div>
            </div>
            <div class="result-stat">
                <div class="result-stat-value" id="modalScore">0</div>
                <div class="result-stat-label">Pontos</div>
            </div>
        </div>
        <button class="btn-game btn-primary-game mt-2" style="width:100%;" onclick="closeModal();newGame();">🎲 Novo Jogo</button>
        <button class="btn-game btn-dark-game mt-2" style="width:100%;" onclick="closeModal()">✕ Fechar</button>
    </div>
</div>

<script>
const suits = {
    hearts:   { symbol:'♥', color:'red' },
    diamonds: { symbol:'♦', color:'red' },
    clubs:    { symbol:'♣', color:'black' },
    spades:   { symbol:'♠', color:'black' }
};
const vals = ['A','2','3','4','5','6','7','8','9','10','J','Q','K'];

function vnum(v){ return v==='A'?1:v==='J'?11:v==='Q'?12:v==='K'?13:parseInt(v); }

// Ordem de desempate entre naipes (mesma usada na busca binária)
const suitW = { clubs:4, hearts:3, spades:2, diamonds:1 };
function cmp(a,b){
    if(a.vnum !== b.vnum) return a.vnum - b.vnum;
    return suitW[a.suit] - suitW[b.suit];
}

let gs = {
    cards: [], target: null,
    currentIdx: 0, comparisons: 0,
    score: 0, found: false,
    mode: 'manual', running: false
};

document.getElementById('speedControl').addEventListener('input', e => {
    document.getElementById('speedLabel').textContent = e.target.value + 'ms';
});

function setMode(m){
    gs.mode = m;
    document.getElementById('btn-manual').classList.toggle('active', m==='manual');
    document.getElementById('btn-auto').classList.toggle('active', m==='auto');
    // Redesenha o baralho: manual = cartas viradas para baixo, automático = cartas abertas
    if(!gs.running && gs.cards.length) renderDeck();
}

function generateDeck(n){
    const all = [];
    for(let sk in suits)
        for(let v of vals)
            all.push({ value:v, vnum:vnum(v), suit:sk, id:`${v}-${sk}` });
    for(let i=all.length-1;i>0;i--){
        const j=Math.floor(Math.random()*(i+1));
        [all[i],all[j]]=[all[j],all[i]];
    }
    // pega n cartas e deixa o baralho ORDENADO (crescente)
    return all.slice(0,n).sort(cmp);
}

function newGame(){
    if(gs.running) return;
    const n = parseInt(document.getElementById('num-cards').value);
    gs.cards = generateDeck(n);
    gs.target = gs.cards[Math.floor(Math.random()*n)];
    gs.currentIdx = 0;
    gs.comparisons = 0;
    gs.found = false;
    gs.running = false;

    updateTargetDisplay();
    renderDeck();
    clearHint();
    clearConsole();
    updateStats();
    document.getElementById('progressBar').style.width='0%';
    document.getElementById('progressBar').textContent='0%';
    highlightPseudo(-1);
    log('🎮 Novo jogo! Baralho ORDENADO com ' + n + ' cartas.', 'info');
    log('🎯 Procurando: ' + gs.target.value + suits[gs.target.suit].symbol, 'info');
    if(gs.mode === 'manual'){
        log('🂠 As cartas estão viradas para baixo.', 'info');
        log('👆 Clique na carta [0] para virar e comparar.', 'info');
    } else {
        log('👆 Clique em "Auto Buscar" para iniciar a busca.', 'info');
    }
    document.getElementById('stat-total').textContent = n;
}

function updateTargetDisplay(){
    const t = gs.target;
    const el = document.getElementById('target-display');
    el.className = 'target-card-display ' + suits[t.suit].color;
    el.innerHTML = `<div>${t.value}</div><div style="font-size:18px">${suits[t.suit].symbol}</div>`;
}

// Desenha o baralho respeitando o estado atual do jogo.
// Manual: cartas ainda não verificadas ficam viradas para baixo.
// Automático: todas as cartas ficam abertas (como era antes).
function renderDeck(){
    const area = document.getElementById('deckArea');
    area.innerHTML = '';
    gs.cards.forEach((card, idx) => {
        const faceDown = (gs.mode === 'manual') && idx >= gs.currentIdx;
        const isFound  = gs.found && idx === gs.currentIdx - 1;
        const isChecked = idx < gs.currentIdx && !isFound;

        const el = document.createElement('div');
        el.className = 'card ' + suits[card.suit].color
            + (faceDown ? ' facedown' : '')
            + (isChecked ? ' checked' : '')
            + (isFound ? ' found' : '');
        el.id = 'card-' + idx;
        el.dataset.idx = idx;
        el.innerHTML = `
            <span class="card-index">[${idx}]</span>
            <div class="card-content" style="display:flex;flex-direction:column;align-items:center;">
                <div style="font-size:26px;line-height:1">${card.value}</div>
                <div style="font-size:20px;margin-top:4px">${suits[card.suit].symbol}</div>
            </div>
        `;
        el.addEventListener('click', () => handleCardClick(idx));
        area.appendChild(el);
    });
    markCurrent();
}

// Destaca a carta da vez no modo manual e mostra o ponteiro "i"
function markCurrent(){
    if(gs.mode !== 'manual' || gs.running) return;
    document.querySelectorAll('.card.current').forEach(c => c.classList.remove('current'));
    document.querySelectorAll('.card-pointer').forEach(p => p.remove());
    if(gs.found || gs.currentIdx >= gs.cards.length) return;

    const el = document.getElementById('card-' + gs.currentIdx);
    if(!el) return;
    el.classList.add('current');
    const ptr = document.createElement('div');
    ptr.className = 'card-pointer';
    ptr.innerHTML = `▲<br>i = ${gs.currentIdx}`;
    el.appendChild(ptr);
}

// Animação de virar a carta (de costas para a frente)
function flipCard(el){
    if(!el || !el.classList.contains('facedown')) return;
    el.style.transform = 'rotateY(90deg)';
    setTimeout(() => {
        el.classList.remove('facedown');
        el.style.transform = '';
    }, 150);
}

function handleCardClick(idx){
    if(gs.mode !== 'manual') return;
    if(gs.found || gs.running) return;

    if(idx !== gs.currentIdx){
        if(idx < gs.currentIdx){
            log(`ℹ️ A carta [${idx}] já foi verificada. Agora é a [${gs.currentIdx}].`, 'warning');
        } else {
            log(`⚠️ Siga a ordem! Vire a carta [${gs.currentIdx}] primeiro.`, 'warning');
        }
        shakeCard(idx);
        return;
    }

    checkCard(idx);
}

function checkCard(idx){
    const card = gs.cards[idx];
    const target = gs.target;
    gs.comparisons++;
    gs.currentIdx++;

    const el = document.getElementById('card-' + idx);

    // Vira a carta (só faz efeito se ela estiver virada para baixo)
    flipCard(el);

    highlightPseudo(2);
    log(`🔎 [${idx}] Comparando ${card.value}${suits[card.suit].symbol} com ${target.value}${suits[target.suit].symbol}...`, 'info');

    setTimeout(() => {
        if(card.id === target.id){
            highlightPseudo(3);
            el.classList.remove('current');
            el.classList.add('found');
            gs.found = true;
            markCurrent();

            const pts = Math.max(10, 100 - (gs.comparisons-1)*8);
            gs.score += pts;

            log(`🎉 ENCONTRADO na posição [${idx}]! Comparações: ${gs.comparisons}`, 'found');
            updateStats(idx);
            updateProgress(100);
            setTimeout(() => showModal(idx, pts), 600);
        } else {
            highlightPseudo(3);
            el.classList.remove('current');
            el.classList.add('checked');
            log(`  ✗ Não é. Avançando...`, 'warning');
            updateStats();
            updateProgress(Math.round((gs.currentIdx/gs.cards.length)*100));

            if(gs.currentIdx >= gs.cards.length){
                highlightPseudo(4);
                log(`❌ Carta não encontrada no baralho.`, 'error');
            }
            markCurrent();
        }
    }, 200);
}

async function autoSearch(){
    if(gs.found || gs.running || gs.cards.length===0){ if(!gs.cards.length) newGame(); return; }
    setMode('auto');
    gs.running = true;
    const speed = parseInt(document.getElementById('speedControl').value);
    log('🤖 Iniciando busca automática...', 'info');

    for(let i=gs.currentIdx; i<gs.cards.length; i++){
        if(!gs.running) break;
        const el = document.getElementById('card-'+i);
        if(!el) break;

        el.classList.add('current');
        highlightPseudo(1);
        await sleep(speed/3);
        highlightPseudo(2);
        checkCard(i);
        await sleep(speed);
        el.classList.remove('current');

        if(gs.found) break;
    }

    gs.running = false;
}

function shakeCard(idx){
    const el = document.getElementById('card-'+idx);
    if(!el) return;
    el.style.animation = 'none';
    el.style.transform = 'translateX(-8px)';
    setTimeout(()=>{ el.style.transform='translateX(8px)'; }, 80);
    setTimeout(()=>{ el.style.transform=''; el.style.animation=''; }, 160);
}

function highlightPseudo(line){
    ['pl1','pl2','pl3','pl4','pl5'].forEach((id,i)=>{
        const el = document.getElementById(id);
        if(!el) return;
        el.className = (i===line) ? 'pseudo-line active-line' : 'pseudo-line';
    });
}

function showHint(){
    if(!gs.target) return;
    if(gs.mode === 'manual'){
        // No manual a dica NÃO revela a posição, senão estraga a busca
        document.getElementById('hint-container').innerHTML = `
            <div class="hint-box">
                <strong>💡 Dica:</strong>
                Na busca sequencial você vira cada carta UM A UM, da esquerda pra direita,
                e compara com o alvo (${gs.target.value}${suits[gs.target.suit].symbol}).
                Não pode pular nenhuma! No pior caso vira TODAS as cartas (O(n)).
            </div>
        `;
    } else {
        document.getElementById('hint-container').innerHTML = `
            <div class="hint-box">
                <strong>💡 Dica:</strong>
                Na busca sequencial você verifica cada carta UM A UM, da esquerda pra direita.
                Não pode pular nenhuma! No pior caso verifica TODAS as cartas (O(n)).
                A carta alvo está na posição [${gs.cards.findIndex(c=>c.id===gs.target?.id)}].
            </div>
        `;
    }
}

function clearHint(){ document.getElementById('hint-container').innerHTML = ''; }

function updateStats(foundPos){
    document.getElementById('stat-comp').textContent = gs.comparisons;
    document.getElementById('stat-pos').textContent  = foundPos !== undefined ? foundPos : '—';
    document.getElementById('stat-score').textContent = gs.score;
}

function updateProgress(pct){
    const bar = document.getElementById('progressBar');
    bar.style.width = pct + '%';
    bar.textContent = pct + '%';
}

function log(msg, type='info'){
    const c = document.getElementById('console');
    const line = document.createElement('div');
    line.className = 'console-line ' + type;
    line.textContent = msg;
    c.appendChild(line);
    c.scrollTop = c.scrollHeight;
}

function clearConsole(){
    document.getElementById('console').innerHTML = '';
}

function showModal(pos, pts){
    document.getElementById('resultIcon').textContent = '🎉';
    document.getElementById('resultTitle').textContent = 'Carta Encontrada!';
    document.getElementById('resultMsg').textContent =
        `Você encontrou ${gs.target.value}${suits[gs.target.suit].symbol} na posição [${pos}] com ${gs.comparisons} comparação(ões)!`;
    document.getElementById('modalComp').textContent  = gs.comparisons;
    document.getElementById('modalPos').textContent   = pos;
    document.getElementById('modalScore').textContent = '+' + pts;
    document.getElementById('resultModal').classList.add('show');
}

function closeModal(){
    document.getElementById('resultModal').classList.remove('show');
}

function sleep(ms){ return new Promise(r=>setTimeout(r,ms)); }

// Inicia
newGame();
</script>
</body>
</html>