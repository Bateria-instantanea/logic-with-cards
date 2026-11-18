<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>Busca Binária - Lógica com Baralho</title>
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

    .target-card-display.red   { color: #dc3545; }
    .target-card-display.black { color: #111; }

    /* Deck */
    .deck-row {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
        align-items: flex-end;
        min-height: 150px;
        padding: 25px 15px 35px;
        background: white;
        border-radius: 15px;
        border: 3px dashed #dee2e6;
        position: relative;
    }

    /* Indicador de intervalo ativo */
    .range-indicator {
        font-size: 12px;
        color: #888;
        text-align: center;
        margin-top: 8px;
        font-weight: 600;
    }

    /* Cartas */
    .card {
        width: 72px;
        height: 105px;
        border: 3px solid #2c2c2c;
        border-radius: 10px;
        background: linear-gradient(145deg, #fff, #f5f5f5);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 22px;
        cursor: pointer;
        user-select: none;
        position: relative;
        box-shadow: 0 5px 12px rgba(0,0,0,0.15);
        transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
    }

    .card:hover:not(.eliminated):not(.found):not(.blocked):not(.facedown:not(.mid-card)) {
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
    .card.facedown:not(.mid-card) { cursor: not-allowed; }

    /* Estados da busca binária */
    .card.active-range {
        border-color: #4facfe;
        box-shadow: 0 0 15px rgba(79,172,254,0.4);
    }

    .card.facedown.active-range { border-color: #4facfe; }

    .card.mid-card {
        border-color: #ffc107;
        box-shadow: 0 0 30px rgba(255,193,7,0.9);
        animation: pulse-mid 0.8s ease infinite;
        z-index: 2;
    }

    .card.eliminated {
        opacity: 0.25;
        transform: scale(0.88);
        cursor: default;
        border-color: #ccc;
        background: #e9ecef;
    }

    .card.eliminated.facedown {
        background: repeating-linear-gradient(45deg, #b8b8b8, #b8b8b8 7px, #cfcfcf 7px, #cfcfcf 14px);
    }

    .card.found {
        border-color: #28a745;
        box-shadow: 0 0 35px rgba(40,167,69,0.8);
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

    .card-mid-label {
        position: absolute;
        bottom: -20px;
        font-size: 10px;
        font-weight: 800;
        color: #f39c12;
        white-space: nowrap;
    }

    @keyframes pulse-mid {
        0%,100% { box-shadow: 0 0 15px rgba(255,193,7,0.6); }
        50%      { box-shadow: 0 0 35px rgba(255,193,7,1); transform: translateY(-5px) scale(1.05); }
    }

    @keyframes found-anim {
        0%,100% { transform: scale(1); }
        50%      { transform: scale(1.2); }
    }

    /* Decisão */
    .decision-box {
        display: none;
        background: white;
        border-radius: 15px;
        padding: 18px;
        margin-top: 15px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        text-align: center;
        border: 2px solid #dee2e6;
    }

    .decision-box.show { display: block; animation: fadeIn 0.3s ease; }
    .decision-title { font-weight: 700; font-size: 16px; margin-bottom: 12px; color: #333; }

    .decision-btns { display: flex; gap: 10px; justify-content: center; flex-wrap: wrap; }

    .dec-btn {
        padding: 12px 28px;
        border: none;
        border-radius: 10px;
        font-weight: 700;
        font-size: 15px;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .dec-btn:hover { transform: translateY(-3px); }
    .dec-btn.left  { background: linear-gradient(135deg, #4facfe, #00f2fe); color: white; }
    .dec-btn.found-btn { background: linear-gradient(135deg, #28a745, #20c997); color: white; }
    .dec-btn.right { background: linear-gradient(135deg, #ff4757, #e84118); color: white; }

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

    /* Modal */
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
        max-width: 440px;
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

    .result-stat { padding: 12px; background: #f8f9fa; border-radius: 10px; }
    .result-stat-value { font-size: 22px; font-weight: 700; color: #ff4757; }
    .result-stat-label { font-size: 11px; color: #666; margin-top: 4px; }

    .hint-box {
        background: linear-gradient(135deg, #ffeaa7, #fdcb6e);
        padding: 12px 15px;
        border-radius: 10px;
        margin-bottom: 12px;
        border-left: 5px solid #f39c12;
        font-size: 14px;
    }

    .hint-box strong { display: block; margin-bottom: 4px; color: #d35400; }

    /* Pseudo código */
    .pseudo-code {
        background: #2d2d2d;
        color: #f8f8f2;
        padding: 14px;
        border-radius: 10px;
        font-family: 'Courier New', monospace;
        font-size: 11.5px;
        line-height: 1.7;
    }

    .kw { color: #ff79c6; }
    .fn { color: #50fa7b; }
    .cm { color: #6272a4; }
    .nm { color: #bd93f9; }

    .pseudo-line.active-line {
        background: rgba(255,193,7,0.2);
        border-radius: 3px;
        display: block;
    }

    .mode-selector { display:flex; gap:8px; margin-bottom:15px; }
    .mode-btn {
        flex:1; padding:10px; border:2px solid #dee2e6;
        border-radius:10px; background:white;
        font-weight:700; cursor:pointer; transition:all 0.3s; font-size:13px; text-align:center;
    }
    .mode-btn.active {
        background: linear-gradient(135deg, #ff4757, #e84118);
        color:white; border-color:transparent;
        box-shadow: 0 4px 12px rgba(255,71,87,0.4);
    }

    @media (max-width:1100px) { .game-area { grid-template-columns: 1fr; } }
</style>
</head>
<body>
<div class="container-fluid" style="max-width:1400px;margin:0 auto;padding:0 15px;">
<div class="main-container">

    <h1>⚡ Busca Binária</h1>
    <p class="text-center text-muted mb-4">O baralho já está ordenado, divida ao meio e elimine metade de cada vez!</p>

    <!-- Stats -->
    <div class="stats-header">
        <div class="stat-box">
            <div class="stat-value" id="stat-comp">0</div>
            <div class="stat-label">🔎 Comparações</div>
        </div>
        <div class="stat-box">
            <div class="stat-value" id="stat-range">—</div>
            <div class="stat-label">📐 Intervalo</div>
        </div>
        <div class="stat-box">
            <div class="stat-value" id="stat-mid">—</div>
            <div class="stat-label">🎯 Meio atual</div>
        </div>
        <div class="stat-box">
            <div class="stat-value" id="stat-score">0</div>
            <div class="stat-label">⭐ Pontos</div>
        </div>
    </div>

    <!-- Controles -->
    <div class="controls-panel">
        <select id="num-cards" class="form-select" style="width:160px;">
            <option value="7">Fácil (7 cartas)</option>
            <option value="11" selected>Médio (11 cartas)</option>
            <option value="15">Difícil (15 cartas)</option>
        </select>

        <button class="btn-game btn-primary-game" onclick="newGame()">🎲 Novo Jogo</button>
        <button class="btn-game btn-success-game" onclick="autoSearch()">▶️ Auto Buscar</button>
        <button class="btn-game btn-warning-game" onclick="showHint()">💡 Dica</button>
        <a href="index2.php" class="btn-game btn-dark-game">🏠 Menu</a>

        <div class="ms-auto d-flex align-items-center gap-2">
            <span style="font-size:13px;font-weight:600;color:#555;">Velocidade:</span>
            <input type="range" id="speedControl" min="400" max="2000" value="900" style="width:130px;">
            <span style="font-size:13px;font-weight:600;color:#555;" id="speedLabel">900ms</span>
        </div>
    </div>

    <div class="game-area">
        <!-- Zona de jogo -->
        <div class="play-zone">

            <div class="mode-selector">
                <div class="mode-btn active" id="btn-manual" onclick="setMode('manual')">👆 Manual</div>
                <div class="mode-btn" id="btn-auto" onclick="setMode('auto')">🤖 Automático</div>
            </div>

            <!-- Alvo -->
            <div class="target-box" id="target-box">
                <div>
                    <div style="font-size:14px;font-weight:600;opacity:0.9;">🎯 Procurando a carta:</div>
                    <div style="font-size:13px;opacity:0.8;margin-top:4px;">O baralho está ordenado e virado para baixo. Vire só a carta do MEIO!</div>
                </div>
                <div class="target-card-display" id="target-display">—</div>
            </div>

            <!-- Dica -->
            <div id="hint-container"></div>

            <!-- Deck -->
            <div class="deck-row" id="deckArea"></div>
            <div class="range-indicator" id="rangeIndicator">—</div>

            <!-- Decisão -->
            <div class="decision-box" id="decisionBox">
                <div class="decision-title" id="decisionTitle">A carta do MEIO é maior ou menor que o alvo?</div>
                <div class="decision-btns">
                    <button class="dec-btn left" onclick="decide('left')">⬅️ Alvo está à esquerda (menor)</button>
                    <button class="dec-btn found-btn" onclick="decide('found')">✅ É essa!</button>
                    <button class="dec-btn right" onclick="decide('right')">➡️ Alvo está à direita (maior)</button>
                </div>
            </div>

            <!-- Progresso -->
            <div class="mt-3">
                <div class="progress-bar-container">
                    <div class="progress-bar-fill" id="progressBar" style="width:0%">0%</div>
                </div>
                <small class="text-muted">Intervalo eliminado</small>
            </div>
        </div>

        <!-- Painel lateral -->
        <div class="side-panel">

            <div class="info-panel">
                <div class="panel-title">📝 Algoritmo</div>
                <div class="pseudo-code">
<span class="cm">// Busca Binária (lista ORDENADA)</span>
<span id="pl0"><span class="kw">função</span> <span class="fn">buscaBinaria</span>(lista, alvo):</span>
<span id="pl1">  esq = <span class="nm">0</span>; dir = lista.tamanho-<span class="nm">1</span></span>
<span id="pl2">  <span class="kw">enquanto</span> esq &lt;= dir:</span>
<span id="pl3">    meio = (esq + dir) / <span class="nm">2</span></span>
<span id="pl4">    <span class="kw">se</span> lista[meio] == alvo:</span>
<span id="pl5">      <span class="kw">retornar</span> meio <span class="cm">// encontrado!</span></span>
<span id="pl6">    <span class="kw">se</span> lista[meio] &lt; alvo:</span>
<span id="pl7">      esq = meio + <span class="nm">1</span> <span class="cm">// vai pra direita</span></span>
<span id="pl8">    <span class="kw">senão</span>:</span>
<span id="pl9">      dir = meio - <span class="nm">1</span> <span class="cm">// vai pra esquerda</span></span>
<span id="pl10">  <span class="kw">retornar</span> <span class="nm">-1</span> <span class="cm">// não encontrado</span></span>
                </div>
                <div class="mt-2" style="font-size:12px;color:#888;">
                    ⚡ Complexidade: <strong>O(log n)</strong> — muito mais rápido que sequencial!
                </div>
            </div>

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

<!-- Modal -->
<div class="result-modal" id="resultModal">
    <div class="result-content">
        <div class="result-icon" id="resultIcon">🎉</div>
        <div class="result-title" id="resultTitle">Carta Encontrada!</div>
        <div id="resultMsg" style="color:#666;margin-bottom:15px;font-size:14px;"></div>
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
                <div class="result-stat-value" id="modalScore">+0</div>
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
const suitW = { clubs:4, hearts:3, spades:2, diamonds:1 };

function vnum(v){ return v==='A'?1:v==='J'?11:v==='Q'?12:v==='K'?13:parseInt(v); }

function cmp(a,b){
    if(a.vnum !== b.vnum) return a.vnum - b.vnum;
    return suitW[a.suit] - suitW[b.suit];
}

let gs = {
    cards:[], target:null,
    lo:0, hi:0, mid:0,
    comparisons:0, score:0,
    found:false, running:false,
    awaiting:false,          // esperando o aluno escolher esquerda/direita
    revealed:new Set(),      // cartas que já foram viradas
    mode:'manual'
};

document.getElementById('speedControl').addEventListener('input', e => {
    document.getElementById('speedLabel').textContent = e.target.value + 'ms';
});

function setMode(m){
    gs.mode = m;
    document.getElementById('btn-manual').classList.toggle('active', m==='manual');
    document.getElementById('btn-auto').classList.toggle('active', m==='auto');
    // Manual = cartas viradas para baixo | Automático = cartas abertas
    if(!gs.running && gs.cards.length) renderDeck();
}

function generateSortedDeck(n){
    const all = [];
    for(let sk in suits)
        for(let v of vals)
            all.push({ value:v, vnum:vnum(v), suit:sk, id:`${v}-${sk}` });
    // embaralha e pega n cartas
    for(let i=all.length-1;i>0;i--){
        const j=Math.floor(Math.random()*(i+1));
        [all[i],all[j]]=[all[j],all[i]];
    }
    const chosen = all.slice(0,n);
    // ordena
    chosen.sort(cmp);
    return chosen;
}

function newGame(){
    if(gs.running) return;
    const n = parseInt(document.getElementById('num-cards').value);
    gs.cards = generateSortedDeck(n);
    gs.target = gs.cards[Math.floor(Math.random()*n)];
    gs.lo = 0;
    gs.hi = n - 1;
    gs.mid = Math.floor((gs.lo + gs.hi) / 2);
    gs.comparisons = 0;
    gs.found = false;
    gs.running = false;
    gs.awaiting = false;
    gs.revealed = new Set();

    updateTargetDisplay();
    renderDeck();
    hideDecision();
    clearHint();
    clearConsole();
    updateStats();
    highlightPseudo(-1);
    updateProgress(0);
    document.getElementById('rangeIndicator').textContent = `Intervalo ativo: [${gs.lo} .. ${gs.hi}] | Meio: [${gs.mid}]`;

    log('🎮 Novo jogo! Baralho ORDENADO com ' + n + ' cartas.', 'info');
    log('🎯 Procurando: ' + gs.target.value + suits[gs.target.suit].symbol, 'info');
    if(gs.mode === 'manual'){
        log('🂠 As cartas estão viradas para baixo (mas em ordem).', 'info');
        log(`👆 Clique na carta do MEIO [${gs.mid}] para virar e comparar.`, 'info');
    } else {
        log('👆 Clique em "Auto Buscar" para iniciar a busca.', 'info');
    }
}

function updateTargetDisplay(){
    const t = gs.target;
    const el = document.getElementById('target-display');
    el.className = 'target-card-display ' + suits[t.suit].color;
    el.innerHTML = `<div>${t.value}</div><div style="font-size:18px">${suits[t.suit].symbol}</div>`;
}

// Desenha o baralho respeitando o estado atual do jogo.
// Manual: só as cartas já comparadas ficam viradas para cima.
// Automático: todas as cartas ficam abertas (como era antes).
function renderDeck(){
    const area = document.getElementById('deckArea');
    area.innerHTML = '';
    gs.cards.forEach((card, idx) => {
        const faceDown = (gs.mode === 'manual') && !gs.revealed.has(idx);
        const isFound = gs.found && idx === gs.mid;
        const isEliminated = !isFound && (idx < gs.lo || idx > gs.hi);

        const el = document.createElement('div');
        el.className = 'card ' + suits[card.suit].color
            + (faceDown ? ' facedown' : '')
            + (isEliminated ? ' eliminated' : '')
            + (isFound ? ' found' : '');
        el.id = 'card-' + idx;
        el.dataset.idx = idx;
        el.innerHTML = `
            <span class="card-index">[${idx}]</span>
            <div class="card-content" style="display:flex;flex-direction:column;align-items:center;">
                <div style="font-size:24px;line-height:1">${card.value}</div>
                <div style="font-size:18px;margin-top:4px">${suits[card.suit].symbol}</div>
            </div>
        `;
        el.addEventListener('click', () => handleCardClick(idx));
        area.appendChild(el);
    });
    if(!gs.found && gs.lo <= gs.hi) highlightMid();
}

function highlightMid(){
    // remove destaques anteriores
    document.querySelectorAll('.card').forEach(c => {
        const idx = parseInt(c.dataset.idx);
        c.classList.remove('mid-card','active-range');
        const lbl = c.querySelector('.card-mid-label');
        if(lbl) lbl.remove();
        if(idx >= gs.lo && idx <= gs.hi && !gs.found){
            c.classList.add('active-range');
        }
    });

    const midEl = document.getElementById('card-' + gs.mid);
    if(midEl && !gs.found){
        midEl.classList.remove('active-range');
        midEl.classList.add('mid-card');
        const lbl = document.createElement('span');
        lbl.className = 'card-mid-label';
        lbl.textContent = '▲ MEIO';
        midEl.appendChild(lbl);
    }

    updateStats();
    document.getElementById('rangeIndicator').textContent =
        `Intervalo ativo: [${gs.lo} .. ${gs.hi}] | Meio: [${gs.mid}]`;
}

// Animação de virar a carta (de costas para a frente)
function flipCard(el){
    if(!el || !el.classList.contains('facedown')) return;
    el.style.animation = 'none';              // pausa o pulsar para o giro aparecer
    el.style.transform = 'rotateY(90deg)';
    setTimeout(() => {
        el.classList.remove('facedown');
        el.style.transform = '';
    }, 150);
    setTimeout(() => { el.style.animation = ''; }, 450);
}

function handleCardClick(idx){
    if(gs.mode !== 'manual') return;
    if(gs.found || gs.running) return;
    if(gs.lo > gs.hi) return;
    if(gs.awaiting){
        log('⚠️ Primeiro escolha uma das opções abaixo do baralho.', 'warning');
        return;
    }
    if(idx !== gs.mid){
        log(`⚠️ Vire a carta do MEIO [${gs.mid}] — destacada em amarelo!`, 'warning');
        return;
    }
    performComparison();
}

function performComparison(){
    gs.awaiting = true;
    const midCard = gs.cards[gs.mid];
    const target  = gs.target;
    gs.comparisons++;
    gs.revealed.add(gs.mid);

    // Vira a carta do meio
    flipCard(document.getElementById('card-' + gs.mid));

    highlightPseudo(3);
    updateStats();
    log(`🔎 Comparando meio [${gs.mid}]: ${midCard.value}${suits[midCard.suit].symbol} vs alvo ${target.value}${suits[target.suit].symbol}`, 'info');

    const c = cmp(midCard, target);

    // Pequena pausa para o aluno ver a carta virando
    setTimeout(() => {
        if(c === 0){
            highlightPseudo(4);
            gs.awaiting = false;
            foundCard();
        } else {
            highlightPseudo(c < 0 ? 6 : 8);
            showDecision(midCard, target, c);
        }
    }, 400);
}

function showDecision(midCard, target, cmpResult){
    const box = document.getElementById('decisionBox');
    const title = document.getElementById('decisionTitle');
    title.innerHTML = `A carta do meio é <strong>${midCard.value}${suits[midCard.suit].symbol}</strong> e o alvo é <strong>${target.value}${suits[target.suit].symbol}</strong>.<br>O alvo está à esquerda, à direita, ou é essa carta?`;
    box.classList.add('show');
}

function decide(direction){
    hideDecision();
    const midCard = gs.cards[gs.mid];

    if(direction === 'found'){
        const c = cmp(midCard, gs.target);
        if(c === 0){
            gs.awaiting = false;
            foundCard();
        } else {
            log(`❌ Errado! ${midCard.value}${suits[midCard.suit].symbol} não é o alvo.`, 'error');
            setTimeout(() => showDecision(midCard, gs.target, c), 400);
        }
        return;
    }

    const realCmp = cmp(midCard, gs.target);
    const realDir = realCmp < 0 ? 'right' : 'left';

    if(direction !== realDir){
        log(`❌ Errado! O alvo está na direção oposta. Tente novamente.`, 'error');
        highlightMid();
        setTimeout(() => showDecision(midCard, gs.target, realCmp), 400);
        return;
    }

    gs.awaiting = false;

    if(direction === 'right'){
        highlightPseudo(7);
        // elimina metade esquerda
        for(let i=gs.lo; i<=gs.mid; i++){
            const el = document.getElementById('card-'+i);
            if(el){ el.classList.remove('mid-card','active-range'); el.classList.add('eliminated'); }
        }
        gs.lo = gs.mid + 1;
        log(`➡️ Alvo está à direita. Eliminando [0..${gs.mid}]. Novo intervalo: [${gs.lo}..${gs.hi}]`, 'warning');
    } else {
        highlightPseudo(9);
        // elimina metade direita
        for(let i=gs.mid; i<=gs.hi; i++){
            const el = document.getElementById('card-'+i);
            if(el){ el.classList.remove('mid-card','active-range'); el.classList.add('eliminated'); }
        }
        gs.hi = gs.mid - 1;
        log(`⬅️ Alvo está à esquerda. Eliminando [${gs.mid}..fim]. Novo intervalo: [${gs.lo}..${gs.hi}]`, 'warning');
    }

    if(gs.lo > gs.hi){
        log(`❌ Carta não encontrada no baralho!`, 'error');
        return;
    }

    gs.mid = Math.floor((gs.lo + gs.hi) / 2);
    const eliminated = gs.cards.length - (gs.hi - gs.lo + 1);
    updateProgress(Math.round((eliminated / gs.cards.length)*100));
    highlightPseudo(2);
    highlightMid();
    if(gs.mode === 'manual'){
        log(`🎯 Novo meio: [${gs.mid}]. Clique nele para virar.`, 'info');
    } else {
        log(`🎯 Novo meio: [${gs.mid}] = ${gs.cards[gs.mid].value}${suits[gs.cards[gs.mid].suit].symbol}`, 'info');
    }
}

function foundCard(){
    const el = document.getElementById('card-' + gs.mid);
    gs.revealed.add(gs.mid);
    flipCard(el);
    if(el){ el.classList.remove('mid-card','active-range'); el.classList.add('found'); }
    gs.found = true;

    const pts = Math.max(20, 200 - (gs.comparisons-1)*30);
    gs.score += pts;

    highlightPseudo(5);
    updateProgress(100);
    log(`🎉 ENCONTRADO em [${gs.mid}]! Comparações: ${gs.comparisons}`, 'found');
    updateStats(gs.mid);
    setTimeout(()=>showModal(gs.mid, pts), 600);
}

async function autoSearch(){
    if(gs.found || gs.running || gs.cards.length===0){ if(!gs.cards.length) newGame(); return; }
    setMode('auto');
    gs.running = true;
    gs.awaiting = false;
    hideDecision();
    const speed = parseInt(document.getElementById('speedControl').value);
    log('🤖 Iniciando busca binária automática...', 'info');

    while(gs.lo <= gs.hi && !gs.found && gs.running){
        gs.mid = Math.floor((gs.lo + gs.hi) / 2);
        highlightPseudo(3);
        highlightMid();
        await sleep(speed);

        const midCard = gs.cards[gs.mid];
        gs.comparisons++;
        gs.revealed.add(gs.mid);
        log(`🔎 Meio [${gs.mid}]: ${midCard.value}${suits[midCard.suit].symbol}`, 'info');
        await sleep(speed / 2);

        const c = cmp(midCard, gs.target);

        if(c === 0){
            foundCard();
            break;
        } else if(c < 0){
            highlightPseudo(7);
            for(let i=gs.lo; i<=gs.mid; i++){
                const el = document.getElementById('card-'+i);
                if(el){ el.classList.remove('mid-card','active-range'); el.classList.add('eliminated'); }
            }
            log(`➡️ Muito pequeno. Eliminando esquerda. Novo: [${gs.mid+1}..${gs.hi}]`, 'warning');
            gs.lo = gs.mid + 1;
        } else {
            highlightPseudo(9);
            for(let i=gs.mid; i<=gs.hi; i++){
                const el = document.getElementById('card-'+i);
                if(el){ el.classList.remove('mid-card','active-range'); el.classList.add('eliminated'); }
            }
            log(`⬅️ Muito grande. Eliminando direita. Novo: [${gs.lo}..${gs.mid-1}]`, 'warning');
            gs.hi = gs.mid - 1;
        }

        const eliminated = gs.cards.length - Math.max(0, gs.hi - gs.lo + 1);
        updateProgress(Math.round((eliminated / gs.cards.length)*100));
        await sleep(speed / 2);
    }

    if(!gs.found) log('❌ Carta não encontrada.', 'error');
    gs.running = false;
}

function highlightPseudo(line){
    for(let i=0;i<=10;i++){
        const el = document.getElementById('pl'+i);
        if(!el) continue;
        el.className = (i===line) ? 'pseudo-line active-line' : 'pseudo-line';
    }
}

function showHint(){
    if(!gs.target) return;
    let extra;
    if(gs.mode === 'manual'){
        // No manual a dica NÃO revela a posição do alvo, senão estraga a busca
        extra = `Procure o alvo (${gs.target.value}${suits[gs.target.suit].symbol}) virando só a carta do meio.
            Se o meio for menor que o alvo, descarte a esquerda; se for maior, descarte a direita.
            Intervalo atual: [${gs.lo} .. ${gs.hi}].`;
    } else {
        const pos = gs.cards.findIndex(c => c.id === gs.target.id);
        extra = `O alvo está na posição [${pos}]. Intervalo atual: [${gs.lo} .. ${gs.hi}].`;
    }
    document.getElementById('hint-container').innerHTML = `
        <div class="hint-box">
            <strong>💡 Dica:</strong>
            Na busca binária o baralho JÁ ESTÁ ORDENADO. Você verifica a carta do MEIO e elimina
            METADE do baralho a cada comparação. Isso é muito mais eficiente que a busca sequencial!
            ${extra}
        </div>
    `;
}

function hideDecision(){ document.getElementById('decisionBox').classList.remove('show'); }
function clearHint(){ document.getElementById('hint-container').innerHTML = ''; }

function updateStats(foundPos){
    document.getElementById('stat-comp').textContent  = gs.comparisons;
    document.getElementById('stat-range').textContent = `[${gs.lo}..${gs.hi}]`;
    // No manual, o valor do meio só aparece depois de a carta ser virada
    const midCard = gs.cards[gs.mid];
    const showMid = midCard && (gs.mode !== 'manual' || gs.revealed.has(gs.mid));
    document.getElementById('stat-mid').textContent   = showMid ? midCard.value + suits[midCard.suit].symbol : '?';
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

function clearConsole(){ document.getElementById('console').innerHTML = ''; }

function showModal(pos, pts){
    document.getElementById('resultIcon').textContent   = '🎉';
    document.getElementById('resultTitle').textContent  = 'Carta Encontrada!';
    document.getElementById('resultMsg').textContent    =
        `Encontrou ${gs.target.value}${suits[gs.target.suit].symbol} na posição [${pos}] com apenas ${gs.comparisons} comparação(ões)! O(log n) em ação!`;
    document.getElementById('modalComp').textContent    = gs.comparisons;
    document.getElementById('modalPos').textContent     = pos;
    document.getElementById('modalScore').textContent   = '+' + pts;
    document.getElementById('resultModal').classList.add('show');
}

function closeModal(){ document.getElementById('resultModal').classList.remove('show'); }
function sleep(ms){ return new Promise(r=>setTimeout(r,ms)); }

newGame();
</script>
</body>
</html>