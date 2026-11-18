<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Ordenação - Modo Jogo Interativo</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    * { box-sizing: border-box; }
    
    body {
		background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 50%, #3d3d3d 100%);
		min-height: 100vh;
		padding: 20px 0;
		font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
	}
    
    .main-container {
        background: rgba(255, 255, 255, 0.98);
        border-radius: 25px;
        padding: 30px;
        box-shadow: 0 25px 80px rgba(0, 0, 0, 0.4);
        max-width: 1600px;
        margin: 0 auto;
    }
    
    h1 {
		font-size: 36px;
		font-weight: 800;
		background: linear-gradient(135deg, #ff4757 0%, #e84118 100%);
		-webkit-background-clip: text;
		-webkit-text-fill-color: transparent;
		background-clip: text;
		margin-bottom: 10px;
		text-align: center;
	}

    .mode-tabs {
        display: flex;
        gap: 10px;
        margin-bottom: 25px;
        border-bottom: 3px solid #e9ecef;
        padding-bottom: 10px;
    }
    
    .mode-tab {
        padding: 12px 24px;
        border: none;
        background: white;
        border-radius: 10px 10px 0 0;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
        border-bottom: 3px solid transparent;
    }
    
    .mode-tab.active {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border-bottom-color: #667eea;
    }
    
    .mode-tab:hover:not(.active) {
        background: #f8f9fa;
    }

    .stats-header {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
        margin-bottom: 25px;
        padding: 20px;
        background: linear-gradient(135deg, rgba(102,126,234,0.1), rgba(118,75,162,0.1));
        border-radius: 15px;
    }
    
    .stat-box {
        text-align: center;
        padding: 15px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: transform 0.3s;
    }
    
    .stat-box:hover {
        transform: translateY(-5px);
    }
    
    .stat-value {
        font-size: 32px;
        font-weight: 800;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .stat-label {
        font-size: 12px;
        color: #666;
        text-transform: uppercase;
        font-weight: 600;
        letter-spacing: 0.5px;
        margin-top: 5px;
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
        padding: 12px 24px;
        border: none;
        border-radius: 10px;
        font-weight: 700;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    
    .btn-game:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.25);
    }
    
    .btn-primary-game {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
    }
    
    .btn-success-game {
        background: linear-gradient(135deg, #56ab2f, #a8e063);
        color: white;
    }
    
    .btn-danger-game {
        background: linear-gradient(135deg, #ff512f, #dd2476);
        color: white;
    }
    
    .btn-warning-game {
        background: linear-gradient(135deg, #f09819, #ff512f);
        color: white;
    }
    
    .btn-info-game {
        background: linear-gradient(135deg, #4facfe, #00f2fe);
        color: white;
    }

    .game-area {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 25px;
        margin-bottom: 25px;
    }
    
    .play-zone {
        background: linear-gradient(to bottom, #f8f9fa, #e9ecef);
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }
    
    .cards-container {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        justify-content: center;
        align-items: flex-end;
        min-height: 150px;
        padding: 20px;
        background: white;
        border-radius: 15px;
        border: 3px dashed #dee2e6;
        margin-top: 15px;
    }
    
    .cards-container.drop-active {
        border-color: #667eea;
        background: rgba(102, 126, 234, 0.05);
        box-shadow: 0 0 20px rgba(102, 126, 234, 0.2);
    }

    .card {
        width: 80px;
        height: 115px;
        border: 4px solid #2c2c2c;
        border-radius: 10px;
        background: linear-gradient(145deg, #fff, #f5f5f5);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 28px;
        cursor: grab;
        user-select: none;
        position: relative;
        box-shadow: 0 6px 15px rgba(0,0,0,0.2);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .card:hover {
        transform: translateY(-10px) scale(1.05);
        box-shadow: 0 15px 35px rgba(0,0,0,0.3);
    }
    
    .card.dragging {
        opacity: 0.5;
        transform: rotate(8deg) scale(0.95);
        cursor: grabbing;
    }
    
    .card.red { color: #dc3545; }
    .card.black { color: #000; }
    
    .card.correct {
        animation: correctPulse 0.6s ease;
        border-color: #28a745;
        box-shadow: 0 0 30px rgba(40, 167, 69, 0.6);
    }
    
    .card.wrong {
        animation: wrongShake 0.5s ease;
        border-color: #dc3545;
    }
    
    .card.comparing {
        border-color: #ffc107;
        box-shadow: 0 0 25px rgba(255, 193, 7, 0.8);
        animation: comparing 0.8s ease;
    }
    
    .card.swapping {
        animation: swap 0.6s ease;
    }
    
    @keyframes correctPulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.15); }
    }
    
    @keyframes wrongShake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-10px); }
        75% { transform: translateX(10px); }
    }
    
    @keyframes comparing {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-15px); }
    }
    
    @keyframes swap {
        0% { transform: translateY(0); }
        50% { transform: translateY(-30px); }
        100% { transform: translateY(0); }
    }
    
    .card-value {
        font-size: 32px;
        line-height: 1;
    }
    
    .card-symbol {
        font-size: 24px;
        margin-top: 5px;
    }

    .side-panel {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    
    .info-panel {
        background: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    }
    
    .panel-title {
        font-weight: 700;
        font-size: 18px;
        margin-bottom: 15px;
        color: #495057;
    }
    
    .algorithm-desc {
        background: linear-gradient(135deg, rgba(102,126,234,0.1), rgba(118,75,162,0.1));
        padding: 15px;
        border-radius: 10px;
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 15px;
    }
    
    .progress-bar-container {
        background: #e9ecef;
        height: 25px;
        border-radius: 15px;
        overflow: hidden;
        margin-bottom: 10px;
        position: relative;
    }
    
    .progress-bar-fill {
        height: 100%;
        background: linear-gradient(90deg, #667eea, #764ba2);
        transition: width 0.5s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 12px;
    }

    .console {
        background: #1e1e1e;
        color: #00ff00;
        padding: 15px;
        border-radius: 10px;
        font-family: 'Courier New', monospace;
        font-size: 13px;
        height: 200px;
        overflow-y: auto;
        box-shadow: inset 0 2px 8px rgba(0,0,0,0.3);
    }
    
    .console-line {
        margin-bottom: 5px;
        padding: 3px 5px;
        border-radius: 3px;
        animation: fadeIn 0.3s ease;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateX(-10px); }
        to { opacity: 1; transform: translateX(0); }
    }
    
    .console-line.success { color: #00ff00; }
    .console-line.error { color: #ff4444; }
    .console-line.warning { color: #ffaa00; }
    .console-line.info { color: #00aaff; }

    .code-viewer {
        background: #2d2d2d;
        color: #f8f8f2;
        padding: 20px;
        border-radius: 10px;
        font-family: 'Courier New', monospace;
        font-size: 14px;
        line-height: 1.8;
        overflow-x: auto;
        max-height: 500px;
        overflow-y: auto;
        white-space: pre;
    }
    
    .code-keyword { color: #ff79c6; font-weight: bold; }
    .code-function { color: #50fa7b; font-weight: bold; }
    .code-number { color: #bd93f9; }
    .code-comment { color: #6272a4; font-style: italic; }
    .code-string { color: #f1fa8c; }

    .result-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        z-index: 1000;
        justify-content: center;
        align-items: center;
    }
    
    .result-modal.show {
        display: flex;
        animation: modalFadeIn 0.3s ease;
    }
    
    @keyframes modalFadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    .result-content {
        background: white;
        padding: 40px;
        border-radius: 25px;
        max-width: 500px;
        text-align: center;
        box-shadow: 0 25px 80px rgba(0,0,0,0.5);
        animation: modalSlideIn 0.4s ease;
    }
    
    @keyframes modalSlideIn {
        from { transform: translateY(-50px) scale(0.9); }
        to { transform: translateY(0) scale(1); }
    }
    
    .result-icon {
        font-size: 80px;
        margin-bottom: 20px;
    }
    
    .result-title {
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 15px;
    }
    
    .result-score {
        font-size: 48px;
        font-weight: 800;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 20px;
    }
    
    .result-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin: 25px 0;
    }
    
    .result-stat {
        padding: 15px;
        background: #f8f9fa;
        border-radius: 10px;
    }
    
    .result-stat-value {
        font-size: 24px;
        font-weight: 700;
        color: #667eea;
    }
    
    .result-stat-label {
        font-size: 12px;
        color: #666;
        margin-top: 5px;
    }

    .hint-box {
        background: linear-gradient(135deg, #ffeaa7, #fdcb6e);
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 15px;
        border-left: 5px solid #f39c12;
        box-shadow: 0 4px 12px rgba(243, 156, 18, 0.2);
    }
    
    .hint-box strong {
        display: block;
        margin-bottom: 5px;
        color: #d35400;
    }
    
    .suit-priority-box {
        background: linear-gradient(135deg, #e3f2fd, #bbdefb);
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 15px;
        border-left: 5px solid #2196f3;
    }
    
    .suit-priority-box strong {
        display: block;
        margin-bottom: 8px;
        color: #1565c0;
    }
    
    .suit-example {
        display: inline-block;
        padding: 5px 10px;
        background: white;
        border-radius: 5px;
        margin: 3px;
        font-weight: 700;
    }

    .tab-content {
        display: none;
    }
    
    .tab-content.active {
        display: block;
    }

    @media (max-width: 1200px) {
        .game-area {
            grid-template-columns: 1fr;
        }
        
        .card {
            width: 70px;
            height: 100px;
            font-size: 24px;
        }
    }
</style>
</head>
<body>
<div class="container-fluid">
    <div class="main-container">
        <h1>🎮 Ordenação - Modo Jogo Interativo</h1>
        <p class="text-center text-muted mb-4">Aprenda algoritmos de ordenação de forma divertida!</p>

        <!-- TABS DE MODO -->
        <div class="mode-tabs">
            <button class="mode-tab active" onclick="switchTab('practice')">🎯 Modo Prática</button>
            <button class="mode-tab" onclick="switchTab('visualize')">👁️ Visualizar Algoritmo</button>
            <button class="mode-tab" onclick="switchTab('code')">💻 Ver Código</button>
        </div>

        <div class="stats-header">
            <div class="stat-box">
                <div class="stat-value" id="stat-score">0</div>
                <div class="stat-label">⭐ Pontuação</div>
            </div>
            <div class="stat-box">
                <div class="stat-value" id="stat-moves">0</div>
                <div class="stat-label">🔄 Movimentos</div>
            </div>
            <div class="stat-box">
                <div class="stat-value" id="stat-time">0:00</div>
                <div class="stat-label">⏱️ Tempo</div>
            </div>
            <div class="stat-box">
                <div class="stat-value" id="stat-steps">0</div>
                <div class="stat-label">👣 Passos Corretos</div>
            </div>
        </div>

        <!-- TAB: MODO PRÁTICA -->
        <div id="tab-practice" class="tab-content active">
            <div class="controls-panel">
                <select id="algorithm-select" class="form-select" style="width: 180px;" onchange="selectAlgorithm()">
                    <option value="bubble">Bubble Sort</option>
                    <option value="selection">Selection Sort</option>
                    <option value="insertion">Insertion Sort</option>
                </select>
                
                <select id="difficulty-select" class="form-select" style="width: 150px;">
                    <option value="5">Fácil (5 cartas)</option>
                    <option value="7" selected>Médio (7 cartas)</option>
                    <option value="10">Difícil (10 cartas)</option>
                </select>
                
                <button class="btn-game btn-primary-game" onclick="startGame()">🎲 Novo Jogo</button>
                <button class="btn-game btn-success-game" onclick="validateMove()">✓ Validar Movimento</button>
                <button class="btn-game btn-warning-game" onclick="showHint()">💡 Dica</button>
                <button class="btn-game btn-danger-game" onclick="undoMove()">↩️ Desfazer</button>
            </div>

            <div class="game-area">
                <div class="play-zone">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">🎯 Área de Ordenação</h5>
                        <div class="badge bg-primary" style="font-size: 14px;">Siga o algoritmo!</div>
                    </div>
                    
                    <div id="hint-container"></div>
                    
                    <div class="suit-priority-box">
                        <strong>📏 Regras de Ordenação:</strong>
                        <div class="small">
                            <div class="mb-2">1. Ordenar por VALOR (A=1 até K=13)</div>
                            <div>2. Em caso de empate, usar NAIPE (maior→menor):</div>
                            <div class="mt-2">
                                <span class="suit-example" style="color: #000;">♣ Paus (4)</span>
                                <span class="suit-example" style="color: #dc3545;">♥ Copas (3)</span>
                                <span class="suit-example" style="color: #000;">♠ Espadas (2)</span>
                                <span class="suit-example" style="color: #dc3545;">♦ Ouros (1)</span>
                            </div>
                            <div class="mt-2 small text-muted">Exemplo: 4♣ > 4♥ > 4♠ > 4♦</div>
                        </div>
                    </div>
                    
                    <div class="cards-container" id="playArea"></div>
                    
                    <div class="mt-3">
                        <div class="progress-bar-container">
                            <div class="progress-bar-fill" id="progressBar" style="width: 0%">0%</div>
                        </div>
                        <small class="text-muted">Progresso: passos corretos do algoritmo</small>
                    </div>
                </div>

                <div class="side-panel">
                    <div class="info-panel">
                        <div class="panel-title">📚 Algoritmo</div>
                        <div class="algorithm-desc" id="algorithmDesc"></div>
                        <div>
                            <strong class="small d-block mb-2">Próximo Passo:</strong>
                            <div class="small" id="nextStep" style="padding: 10px; background: #fff3cd; border-radius: 5px; font-weight: 600;"></div>
                        </div>
                    </div>
                    
                    <div class="info-panel">
                        <div class="panel-title">📊 Console</div>
                        <div class="console" id="console">
                            <div class="console-line info">Sistema iniciado. Pronto para jogar!</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB: VISUALIZAR ALGORITMO -->
        <div id="tab-visualize" class="tab-content">
            <div class="controls-panel">
                <select id="viz-algorithm" class="form-select" style="width: 180px;">
                    <option value="bubble">Bubble Sort</option>
                    <option value="selection">Selection Sort</option>
                    <option value="insertion">Insertion Sort</option>
                </select>
                
                <select id="viz-speed" class="form-select" style="width: 150px;">
                    <option value="2000">Muito Lento</option>
                    <option value="1000" selected>Lento</option>
                    <option value="500">Normal</option>
                    <option value="200">Rápido</option>
                </select>
                
                <button class="btn-game btn-primary-game" onclick="startVisualization()">▶️ Iniciar</button>
                <button class="btn-game btn-warning-game" onclick="pauseVisualization()">⏸️ Pausar</button>
                <button class="btn-game btn-danger-game" onclick="stopVisualization()">⏹️ Parar</button>
            </div>

            <div class="play-zone">
                <h5 class="mb-3">👁️ Visualização do Algoritmo</h5>
                <div class="cards-container" id="vizArea"></div>
                
                <div class="mt-3">
                    <div class="info-panel">
                        <div class="panel-title">📝 Explicação Passo a Passo</div>
                        <div class="console" id="vizConsole">
                            <div class="console-line info">Clique em "Iniciar" para ver o algoritmo em ação!</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB: VER CÓDIGO -->
        <div id="tab-code" class="tab-content">
            <div class="controls-panel">
                <select id="code-algorithm" class="form-select" style="width: 200px;" onchange="showCode()">
                    <option value="bubble">Bubble Sort</option>
                    <option value="selection">Selection Sort</option>
                    <option value="insertion">Insertion Sort</option>
                </select>
                
                <select id="code-language" class="form-select" style="width: 150px;" onchange="showCode()">
                    <option value="javascript">JavaScript</option>
                    <option value="python">Python</option>
                    <option value="java">Java</option>
                </select>
            </div>

            <div class="play-zone">
                <h5 class="mb-3">💻 Código Real do Algoritmo</h5>
                <div class="code-viewer" id="codeViewer"></div>
            </div>
        </div>
    </div>
</div>

<div class="result-modal" id="resultModal">
    <div class="result-content">
        <div class="result-icon" id="resultIcon">🎉</div>
        <div class="result-title" id="resultTitle">Parabéns!</div>
        <div class="result-score" id="resultScoreDisplay">+100</div>
        
        <div class="result-stats">
            <div class="result-stat">
                <div class="result-stat-value" id="modalMoves">0</div>
                <div class="result-stat-label">Movimentos</div>
            </div>
            <div class="result-stat">
                <div class="result-stat-value" id="modalTime">0s</div>
                <div class="result-stat-label">Tempo</div>
            </div>
            <div class="result-stat">
                <div class="result-stat-value" id="modalSteps">0</div>
                <div class="result-stat-label">Passos Corretos</div>
            </div>
        </div>
        
        <button class="btn-game btn-primary-game mt-3" onclick="closeResultModal(); startGame();">🎮 Jogar Novamente</button>
        <button class="btn-game btn-success-game mt-2" onclick="closeResultModal();">✓ Continuar</button>
    </div>
</div>

<script>
const suits = {
    hearts: { symbol:'♥', color:'red', weight:3, name:'Copas' },
    diamonds: { symbol:'♦', color:'red', weight:1, name:'Ouros' },
    clubs: { symbol:'♣', color:'black', weight:4, name:'Paus' },
    spades: { symbol:'♠', color:'black', weight:2, name:'Espadas' }
};

const values = ['A','2','3','4','5','6','7','8','9','10','J','Q','K'];

function valueToNum(v) {
    if (v === 'A') return 1;
    if (v === 'J') return 11;
    if (v === 'Q') return 12;
    if (v === 'K') return 13;
    return parseInt(v, 10);
}

let gameState = {
    cards: [],
    correctOrder: [],
    expectedSteps: [],
    currentStepIndex: 0,
    moves: 0,
    correctSteps: 0,
    score: 0,
    startTime: null,
    timerInterval: null,
    draggedIndex: null,
    algorithm: 'bubble',
    moveHistory: []
};

let vizState = {
    isRunning: false,
    isPaused: false,
    cards: [],
    stepIndex: 0,
    steps: []
};

const algorithmInfo = {
    bubble: {
        name: 'Bubble Sort',
        desc: 'Compara pares adjacentes e troca se estiverem fora de ordem. O maior "borbulha" para o final a cada passada.',
        hint: 'Compare as duas primeiras cartas adjacentes. Se estiverem fora de ordem, troque-as!'
    },
    selection: {
        name: 'Selection Sort',
        desc: 'Encontra o menor elemento e coloca na primeira posição não ordenada. Repete até ordenar tudo.',
        hint: 'Encontre a menor carta de todas as não ordenadas e coloque-a na próxima posição!'
    },
    insertion: {
        name: 'Insertion Sort',
        desc: 'Pega cada elemento e insere em sua posição correta no subarray já ordenado à esquerda.',
        hint: 'Pegue a próxima carta não ordenada e insira na posição correta entre as já ordenadas!'
    }
};

function switchTab(tabName) {
    document.querySelectorAll('.mode-tab').forEach(tab => tab.classList.remove('active'));
    document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
    
    event.target.classList.add('active');
    document.getElementById('tab-' + tabName).classList.add('active');
    
    if (tabName === 'code') showCode();
}

function selectAlgorithm() {
    gameState.algorithm = document.getElementById('algorithm-select').value;
    const info = algorithmInfo[gameState.algorithm];
    document.getElementById('algorithmDesc').innerHTML = `<strong>${info.name}</strong><br>${info.desc}`;
    log(`Algoritmo: ${info.name}`, 'info');
}

function compareCards(a, b) {
    if (a.vnum !== b.vnum) return a.vnum - b.vnum;
    return suits[b.suit].weight - suits[a.suit].weight;
}

function startGame() {
    gameState.moves = 0;
    gameState.correctSteps = 0;
    gameState.score = 0;
    gameState.currentStepIndex = 0;
    gameState.startTime = Date.now();
    gameState.moveHistory = [];
    
    clearInterval(gameState.timerInterval);
    gameState.timerInterval = setInterval(updateTimer, 1000);
    
    const numCards = parseInt(document.getElementById('difficulty-select').value);
    gameState.cards = generateRandomCards(numCards);
    gameState.correctOrder = [...gameState.cards].sort(compareCards);
    
    for (let i = gameState.cards.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [gameState.cards[i], gameState.cards[j]] = [gameState.cards[j], gameState.cards[i]];
    }
    
    gameState.expectedSteps = generateAlgorithmSteps(gameState.cards, gameState.algorithm);
    
    renderCards();
    updateStats();
    updateNextStep();
    clearHint();
    
    log('🎮 Novo jogo iniciado!', 'success');
    log(`Ordene usando ${algorithmInfo[gameState.algorithm].name}`, 'info');
    log(`Siga os passos do algoritmo corretamente!`, 'warning');
}

function generateRandomCards(num) {
    const allCards = [];
    for (let suit in suits) {
        for (let value of values) {
            allCards.push({
                value: value,
                vnum: valueToNum(value),
                suit: suit,
                id: `${value}-${suit}`
            });
        }
    }
    
    for (let i = allCards.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [allCards[i], allCards[j]] = [allCards[j], allCards[i]];
    }
    
    return allCards.slice(0, num);
}

function generateAlgorithmSteps(cards, algorithm) {
    const arr = cards.map(c => ({...c}));
    const steps = [];
    
    if (algorithm === 'bubble') {
        for (let i = 0; i < arr.length; i++) {
            for (let j = 0; j < arr.length - 1 - i; j++) {
                if (compareCards(arr[j], arr[j + 1]) > 0) {
                    steps.push({ type: 'swap', i: j, j: j + 1, desc: `Trocar posições ${j} e ${j+1}` });
                    [arr[j], arr[j + 1]] = [arr[j + 1], arr[j]];
                }
            }
        }
    } else if (algorithm === 'selection') {
        for (let i = 0; i < arr.length - 1; i++) {
            let minIdx = i;
            for (let j = i + 1; j < arr.length; j++) {
                if (compareCards(arr[j], arr[minIdx]) < 0) {
                    minIdx = j;
                }
            }
            if (minIdx !== i) {
                steps.push({ type: 'swap', i: i, j: minIdx, desc: `Trocar menor carta (pos ${minIdx}) com posição ${i}` });
                [arr[i], arr[minIdx]] = [arr[minIdx], arr[i]];
            }
        }
    } else if (algorithm === 'insertion') {
        for (let i = 1; i < arr.length; i++) {
            let j = i;
            while (j > 0 && compareCards(arr[j - 1], arr[j]) > 0) {
                steps.push({ type: 'swap', i: j - 1, j: j, desc: `Inserir carta na posição correta (trocar ${j-1} e ${j})` });
                [arr[j - 1], arr[j]] = [arr[j], arr[j - 1]];
                j--;
            }
        }
    }
    
    return steps;
}

function renderCards() {
    const area = document.getElementById('playArea');
    area.innerHTML = '';
    
    gameState.cards.forEach((card, index) => {
        const el = document.createElement('div');
        el.className = 'card ' + suits[card.suit].color;
        el.draggable = true;
        el.dataset.index = index;
        el.innerHTML = `
            <div class="card-value">${card.value}</div>
            <div class="card-symbol">${suits[card.suit].symbol}</div>
        `;
        
        el.addEventListener('dragstart', handleDragStart);
        el.addEventListener('dragend', handleDragEnd);
        el.addEventListener('dragover', handleDragOver);
        el.addEventListener('drop', handleDrop);
        
        area.appendChild(el);
    });
}

function handleDragStart(e) {
    gameState.draggedIndex = parseInt(e.target.dataset.index);
    e.target.classList.add('dragging');
    e.dataTransfer.effectAllowed = 'move';
}

function handleDragEnd(e) {
    e.target.classList.remove('dragging');
}

function handleDragOver(e) {
    e.preventDefault();
    e.dataTransfer.dropEffect = 'move';
}

function handleDrop(e) {
    e.preventDefault();
    
    const dropIndex = parseInt(e.target.closest('.card').dataset.index);
    
    if (gameState.draggedIndex === null || gameState.draggedIndex === dropIndex) {
        return;
    }
    
    gameState.moveHistory.push([...gameState.cards]);
    
    const [movedCard] = gameState.cards.splice(gameState.draggedIndex, 1);
    gameState.cards.splice(dropIndex, 0, movedCard);
    
    gameState.moves++;
    renderCards();
    
    log(`Movimento ${gameState.moves}: ${movedCard.value}${suits[movedCard.suit].symbol} movido`, 'info');
    
    gameState.draggedIndex = null;
}

function validateMove() {
    if (gameState.moveHistory.length === 0) {
        log('❌ Nenhum movimento para validar!', 'error');
        return;
    }
    
    const previousState = gameState.moveHistory[gameState.moveHistory.length - 1];
    
    if (gameState.currentStepIndex >= gameState.expectedSteps.length) {
        const isSorted = checkIfSorted();
        if (isSorted) {
            log('✅ Array já está ordenado!', 'success');
            gameComplete();
        } else {
            log('❌ Movimento incorreto! Array deveria estar ordenado.', 'error');
            undoMove();
        }
        return;
    }
    
    const expectedStep = gameState.expectedSteps[gameState.currentStepIndex];
    const prevCards = previousState;
    const currCards = gameState.cards;
    
    let isCorrect = false;
    
    if (expectedStep.type === 'swap') {
        const card1Prev = prevCards[expectedStep.i];
        const card2Prev = prevCards[expectedStep.j];
        const card1Curr = currCards[expectedStep.j];
        const card2Curr = currCards[expectedStep.i];
        
        if (card1Prev.id === card1Curr.id && card2Prev.id === card2Curr.id) {
            isCorrect = true;
        }
    }
    
    if (isCorrect) {
        gameState.correctSteps++;
        gameState.currentStepIndex++;
        log(`✅ CORRETO! Passo ${gameState.currentStepIndex}/${gameState.expectedSteps.length}`, 'success');
        
        const cards = document.querySelectorAll('.card');
        cards[expectedStep.i].classList.add('correct');
        cards[expectedStep.j].classList.add('correct');
        setTimeout(() => {
            cards[expectedStep.i].classList.remove('correct');
            cards[expectedStep.j].classList.remove('correct');
        }, 600);
        
        if (gameState.currentStepIndex >= gameState.expectedSteps.length) {
            const isSorted = checkIfSorted();
            if (isSorted) {
                gameComplete();
            }
        } else {
            updateNextStep();
        }
    } else {
        log(`❌ Movimento incorreto! Não segue o algoritmo ${algorithmInfo[gameState.algorithm].name}`, 'error');
        log(`Esperado: ${expectedStep.desc}`, 'warning');
        undoMove();
    }
    
    updateStats();
}

function undoMove() {
    if (gameState.moveHistory.length === 0) {
        log('❌ Nenhum movimento para desfazer!', 'error');
        return;
    }
    
    gameState.cards = gameState.moveHistory.pop();
    gameState.moves = Math.max(0, gameState.moves - 1);
    renderCards();
    updateStats();
    log('↩️ Movimento desfeito', 'warning');
}

function checkIfSorted() {
    for (let i = 0; i < gameState.cards.length; i++) {
        if (gameState.cards[i].id !== gameState.correctOrder[i].id) {
            return false;
        }
    }
    return true;
}

function gameComplete() {
    clearInterval(gameState.timerInterval);
    const timeTaken = Math.floor((Date.now() - gameState.startTime) / 1000);
    const efficiency = Math.round((gameState.correctSteps / gameState.moves) * 100);
    const scoreEarned = Math.max(100, 1000 - (gameState.moves * 20) - (timeTaken * 5) + (efficiency * 10));
    
    gameState.score += scoreEarned;
    
    showResultModal(true, scoreEarned, timeTaken, efficiency);
    log('🎉 PARABÉNS! Você ordenou corretamente seguindo o algoritmo!', 'success');
    createConfetti();
}

function updateNextStep() {
    const nextStepEl = document.getElementById('nextStep');
    if (gameState.currentStepIndex < gameState.expectedSteps.length) {
        const step = gameState.expectedSteps[gameState.currentStepIndex];
        const card1 = gameState.cards[step.i];
        const card2 = gameState.cards[step.j];
        nextStepEl.innerHTML = `Troque: <strong>${card1.value}${suits[card1.suit].symbol}</strong> ↔ <strong>${card2.value}${suits[card2.suit].symbol}</strong><br><small>(Posições ${step.i} e ${step.j})</small>`;
    } else {
        nextStepEl.innerHTML = 'Algoritmo completo! Verifique se está ordenado.';
    }
}

function showHint() {
    const hint = algorithmInfo[gameState.algorithm].hint;
    const hintContainer = document.getElementById('hint-container');
    hintContainer.innerHTML = `
        <div class="hint-box">
            <strong>💡 Dica (${algorithmInfo[gameState.algorithm].name}):</strong>
            ${hint}
        </div>
    `;
}

function clearHint() {
    document.getElementById('hint-container').innerHTML = '';
}

function updateStats() {
    document.getElementById('stat-score').textContent = gameState.score;
    document.getElementById('stat-moves').textContent = gameState.moves;
    document.getElementById('stat-steps').textContent = `${gameState.correctSteps}/${gameState.expectedSteps.length}`;
    
    const progress = gameState.expectedSteps.length > 0 
        ? Math.round((gameState.correctSteps / gameState.expectedSteps.length) * 100)
        : 0;
    const progressBar = document.getElementById('progressBar');
    progressBar.style.width = progress + '%';
    progressBar.textContent = progress + '%';
}

function updateTimer() {
    if (!gameState.startTime) return;
    const elapsed = Math.floor((Date.now() - gameState.startTime) / 1000);
    const minutes = Math.floor(elapsed / 60);
    const seconds = elapsed % 60;
    document.getElementById('stat-time').textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
}

function log(message, type = 'info') {
    const console = document.getElementById('console');
    const line = document.createElement('div');
    line.className = `console-line ${type}`;
    const timestamp = new Date().toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
    line.textContent = `[${timestamp}] ${message}`;
    console.appendChild(line);
    console.scrollTop = console.scrollHeight;
}

// VISUALIZAÇÃO
async function startVisualization() {
    const algo = document.getElementById('viz-algorithm').value;
    const speed = parseInt(document.getElementById('viz-speed').value);
    
    vizState.cards = generateRandomCards(7);
    for (let i = vizState.cards.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [vizState.cards[i], vizState.cards[j]] = [vizState.cards[j], vizState.cards[i]];
    }
    
    vizState.isRunning = true;
    vizState.isPaused = false;
    renderVizCards();
    
    vizLog('▶️ Iniciando visualização de ' + algorithmInfo[algo].name, 'info');
    
    if (algo === 'bubble') await visualizeBubbleSort(speed);
    else if (algo === 'selection') await visualizeSelectionSort(speed);
    else if (algo === 'insertion') await visualizeInsertionSort(speed);
    
    vizLog('✅ Ordenação completa!', 'success');
    vizState.isRunning = false;
}

function pauseVisualization() {
    vizState.isPaused = !vizState.isPaused;
    vizLog(vizState.isPaused ? '⏸️ Pausado' : '▶️ Retomado', 'warning');
}

function stopVisualization() {
    vizState.isRunning = false;
    vizState.isPaused = false;
    vizLog('⏹️ Parado', 'error');
}

async function visualizeBubbleSort(speed) {
    const n = vizState.cards.length;
    for (let i = 0; i < n && vizState.isRunning; i++) {
        for (let j = 0; j < n - 1 - i && vizState.isRunning; j++) {
            while (vizState.isPaused) await sleep(100);
            
            highlightVizCards([j, j + 1], 'comparing');
            vizLog(`Comparando posições ${j} e ${j+1}: ${vizState.cards[j].value}${suits[vizState.cards[j].suit].symbol} vs ${vizState.cards[j+1].value}${suits[vizState.cards[j+1].suit].symbol}`, 'info');
            await sleep(speed);
            
            if (compareCards(vizState.cards[j], vizState.cards[j + 1]) > 0) {
                vizLog(`  → Trocando!`, 'warning');
                highlightVizCards([j, j + 1], 'swapping');
                await sleep(speed / 2);
                [vizState.cards[j], vizState.cards[j + 1]] = [vizState.cards[j + 1], vizState.cards[j]];
                renderVizCards();
                await sleep(speed / 2);
            }
            
            clearVizHighlights();
        }
    }
}

async function visualizeSelectionSort(speed) {
    const n = vizState.cards.length;
    for (let i = 0; i < n - 1 && vizState.isRunning; i++) {
        while (vizState.isPaused) await sleep(100);
        
        let minIdx = i;
        vizLog(`Passada ${i+1}: Procurando o menor elemento...`, 'info');
        
        for (let j = i + 1; j < n && vizState.isRunning; j++) {
            highlightVizCards([minIdx, j], 'comparing');
            await sleep(speed);
            
            if (compareCards(vizState.cards[j], vizState.cards[minIdx]) < 0) {
                minIdx = j;
                vizLog(`  → Novo menor encontrado na posição ${j}`, 'warning');
            }
            clearVizHighlights();
        }
        
        if (minIdx !== i) {
            vizLog(`Trocando posições ${i} e ${minIdx}`, 'success');
            highlightVizCards([i, minIdx], 'swapping');
            await sleep(speed);
            [vizState.cards[i], vizState.cards[minIdx]] = [vizState.cards[minIdx], vizState.cards[i]];
            renderVizCards();
        }
        await sleep(speed);
        clearVizHighlights();
    }
}

async function visualizeInsertionSort(speed) {
    const n = vizState.cards.length;
    for (let i = 1; i < n && vizState.isRunning; i++) {
        while (vizState.isPaused) await sleep(100);
        
        vizLog(`Inserindo elemento da posição ${i}...`, 'info');
        let j = i;
        
        while (j > 0 && compareCards(vizState.cards[j - 1], vizState.cards[j]) > 0 && vizState.isRunning) {
            highlightVizCards([j - 1, j], 'swapping');
            vizLog(`  → Movendo para a esquerda (${j-1} ↔ ${j})`, 'warning');
            await sleep(speed);
            
            [vizState.cards[j - 1], vizState.cards[j]] = [vizState.cards[j], vizState.cards[j - 1]];
            renderVizCards();
            j--;
            await sleep(speed / 2);
            clearVizHighlights();
        }
        
        vizLog(`Elemento inserido na posição ${j}`, 'success');
        await sleep(speed / 2);
    }
}

function renderVizCards() {
    const area = document.getElementById('vizArea');
    area.innerHTML = '';
    
    vizState.cards.forEach((card, index) => {
        const el = document.createElement('div');
        el.className = 'card ' + suits[card.suit].color;
        el.dataset.index = index;
        el.innerHTML = `
            <div class="card-value">${card.value}</div>
            <div class="card-symbol">${suits[card.suit].symbol}</div>
        `;
        area.appendChild(el);
    });
}

function highlightVizCards(indices, className) {
    const cards = document.querySelectorAll('#vizArea .card');
    indices.forEach(i => {
        if (cards[i]) cards[i].classList.add(className);
    });
}

function clearVizHighlights() {
    document.querySelectorAll('#vizArea .card').forEach(card => {
        card.classList.remove('comparing', 'swapping');
    });
}

function vizLog(message, type = 'info') {
    const console = document.getElementById('vizConsole');
    const line = document.createElement('div');
    line.className = `console-line ${type}`;
    line.textContent = message;
    console.appendChild(line);
    console.scrollTop = console.scrollHeight;
}

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

// CÓDIGO
const codeExamples = {
    bubble: {
        javascript: `<span class="code-comment">// Bubble Sort em JavaScript</span>
<span class="code-keyword">function</span> <span class="code-function">bubbleSort</span>(arr) {
    <span class="code-keyword">const</span> n = arr.length;
    
    <span class="code-keyword">for</span> (<span class="code-keyword">let</span> i = <span class="code-number">0</span>; i &lt; n; i++) {
        <span class="code-keyword">for</span> (<span class="code-keyword">let</span> j = <span class="code-number">0</span>; j &lt; n - <span class="code-number">1</span> - i; j++) {
            <span class="code-comment">// Compara elementos adjacentes</span>
            <span class="code-keyword">if</span> (arr[j] &gt; arr[j + <span class="code-number">1</span>]) {
                <span class="code-comment">// Troca se estiverem fora de ordem</span>
                [arr[j], arr[j + <span class="code-number">1</span>]] = [arr[j + <span class="code-number">1</span>], arr[j]];
            }
        }
    }
    
    <span class="code-keyword">return</span> arr;
}`,
        python: `<span class="code-comment"># Bubble Sort em Python</span>
<span class="code-keyword">def</span> <span class="code-function">bubble_sort</span>(arr):
    n = <span class="code-function">len</span>(arr)
    
    <span class="code-keyword">for</span> i <span class="code-keyword">in</span> <span class="code-function">range</span>(n):
        <span class="code-keyword">for</span> j <span class="code-keyword">in</span> <span class="code-function">range</span>(<span class="code-number">0</span>, n - i - <span class="code-number">1</span>):
            <span class="code-comment"># Compara elementos adjacentes</span>
            <span class="code-keyword">if</span> arr[j] &gt; arr[j + <span class="code-number">1</span>]:
                <span class="code-comment"># Troca se estiverem fora de ordem</span>
                arr[j], arr[j + <span class="code-number">1</span>] = arr[j + <span class="code-number">1</span>], arr[j]
    
    <span class="code-keyword">return</span> arr`,
        java: `<span class="code-comment">// Bubble Sort em Java</span>
<span class="code-keyword">public static void</span> <span class="code-function">bubbleSort</span>(<span class="code-keyword">int</span>[] arr) {
    <span class="code-keyword">int</span> n = arr.length;
    
    <span class="code-keyword">for</span> (<span class="code-keyword">int</span> i = <span class="code-number">0</span>; i &lt; n; i++) {
        <span class="code-keyword">for</span> (<span class="code-keyword">int</span> j = <span class="code-number">0</span>; j &lt; n - <span class="code-number">1</span> - i; j++) {
            <span class="code-comment">// Compara elementos adjacentes</span>
            <span class="code-keyword">if</span> (arr[j] &gt; arr[j + <span class="code-number">1</span>]) {
                <span class="code-comment">// Troca se estiverem fora de ordem</span>
                <span class="code-keyword">int</span> temp = arr[j];
                arr[j] = arr[j + <span class="code-number">1</span>];
                arr[j + <span class="code-number">1</span>] = temp;
            }
        }
    }
}`
    },
    selection: {
        javascript: `<span class="code-comment">// Selection Sort em JavaScript</span>
<span class="code-keyword">function</span> <span class="code-function">selectionSort</span>(arr) {
    <span class="code-keyword">const</span> n = arr.length;
    
    <span class="code-keyword">for</span> (<span class="code-keyword">let</span> i = <span class="code-number">0</span>; i &lt; n - <span class="code-number">1</span>; i++) {
        <span class="code-comment">// Encontra o menor elemento</span>
        <span class="code-keyword">let</span> minIdx = i;
        
        <span class="code-keyword">for</span> (<span class="code-keyword">let</span> j = i + <span class="code-number">1</span>; j &lt; n; j++) {
            <span class="code-keyword">if</span> (arr[j] &lt; arr[minIdx]) {
                minIdx = j;
            }
        }
        
        <span class="code-comment">// Troca com a posição atual</span>
        <span class="code-keyword">if</span> (minIdx !== i) {
            [arr[i], arr[minIdx]] = [arr[minIdx], arr[i]];
        }
    }
    
    <span class="code-keyword">return</span> arr;
}`,
        python: `<span class="code-comment"># Selection Sort em Python</span>
<span class="code-keyword">def</span> <span class="code-function">selection_sort</span>(arr):
    n = <span class="code-function">len</span>(arr)
    
    <span class="code-keyword">for</span> i <span class="code-keyword">in</span> <span class="code-function">range</span>(n - <span class="code-number">1</span>):
        <span class="code-comment"># Encontra o menor elemento</span>
        min_idx = i
        
        <span class="code-keyword">for</span> j <span class="code-keyword">in</span> <span class="code-function">range</span>(i + <span class="code-number">1</span>, n):
            <span class="code-keyword">if</span> arr[j] &lt; arr[min_idx]:
                min_idx = j
        
        <span class="code-comment"># Troca com a posição atual</span>
        arr[i], arr[min_idx] = arr[min_idx], arr[i]
    
    <span class="code-keyword">return</span> arr`,
        java: `<span class="code-comment">// Selection Sort em Java</span>
<span class="code-keyword">public static void</span> <span class="code-function">selectionSort</span>(<span class="code-keyword">int</span>[] arr) {
    <span class="code-keyword">int</span> n = arr.length;
    
    <span class="code-keyword">for</span> (<span class="code-keyword">int</span> i = <span class="code-number">0</span>; i &lt; n - <span class="code-number">1</span>; i++) {
        <span class="code-comment">// Encontra o menor elemento</span>
        <span class="code-keyword">int</span> minIdx = i;
        
        <span class="code-keyword">for</span> (<span class="code-keyword">int</span> j = i + <span class="code-number">1</span>; j &lt; n; j++) {
            <span class="code-keyword">if</span> (arr[j] &lt; arr[minIdx]) {
                minIdx = j;
            }
        }
        
        <span class="code-comment">// Troca com a posição atual</span>
        <span class="code-keyword">int</span> temp = arr[i];
        arr[i] = arr[minIdx];
        arr[minIdx] = temp;
    }
}`
    },
    insertion: {
        javascript: `<span class="code-comment">// Insertion Sort em JavaScript</span>
<span class="code-keyword">function</span> <span class="code-function">insertionSort</span>(arr) {
    <span class="code-keyword">for</span> (<span class="code-keyword">let</span> i = <span class="code-number">1</span>; i &lt; arr.length; i++) {
        <span class="code-keyword">let</span> key = arr[i];
        <span class="code-keyword">let</span> j = i - <span class="code-number">1</span>;
        
        <span class="code-comment">// Move elementos maiores uma posição à frente</span>
        <span class="code-keyword">while</span> (j &gt;= <span class="code-number">0</span> && arr[j] &gt; key) {
            arr[j + <span class="code-number">1</span>] = arr[j];
            j--;
        }
        
        <span class="code-comment">// Insere o elemento na posição correta</span>
        arr[j + <span class="code-number">1</span>] = key;
    }
    
    <span class="code-keyword">return</span> arr;
}`,
        python: `<span class="code-comment"># Insertion Sort em Python</span>
<span class="code-keyword">def</span> <span class="code-function">insertion_sort</span>(arr):
    <span class="code-keyword">for</span> i <span class="code-keyword">in</span> <span class="code-function">range</span>(<span class="code-number">1</span>, <span class="code-function">len</span>(arr)):
        key = arr[i]
        j = i - <span class="code-number">1</span>
        
        <span class="code-comment"># Move elementos maiores uma posição à frente</span>
        <span class="code-keyword">while</span> j &gt;= <span class="code-number">0</span> <span class="code-keyword">and</span> arr[j] &gt; key:
            arr[j + <span class="code-number">1</span>] = arr[j]
            j -= <span class="code-number">1</span>
        
        <span class="code-comment"># Insere o elemento na posição correta</span>
        arr[j + <span class="code-number">1</span>] = key
    
    <span class="code-keyword">return</span> arr`,
        java: `<span class="code-comment">// Insertion Sort em Java</span>
<span class="code-keyword">public static void</span> <span class="code-function">insertionSort</span>(<span class="code-keyword">int</span>[] arr) {
    <span class="code-keyword">for</span> (<span class="code-keyword">int</span> i = <span class="code-number">1</span>; i &lt; arr.length; i++) {
        <span class="code-keyword">int</span> key = arr[i];
        <span class="code-keyword">int</span> j = i - <span class="code-number">1</span>;
        
        <span class="code-comment">// Move elementos maiores uma posição à frente</span>
        <span class="code-keyword">while</span> (j &gt;= <span class="code-number">0</span> && arr[j] &gt; key) {
            arr[j + <span class="code-number">1</span>] = arr[j];
            j--;
        }
        
        <span class="code-comment">// Insere o elemento na posição correta</span>
        arr[j + <span class="code-number">1</span>] = key;
    }
}`
    }
};

function showCode() {
    const algo = document.getElementById('code-algorithm').value;
    const lang = document.getElementById('code-language').value;
    const codeViewer = document.getElementById('codeViewer');
    
    if (codeExamples[algo] && codeExamples[algo][lang]) {
        codeViewer.innerHTML = codeExamples[algo][lang];
    } else {
        codeViewer.innerHTML = '<span class="code-comment">// Código não disponível</span>';
    }
}

function showResultModal(success, score, time, efficiency) {
    const modal = document.getElementById('resultModal');
    const icon = document.getElementById('resultIcon');
    const title = document.getElementById('resultTitle');
    const scoreDisplay = document.getElementById('resultScoreDisplay');
    
    if (success) {
        icon.textContent = '🎉';
        title.textContent = 'Parabéns!';
        scoreDisplay.textContent = `+${score} pontos`;
    } else {
        icon.textContent = '😅';
        title.textContent = 'Quase lá!';
        scoreDisplay.textContent = 'Continue tentando';
    }
    
    document.getElementById('modalMoves').textContent = gameState.moves;
    document.getElementById('modalTime').textContent = time + 's';
    document.getElementById('modalSteps').textContent = `${gameState.correctSteps}/${gameState.expectedSteps.length}`;
    
    modal.classList.add('show');
}

function closeResultModal() {
    document.getElementById('resultModal').classList.remove('show');
}

function createConfetti() {
    const colors = ['#ff6b6b', '#4ecdc4', '#45b7d1', '#f9ca24', '#6c5ce7', '#a29bfe'];
    for (let i = 0; i < 50; i++) {
        setTimeout(() => {
            const confetti = document.createElement('div');
            confetti.style.position = 'fixed';
            confetti.style.left = Math.random() * 100 + '%';
            confetti.style.top = '-10px';
            confetti.style.width = '10px';
            confetti.style.height = '10px';
            confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
            confetti.style.borderRadius = '50%';
            confetti.style.zIndex = '9999';
            confetti.style.pointerEvents = 'none';
            confetti.style.animation = 'confetti-fall 3s linear forwards';
            document.body.appendChild(confetti);
            setTimeout(() => confetti.remove(), 3000);
        }, i * 30);
    }
}

const style = document.createElement('style');
style.textContent = `
    @keyframes confetti-fall {
        to {
            transform: translateY(100vh) rotate(360deg);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);

document.addEventListener('DOMContentLoaded', () => {
    selectAlgorithm();
    startGame();
    showCode();
});
</script>
</body>
</html>