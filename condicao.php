<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Condicionais - Estilo Scratch</title>
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

    .workspace {
        display: grid;
        grid-template-columns: 280px 1fr 320px;
        gap: 20px;
        margin-top: 20px;
    }

    /* Paleta de Blocos */
    .blocks-palette {
        background: linear-gradient(to bottom, #f8f9fa, #e9ecef);
        border-radius: 15px;
        padding: 15px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        height: fit-content;
        max-height: 80vh;
        overflow-y: auto;
    }

    .palette-section {
        margin-bottom: 20px;
    }

    .palette-title {
        font-weight: 700;
        font-size: 14px;
        color: #495057;
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Blocos de Código */
    .code-block {
        background: #4CAF50;
        color: white;
        padding: 12px 15px;
        border-radius: 10px;
        margin-bottom: 10px;
        cursor: move;
        font-weight: 600;
        font-size: 14px;
        box-shadow: 0 3px 8px rgba(0,0,0,0.2);
        transition: all 0.2s;
        user-select: none;
    }

    .code-block:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }

    .code-block.if { background: linear-gradient(135deg, #FF6B6B, #FF8E53); }
    .code-block.switch { background: linear-gradient(135deg, #4ECDC4, #44A08D); }
    .code-block.condition { background: linear-gradient(135deg, #A8E6CF, #56CCF2); }
    .code-block.action { background: linear-gradient(135deg, #667eea, #764ba2); }

    /* Área de Construção */
    .build-area {
        background: #f8f9fa;
        border: 3px dashed #dee2e6;
        border-radius: 15px;
        padding: 25px;
        min-height: 500px;
        position: relative;
    }

    .build-area.drag-over {
        background: #e3f2fd;
        border-color: #2196F3;
    }

    .dropped-block {
        background: white;
        border-left: 5px solid #667eea;
        padding: 15px;
        margin-bottom: 15px;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        position: relative;
        animation: dropIn 0.3s ease;
    }

    @keyframes dropIn {
        from { transform: scale(0.8); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }

    .block-controls {
        position: absolute;
        top: 10px;
        right: 10px;
    }

    .btn-delete {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        border: none;
        background: #ff4757;
        color: white;
        cursor: pointer;
        font-size: 14px;
    }

    /* Cards Selecionáveis */
    .card-selector {
        display: inline-block;
        padding: 8px 12px;
        border: 2px dashed #adb5bd;
        border-radius: 8px;
        background: rgba(255,255,255,0.5);
        cursor: pointer;
        transition: all 0.2s;
        font-size: 13px;
        min-width: 80px;
    }

    .card-selector:hover {
        border-color: #667eea;
        background: rgba(102, 126, 234, 0.1);
    }

    .card-selector.filled {
        border-style: solid;
        border-color: #28a745;
        background: rgba(40, 167, 69, 0.1);
    }

    /* Mini Card */
    .mini-card {
        display: inline-flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 55px;
        border: 2px solid #2c2c2c;
        border-radius: 5px;
        background: white;
        font-weight: 700;
        margin: 0 5px;
        transition: all 0.2s;
    }

    .mini-card.red { color: #dc3545; }
    .mini-card.black { color: #000; }

    .mini-card.highlight {
        animation: cardPulse 0.6s ease;
        box-shadow: 0 0 20px rgba(102, 126, 234, 0.8);
    }

    @keyframes cardPulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.2); }
    }

    /* Seletor Inline */
    .inline-select {
        display: inline-block;
        padding: 4px 8px;
        border: 2px solid #667eea;
        border-radius: 5px;
        background: white;
        font-weight: 600;
        cursor: pointer;
        margin: 0 5px;
    }

    /* Painel de Visualização */
    .visualization-panel {
        background: linear-gradient(to bottom, #f8f9fa, #e9ecef);
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        height: fit-content;
        position: sticky;
        top: 20px;
    }

    .viz-title {
        font-weight: 700;
        margin-bottom: 15px;
        color: #495057;
    }

    .execution-display {
        background: #1e1e1e;
        color: #00ff00;
        padding: 15px;
        border-radius: 10px;
        font-family: 'Courier New', monospace;
        font-size: 13px;
        min-height: 200px;
        max-height: 300px;
        overflow-y: auto;
        margin-bottom: 15px;
    }

    .execution-line {
        margin-bottom: 5px;
        padding: 3px 5px;
        border-radius: 3px;
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateX(-10px); }
        to { opacity: 1; transform: translateX(0); }
    }

    .execution-line.success { color: #00ff00; }
    .execution-line.error { color: #ff4444; }
    .execution-line.warning { color: #ffaa00; }
    .execution-line.info { color: #00aaff; }

    /* Controles */
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

    /* Modal de Cartas */
    .card-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.7);
        z-index: 1000;
        justify-content: center;
        align-items: center;
    }

    .card-modal.show {
        display: flex;
    }

    .card-modal-content {
        background: white;
        padding: 30px;
        border-radius: 20px;
        max-width: 600px;
        max-height: 80vh;
        overflow-y: auto;
        box-shadow: 0 20px 60px rgba(0,0,0,0.5);
    }

    .card-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(60px, 1fr));
        gap: 10px;
        margin-top: 20px;
    }

    .card-option {
        width: 60px;
        height: 85px;
        border: 3px solid #2c2c2c;
        border-radius: 8px;
        background: linear-gradient(145deg, #fff, #f5f5f5);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
        font-weight: 700;
        font-size: 20px;
    }

    .card-option:hover {
        transform: scale(1.1);
        box-shadow: 0 8px 20px rgba(0,0,0,0.3);
    }

    .card-option.red { color: #dc3545; }
    .card-option.black { color: #000; }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #adb5bd;
    }

    .empty-state-icon {
        font-size: 64px;
        margin-bottom: 20px;
    }

    /* Case Container para Switch */
    .case-container {
        background: rgba(78, 205, 196, 0.1);
        border-left: 3px solid #4ECDC4;
        padding: 10px;
        margin-top: 10px;
        border-radius: 5px;
    }

    .case-item {
        background: white;
        padding: 8px;
        margin: 5px 0;
        border-radius: 5px;
        border: 1px solid #dee2e6;
    }

    /* Responsivo */
    @media (max-width: 1200px) {
        .workspace {
            grid-template-columns: 1fr;
        }
        
        .visualization-panel {
            position: relative;
            top: 0;
        }
    }
</style>
</head>
<body>
<div class="container-fluid">
    <div class="main-container">
        <div class="text-center mb-3">
            <h1>🎮 Estruturas Condicionais com Baralho</h1>
            <p class="text-muted">Monte condicionais com blocos visuais!</p>
        </div>

        <div class="workspace">
            <!-- Paleta de Blocos -->
            <div class="blocks-palette">
                <div class="palette-section">
                    <div class="palette-title">❓ Condicionais</div>
                    <div class="code-block if" draggable="true" data-type="if">
                        Se _ então
                    </div>
                    <div class="code-block if" draggable="true" data-type="if-else">
                        Se _ então _ senão _
                    </div>
                    <div class="code-block if" draggable="true" data-type="if-elseif-else">
                        Se _ então _ senão se _ então _ senão _
                    </div>
                </div>

                <div class="palette-section">
                    <div class="palette-title">🔀 Switch/Case</div>
                    <div class="code-block switch" draggable="true" data-type="switch">
                        Switch (carta)
                    </div>
                </div>

                <div class="palette-section">
                    <div class="palette-title">✓ Condições</div>
                    <div class="code-block condition" draggable="true" data-type="is-red">
                        É vermelha?
                    </div>
                    <div class="code-block condition" draggable="true" data-type="is-suit">
                        É de pinta _?
                    </div>
                    <div class="code-block condition" draggable="true" data-type="is-value">
                        Valor é _?
                    </div>
                    <div class="code-block condition" draggable="true" data-type="compare-value">
                        Valor _ que _
                    </div>
                </div>

                <div class="palette-section">
                    <div class="palette-title">💬 Ações</div>
                    <div class="code-block action" draggable="true" data-type="show-card">
                        Mostrar carta _
                    </div>
                    <div class="code-block action" draggable="true" data-type="log">
                        Escrever: _____
                    </div>
                </div>
            </div>

            <!-- Área de Construção -->
            <div>
                <div class="controls-panel">
                    <button class="btn-game btn-primary-game" onclick="executeProgram()">▶️ Executar</button>
                    <button class="btn-game btn-danger-game" onclick="clearBuildArea()">🗑️ Limpar</button>
                    <div class="ms-3">
                        <label class="small">Velocidade:</label>
                        <input type="range" id="speedControl" min="200" max="1500" value="600" class="form-range" style="width: 150px;">
                        <span class="small text-muted" id="speedLabel">600ms</span>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">📝 Área de Construção</h5>
                    <div class="badge bg-primary" style="font-size: 14px;">Arraste blocos aqui</div>
                </div>
                
                <div class="build-area" id="buildArea">
                    <div class="empty-state">
                        <div class="empty-state-icon">👈</div>
                        <h5>Arraste blocos aqui</h5>
                        <p>Monte suas estruturas condicionais arrastando blocos</p>
                    </div>
                </div>
            </div>

            <!-- Painel de Visualização -->
            <div class="visualization-panel">
                <div class="viz-title">📊 Execução ao Vivo</div>
                
                <div class="execution-display" id="executionDisplay">
                    <div class="execution-line info">Pronto para executar...</div>
                </div>

                <div class="mt-3">
                    <strong class="small d-block mb-2">Valores das Cartas:</strong>
                    <div class="small text-muted">
                        A=1, 2-10=valor, J=11, Q=12, K=13
                    </div>
                </div>

                <div class="mt-3">
                    <strong class="small d-block mb-2">Pintas:</strong>
                    <div>
                        <span style="color: #dc3545; font-size: 24px;">♥ ♦</span>
                        <span style="color: #000; font-size: 24px;">♣ ♠</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Seleção de Cartas -->
<div class="card-modal" id="cardModal">
    <div class="card-modal-content">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5>Selecione uma Carta</h5>
            <button class="btn-close" onclick="closeCardModal()"></button>
        </div>
        <div class="card-grid" id="cardGrid"></div>
    </div>
</div>

<script>
const suits = {
    hearts: { symbol:'♥', color:'red', name:'Copas' },
    diamonds: { symbol:'♦', color:'red', name:'Ouros' },
    clubs: { symbol:'♣', color:'black', name:'Paus' },
    spades: { symbol:'♠', color:'black', name:'Espadas' }
};

const values = ['A','2','3','4','5','6','7','8','9','10','J','Q','K'];

function valueToNum(v) {
    if (v === 'A') return 1;
    if (v === 'J') return 11;
    if (v === 'Q') return 12;
    if (v === 'K') return 13;
    return parseInt(v, 10);
}

let blockCounter = 0;
let currentSlot = null;
let isExecuting = false;

// Drag and Drop
document.querySelectorAll('.code-block[draggable="true"]').forEach(block => {
    block.addEventListener('dragstart', e => {
        e.dataTransfer.setData('blockType', e.target.dataset.type);
        e.dataTransfer.effectAllowed = 'copy';
    });
});

const buildArea = document.getElementById('buildArea');
buildArea.addEventListener('dragover', e => {
    e.preventDefault();
    buildArea.classList.add('drag-over');
});

buildArea.addEventListener('dragleave', () => {
    buildArea.classList.remove('drag-over');
});

buildArea.addEventListener('drop', e => {
    e.preventDefault();
    buildArea.classList.remove('drag-over');
    const blockType = e.dataTransfer.getData('blockType');
    if (blockType) addBlock(blockType);
});

function addBlock(type) {
    const emptyState = buildArea.querySelector('.empty-state');
    if (emptyState) emptyState.remove();

    const blockId = 'block-' + (++blockCounter);
    const block = document.createElement('div');
    block.className = 'dropped-block';
    block.id = blockId;

    let content = '';
    switch(type) {
        case 'if':
            content = `
                <strong>❓ Se</strong>
                <span class="card-selector" onclick="openCardPicker('${blockId}-card')">Escolher carta</span>
                <select class="inline-select" id="${blockId}-condition">
                    <option value="is-red">é vermelha</option>
                    <option value="is-black">é preta</option>
                    <option value="is-hearts">é de Copas</option>
                    <option value="is-diamonds">é de Ouros</option>
                    <option value="is-clubs">é de Paus</option>
                    <option value="is-spades">é de Espadas</option>
                    <option value="is-face">é figura (J/Q/K)</option>
                    <option value="is-number">é número</option>
                    <option value="gt-7">valor > 7</option>
                    <option value="lte-7">valor ≤ 7</option>
                </select>
                <strong>então</strong>
                <input type="text" class="inline-select" id="${blockId}-action" placeholder="mensagem..." style="min-width: 150px;">
            `;
            break;
        case 'if-else':
            content = `
                <strong>❓ Se</strong>
                <span class="card-selector" onclick="openCardPicker('${blockId}-card')">Escolher carta</span>
                <select class="inline-select" id="${blockId}-condition">
                    <option value="is-red">é vermelha</option>
                    <option value="is-black">é preta</option>
                    <option value="is-hearts">é de Copas</option>
                    <option value="is-diamonds">é de Ouros</option>
                    <option value="is-clubs">é de Paus</option>
                    <option value="is-spades">é de Espadas</option>
                    <option value="is-face">é figura (J/Q/K)</option>
                    <option value="is-number">é número</option>
                    <option value="gt-7">valor > 7</option>
                    <option value="lte-7">valor ≤ 7</option>
                </select>
                <div class="mt-2">
                    <strong>✓ então:</strong>
                    <input type="text" class="inline-select" id="${blockId}-then" placeholder="mensagem se verdadeiro" style="min-width: 200px;">
                </div>
                <div class="mt-2">
                    <strong>✗ senão:</strong>
                    <input type="text" class="inline-select" id="${blockId}-else" placeholder="mensagem se falso" style="min-width: 200px;">
                </div>
            `;
            break;
        case 'if-elseif-else':
            content = `
                <strong>❓ Se</strong>
                <span class="card-selector" onclick="openCardPicker('${blockId}-card1')">Carta 1</span>
                <select class="inline-select" id="${blockId}-cond1">
                    <option value="is-red">é vermelha</option>
                    <option value="is-black">é preta</option>
                    <option value="gt-7">valor > 7</option>
                </select>
                <strong>então:</strong>
                <input type="text" class="inline-select" id="${blockId}-action1" placeholder="msg 1" style="width: 150px;">
                
                <div class="mt-2">
                    <strong>❓ Senão se</strong>
                    <span class="card-selector" onclick="openCardPicker('${blockId}-card2')">Carta 2</span>
                    <select class="inline-select" id="${blockId}-cond2">
                        <option value="is-red">é vermelha</option>
                        <option value="is-black">é preta</option>
                        <option value="gt-7">valor > 7</option>
                    </select>
                    <strong>então:</strong>
                    <input type="text" class="inline-select" id="${blockId}-action2" placeholder="msg 2" style="width: 150px;">
                </div>
                
                <div class="mt-2">
                    <strong>✗ Senão:</strong>
                    <input type="text" class="inline-select" id="${blockId}-else" placeholder="msg padrão" style="width: 150px;">
                </div>
            `;
            break;
        case 'switch':
            content = `
                <strong>🔀 Switch</strong>
                <span class="card-selector" onclick="openCardPicker('${blockId}-card')">Escolher carta</span>
                <div class="mt-2 small text-muted">Casos (clique para adicionar):</div>
                <div id="${blockId}-cases" class="case-container"></div>
                <button class="btn btn-sm btn-outline-primary mt-2" onclick="addCase('${blockId}')">+ Adicionar Caso</button>
            `;
            break;
        case 'show-card':
            content = `<strong>👁️ Mostrar carta</strong> <span class="card-selector" onclick="openCardPicker('${blockId}-card')">Escolher carta</span>`;
            break;
        case 'log':
            content = `<strong>💬 Escrever:</strong> <input type="text" class="inline-select" id="${blockId}-text" placeholder="Mensagem..." style="min-width: 200px;">`;
            break;
    }

    block.innerHTML = `
        ${content}
        <div class="block-controls">
            <button class="btn-delete" onclick="deleteBlock('${blockId}')">✕</button>
        </div>
    `;
    block.dataset.type = type;
    buildArea.appendChild(block);
}

function addCase(blockId) {
    const casesContainer = document.getElementById(`${blockId}-cases`);
    const caseId = `${blockId}-case-${Date.now()}`;
    
    const caseItem = document.createElement('div');
    caseItem.className = 'case-item';
    caseItem.id = caseId;
    caseItem.innerHTML = `
        <strong>Case</strong>
        <select class="inline-select" id="${caseId}-type">
            <option value="suit-hearts">Copas ♥</option>
            <option value="suit-diamonds">Ouros ♦</option>
            <option value="suit-clubs">Paus ♣</option>
            <option value="suit-spades">Espadas ♠</option>
            <option value="color-red">Vermelha</option>
            <option value="color-black">Preta</option>
            <option value="face">Figura (J/Q/K)</option>
            <option value="number">Número</option>
        </select>
        <strong>→</strong>
        <input type="text" class="inline-select" id="${caseId}-action" placeholder="ação" style="width: 120px;">
        <button class="btn btn-sm btn-danger" onclick="document.getElementById('${caseId}').remove()" style="padding: 2px 8px; font-size: 12px;">✕</button>
    `;
    
    casesContainer.appendChild(caseItem);
}

function deleteBlock(blockId) {
    document.getElementById(blockId).remove();
    if (buildArea.children.length === 0) {
        buildArea.innerHTML = `
            <div class="empty-state">
                <div class="empty-state-icon">👈</div>
                <h5>Arraste blocos aqui</h5>
                <p>Monte suas estruturas condicionais</p>
            </div>
        `;
    }
}

function clearBuildArea() {
    if (confirm('Deseja limpar todos os blocos?')) {
        buildArea.innerHTML = `
            <div class="empty-state">
                <div class="empty-state-icon">👈</div>
                <h5>Arraste blocos aqui</h5>
                <p>Monte suas estruturas condicionais</p>
            </div>
        `;
    }
}

// Modal de cartas
function openCardPicker(slotId) {
    currentSlot = slotId;
    const modal = document.getElementById('cardModal');
    const grid = document.getElementById('cardGrid');
    grid.innerHTML = '';

    for (let suitKey in suits) {
        for (let v of values) {
            const card = document.createElement('div');
            card.className = 'card-option ' + suits[suitKey].color;
            card.innerHTML = `<div>${v}</div><div style="font-size:20px">${suits[suitKey].symbol}</div>`;
            card.onclick = () => selectCard(v, suitKey);
            grid.appendChild(card);
        }
    }

    modal.classList.add('show');
}

function selectCard(value, suit) {
    const slot = document.querySelector(`[onclick="openCardPicker('${currentSlot}')"]`);
    if (slot) {
        slot.innerHTML = `<span class="mini-card ${suits[suit].color}">${value}${suits[suit].symbol}</span>`;
        slot.classList.add('filled');
        slot.dataset.value = value;
        slot.dataset.vnum = valueToNum(value);
        slot.dataset.suit = suit;
    }
    closeCardModal();
}

function closeCardModal() {
    document.getElementById('cardModal').classList.remove('show');
    currentSlot = null;
}

// Controle de velocidade
document.getElementById('speedControl').addEventListener('input', e => {
    document.getElementById('speedLabel').textContent = e.target.value + 'ms';
});

// Execução
async function executeProgram() {
    if (isExecuting) return;
    
    const blocks = Array.from(buildArea.querySelectorAll('.dropped-block'));
    if (blocks.length === 0) {
        alert('Adicione blocos primeiro!');
        return;
    }

    isExecuting = true;
    const display = document.getElementById('executionDisplay');
    display.innerHTML = '';
    log('▶️ Iniciando execução...', 'info');

    const speed = parseInt(document.getElementById('speedControl').value);

    try {
        for (let block of blocks) {
            await executeBlock(block, speed);
        }
        log('✅ Execução concluída!', 'success');
    } catch (err) {
        log('❌ Erro: ' + err.message, 'error');
    }

    isExecuting = false;
}

async function executeBlock(block, speed) {
    const type = block.dataset.type;
    const blockId = block.id;
    
    switch(type) {
        case 'if':
            await executeIf(blockId, speed);
            break;
        case 'if-else':
            await executeIfElse(blockId, speed);
            break;
        case 'if-elseif-else':
            await executeIfElseIfElse(blockId, speed);
            break;
        case 'switch':
            await executeSwitch(blockId, speed);
            break;
        case 'show-card':
            await executeShowCard(blockId, speed);
            break;
        case 'log':
            await executeLog(blockId, speed);
            break;
    }
}

async function executeIf(blockId, speed) {
    const cardSlot = document.querySelector(`[onclick="openCardPicker('${blockId}-card')"]`);
    const condition = document.getElementById(`${blockId}-condition`)?.value;
    const action = document.getElementById(`${blockId}-action`)?.value;
    
    if (!cardSlot?.dataset.value) {
        log('❌ Selecione uma carta no bloco IF', 'error');
        return;
    }
    
    const card = {
        value: cardSlot.dataset.value,
        vnum: parseInt(cardSlot.dataset.vnum),
        suit: cardSlot.dataset.suit
    };
    
    log(`📋 IF: Testando carta ${card.value}${suits[card.suit].symbol}...`, 'info');
    await wait(speed / 2);
    
    const result = evaluateCondition(card, condition);
    
    if (result) {
        log(`✓ Condição VERDADEIRA!`, 'success');
        highlightCard(cardSlot);
        if (action) {
            await wait(speed / 2);
            log(`💬 ${action}`, 'success');
        }
    } else {
        log(`✗ Condição FALSA`, 'warning');
    }
    
    await wait(speed);
}

async function executeIfElse(blockId, speed) {
    const cardSlot = document.querySelector(`[onclick="openCardPicker('${blockId}-card')"]`);
    const condition = document.getElementById(`${blockId}-condition`)?.value;
    const thenAction = document.getElementById(`${blockId}-then`)?.value;
    const elseAction = document.getElementById(`${blockId}-else`)?.value;
    
    if (!cardSlot?.dataset.value) {
        log('❌ Selecione uma carta no bloco IF-ELSE', 'error');
        return;
    }
    
    const card = {
        value: cardSlot.dataset.value,
        vnum: parseInt(cardSlot.dataset.vnum),
        suit: cardSlot.dataset.suit
    };
    
    log(`📋 IF-ELSE: Testando carta ${card.value}${suits[card.suit].symbol}...`, 'info');
    await wait(speed / 2);
    
    const result = evaluateCondition(card, condition);
    
    if (result) {
        log(`✓ Condição VERDADEIRA! Executando THEN...`, 'success');
        highlightCard(cardSlot);
        if (thenAction) {
            await wait(speed / 2);
            log(`💬 THEN: ${thenAction}`, 'success');
        }
    } else {
        log(`✗ Condição FALSA! Executando ELSE...`, 'warning');
        if (elseAction) {
            await wait(speed / 2);
            log(`💬 ELSE: ${elseAction}`, 'warning');
        }
    }
    
    await wait(speed);
}

async function executeIfElseIfElse(blockId, speed) {
    const card1Slot = document.querySelector(`[onclick="openCardPicker('${blockId}-card1')"]`);
    const card2Slot = document.querySelector(`[onclick="openCardPicker('${blockId}-card2')"]`);
    const cond1 = document.getElementById(`${blockId}-cond1`)?.value;
    const cond2 = document.getElementById(`${blockId}-cond2`)?.value;
    const action1 = document.getElementById(`${blockId}-action1`)?.value;
    const action2 = document.getElementById(`${blockId}-action2`)?.value;
    const elseAction = document.getElementById(`${blockId}-else`)?.value;
    
    if (!card1Slot?.dataset.value || !card2Slot?.dataset.value) {
        log('❌ Selecione ambas as cartas no bloco IF-ELSEIF-ELSE', 'error');
        return;
    }
    
    const card1 = {
        value: card1Slot.dataset.value,
        vnum: parseInt(card1Slot.dataset.vnum),
        suit: card1Slot.dataset.suit
    };
    
    const card2 = {
        value: card2Slot.dataset.value,
        vnum: parseInt(card2Slot.dataset.vnum),
        suit: card2Slot.dataset.suit
    };
    
    log(`📋 IF-ELSEIF-ELSE: Testando condições...`, 'info');
    await wait(speed / 2);
    
    // Testa primeira condição
    log(`  Testando IF com ${card1.value}${suits[card1.suit].symbol}...`, 'info');
    const result1 = evaluateCondition(card1, cond1);
    
    if (result1) {
        log(`✓ Primeira condição VERDADEIRA!`, 'success');
        highlightCard(card1Slot);
        if (action1) {
            await wait(speed / 2);
            log(`💬 ${action1}`, 'success');
        }
    } else {
        log(`✗ Primeira condição FALSA, testando ELSEIF...`, 'warning');
        await wait(speed / 2);
        
        // Testa segunda condição
        log(`  Testando ELSEIF com ${card2.value}${suits[card2.suit].symbol}...`, 'info');
        const result2 = evaluateCondition(card2, cond2);
        
        if (result2) {
            log(`✓ Segunda condição VERDADEIRA!`, 'success');
            highlightCard(card2Slot);
            if (action2) {
                await wait(speed / 2);
                log(`💬 ${action2}`, 'success');
            }
        } else {
            log(`✗ Segunda condição também FALSA, executando ELSE...`, 'warning');
            if (elseAction) {
                await wait(speed / 2);
                log(`💬 ELSE: ${elseAction}`, 'warning');
            }
        }
    }
    
    await wait(speed);
}

async function executeSwitch(blockId, speed) {
    const cardSlot = document.querySelector(`[onclick="openCardPicker('${blockId}-card')"]`);
    
    if (!cardSlot?.dataset.value) {
        log('❌ Selecione uma carta no bloco SWITCH', 'error');
        return;
    }
    
    const card = {
        value: cardSlot.dataset.value,
        vnum: parseInt(cardSlot.dataset.vnum),
        suit: cardSlot.dataset.suit
    };
    
    log(`🔀 SWITCH: Avaliando carta ${card.value}${suits[card.suit].symbol}...`, 'info');
    await wait(speed / 2);
    
    const casesContainer = document.getElementById(`${blockId}-cases`);
    const cases = casesContainer.querySelectorAll('.case-item');
    
    if (cases.length === 0) {
        log('⚠️ Nenhum caso definido no SWITCH', 'warning');
        return;
    }
    
    let matched = false;
    
    for (let i = 0; i < cases.length && !matched; i++) {
        const caseEl = cases[i];
        const caseType = caseEl.querySelector('select')?.value;
        const caseAction = caseEl.querySelector('input')?.value;
        
        log(`  Testando CASE ${i + 1}: ${caseType}...`, 'info');
        await wait(speed / 3);
        
        let caseMatch = false;
        
        switch(caseType) {
            case 'suit-hearts': caseMatch = card.suit === 'hearts'; break;
            case 'suit-diamonds': caseMatch = card.suit === 'diamonds'; break;
            case 'suit-clubs': caseMatch = card.suit === 'clubs'; break;
            case 'suit-spades': caseMatch = card.suit === 'spades'; break;
            case 'color-red': caseMatch = suits[card.suit].color === 'red'; break;
            case 'color-black': caseMatch = suits[card.suit].color === 'black'; break;
            case 'face': caseMatch = ['J','Q','K'].includes(card.value); break;
            case 'number': caseMatch = !['A','J','Q','K'].includes(card.value); break;
        }
        
        if (caseMatch) {
            log(`✓ MATCH encontrado no CASE ${i + 1}!`, 'success');
            highlightCard(cardSlot);
            if (caseAction) {
                await wait(speed / 2);
                log(`💬 ${caseAction}`, 'success');
            }
            matched = true;
        } else {
            log(`  ✗ Não corresponde`, 'info');
        }
    }
    
    if (!matched) {
        log(`⚠️ Nenhum CASE correspondeu (DEFAULT)`, 'warning');
    }
    
    await wait(speed);
}

async function executeShowCard(blockId, speed) {
    const cardSlot = document.querySelector(`[onclick="openCardPicker('${blockId}-card')"]`);
    
    if (!cardSlot?.dataset.value) {
        log('❌ Selecione uma carta para mostrar', 'error');
        return;
    }
    
    const card = {
        value: cardSlot.dataset.value,
        suit: cardSlot.dataset.suit
    };
    
    log(`👁️ Mostrando carta: ${card.value}${suits[card.suit].symbol}`, 'success');
    highlightCard(cardSlot);
    await wait(speed);
}

async function executeLog(blockId, speed) {
    const text = document.getElementById(`${blockId}-text`)?.value;
    
    if (!text) {
        log('⚠️ Mensagem vazia', 'warning');
        return;
    }
    
    log(`💬 ${text}`, 'info');
    await wait(speed);
}

function evaluateCondition(card, condition) {
    switch(condition) {
        case 'is-red': return suits[card.suit].color === 'red';
        case 'is-black': return suits[card.suit].color === 'black';
        case 'is-hearts': return card.suit === 'hearts';
        case 'is-diamonds': return card.suit === 'diamonds';
        case 'is-clubs': return card.suit === 'clubs';
        case 'is-spades': return card.suit === 'spades';
        case 'is-face': return ['J','Q','K'].includes(card.value);
        case 'is-number': return !['A','J','Q','K'].includes(card.value);
        case 'gt-7': return card.vnum > 7;
        case 'lte-7': return card.vnum <= 7;
        default: return false;
    }
}

function highlightCard(cardElement) {
    const miniCard = cardElement.querySelector('.mini-card');
    if (miniCard) {
        miniCard.classList.add('highlight');
        setTimeout(() => miniCard.classList.remove('highlight'), 600);
    }
}

function wait(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

function log(message, type = 'info') {
    const display = document.getElementById('executionDisplay');
    const line = document.createElement('div');
    line.className = `execution-line ${type}`;
    const timestamp = new Date().toLocaleTimeString('pt-BR', { 
        hour: '2-digit', 
        minute: '2-digit', 
        second: '2-digit' 
    });
    line.textContent = `[${timestamp}] ${message}`;
    display.appendChild(line);
    display.scrollTop = display.scrollHeight;
}

document.addEventListener('DOMContentLoaded', () => {
    log('🎮 Sistema iniciado. Arraste blocos para começar!', 'success');
});
</script>
</body>
</html>