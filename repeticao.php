<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Repetição Interativa - Aprenda com Baralho</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
		background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
		min-height:100vh; padding:20px 0; 
		font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
	}
    
    .main-container { 
        background: #fff;
        border-radius:20px; 
        padding:25px; 
        box-shadow:0 20px 60px rgba(0,0,0,0.3); 
        max-width: 1400px;
        margin: 0 auto;
    }
    
    h1 { 
		font-size:28px; 
		margin-bottom:10px;
		background: linear-gradient(135deg, #ff4757 0%, #e84118 100%);
		-webkit-background-clip: text;
		-webkit-text-fill-color: transparent;
		background-clip: text;
		font-weight: 800;
	}


    .workspace {
        display: grid;
        grid-template-columns: 280px 1fr 320px;
        gap: 20px;
        margin-top: 20px;
    }

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

    .code-block.loop { background: linear-gradient(135deg, #FF6B6B, #FF8E53); }
    .code-block.action { background: linear-gradient(135deg, #A8E6CF, #56CCF2); }

    .build-area {
        background: #f8f9fa;
        border: 3px dashed #dee2e6;
        border-radius: 15px;
        padding: 25px;
        min-height: 500px;
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

    .mini-card {
        display: inline-block;
        width: 40px;
        height: 55px;
        border: 2px solid #2c2c2c;
        border-radius: 5px;
        background: white;
        font-weight: 700;
        text-align: center;
        line-height: 55px;
        margin: 0 5px;
        transition: all 0.2s;
    }

    .mini-card.red { color: #dc3545; }
    .mini-card.black { color: #000; }

    .mini-card.executing {
        animation: cardPulse 0.6s ease;
        box-shadow: 0 0 20px rgba(102, 126, 234, 0.8);
    }

    @keyframes cardPulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.2); }
    }

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
    }

    .execution-line.highlight {
        background: rgba(0, 255, 0, 0.2);
        animation: glow 0.5s ease;
    }

    @keyframes glow {
        0%, 100% { background: rgba(0, 255, 0, 0.2); }
        50% { background: rgba(0, 255, 0, 0.4); }
    }

    .execution-controls {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 15px;
        align-items: center;
    }

    .card-slot {
        display: inline-block;
        min-width: 80px;
        padding: 8px 12px;
        border: 2px dashed #adb5bd;
        border-radius: 8px;
        background: rgba(255,255,255,0.5);
        cursor: pointer;
        transition: all 0.2s;
        font-size: 13px;
    }

    .card-slot:hover {
        border-color: #667eea;
        background: rgba(102, 126, 234, 0.1);
    }

    .card-slot.filled {
        border-style: solid;
        border-color: #28a745;
        background: rgba(40, 167, 69, 0.1);
    }

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

    .btn-run-big {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 15px 30px;
        font-size: 18px;
        font-weight: 700;
        border-radius: 12px;
        cursor: pointer;
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        transition: all 0.3s;
    }

    .btn-run-big:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(102, 126, 234, 0.6);
    }

    .btn-run-big:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .status-badge.idle { background: #e9ecef; color: #495057; }
    .status-badge.running { background: #4CAF50; color: white; animation: pulse 1s infinite; }
    .status-badge.complete { background: #2196F3; color: white; }
    .status-badge.error { background: #f44336; color: white; }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.7; }
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #adb5bd;
    }

    .empty-state-icon {
        font-size: 64px;
        margin-bottom: 20px;
    }

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
            <h1>🎮 Estrutura de Repetição com Baralho</h1>
            <p class="text-muted">Arraste blocos, monte seu código e veja a mágica acontecer!</p>
        </div>

        <div class="workspace">
            <div class="blocks-palette">
                <div class="palette-section">
                    <div class="palette-title">🔁 Estruturas de Repetição</div>
                    <div class="code-block loop" draggable="true" data-type="for">
                        Para i de _ até _
                    </div>
                    <div class="code-block loop" draggable="true" data-type="while">
                        Enquanto _ _ _
                    </div>
                </div>

                <div class="palette-section">
                    <div class="palette-title">🎴 Ações</div>
                    <div class="code-block action" draggable="true" data-type="log">
                        Escrever mensagem
                    </div>
                </div>
            </div>

            <div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">📝 Área de Construção</h5>
                    <button class="btn btn-sm btn-outline-danger" onclick="clearBuildArea()">🗑️ Limpar</button>
                </div>
                
                <div class="build-area" id="buildArea">
                    <div class="empty-state">
                        <div class="empty-state-icon">👈</div>
                        <h5>Arraste blocos aqui</h5>
                        <p>Monte seu algoritmo arrastando blocos da paleta</p>
                    </div>
                </div>

                <div class="execution-controls mt-3">
                    <button class="btn-run-big" onclick="executeProgram()">▶️ Executar</button>
                    <div class="ms-3">
                        <label class="small">Velocidade:</label>
                        <input type="range" id="speedControl" min="200" max="1500" value="600" class="form-range" style="width: 150px;">
                        <span class="small text-muted" id="speedLabel">600ms</span>
                    </div>
                </div>
            </div>

            <div class="visualization-panel">
                <div class="viz-title">📊 Execução ao Vivo</div>
                <div class="status-badge idle" id="statusBadge">Aguardando</div>
                
                <div class="execution-display" id="executionDisplay">
                    <div style="color: #666;">Pronto para executar...</div>
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
    hearts: { symbol:'♥', color:'red' },
    diamonds: { symbol:'♦', color:'red' },
    clubs: { symbol:'♣', color:'black' },
    spades: { symbol:'♠', color:'black' }
};
const values = ['A','2','3','4','5','6','7','8','9','10','J','Q','K'];

function valueToNum(v){
    if (v==='A') return 1;
    if (v==='J') return 11;
    if (v==='Q') return 12;
    if (v==='K') return 13;
    return parseInt(v,10);
}

function label(v){ 
    if (v===1) return 'A';
    if (v===11) return 'J';
    if (v===12) return 'Q';
    if (v===13) return 'K';
    return v.toString();
}

let blockCounter = 0;
let currentSlot = null;
let isExecuting = false;

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
        case 'for':
            content = `
                <strong>🔁 Para i de</strong>
                <span class="card-slot" onclick="openCardPicker('${blockId}-start')">Carta inicial</span>
                <strong>até</strong>
                <span class="card-slot" onclick="openCardPicker('${blockId}-end')">Carta final</span>
                <div class="mt-2 small text-muted">Pinta: 
                    <select class="inline-select" id="${blockId}-suit">
                        <option value="any">Qualquer</option>
                        <option value="hearts">♥ Copas</option>
                        <option value="diamonds">♦ Ouros</option>
                        <option value="clubs">♣ Paus</option>
                        <option value="spades">♠ Espadas</option>
                    </select>
                </div>
            `;
            break;
        case 'while':
            content = `
                <strong>🔄 Enquanto</strong>
                <span class="card-slot" onclick="openCardPicker('${blockId}-var')">Variável</span>
                <select class="inline-select" id="${blockId}-op">
                    <option value="<=">≤</option>
                    <option value="<"><</option>
                    <option value=">=">≥</option>
                    <option value=">">></option>
                </select>
                <span class="card-slot" onclick="openCardPicker('${blockId}-value')">Valor</span>
                <div class="mt-2 small text-muted">Pinta: 
                    <select class="inline-select" id="${blockId}-suit">
                        <option value="any">Qualquer</option>
                        <option value="hearts">♥ Copas</option>
                        <option value="diamonds">♦ Ouros</option>
                        <option value="clubs">♣ Paus</option>
                        <option value="spades">♠ Espadas</option>
                    </select>
                </div>
            `;
            break;
        case 'log':
            content = `<strong>💬 Escrever:</strong> <input type="text" class="inline-select" id="${blockId}-text" placeholder="Mensagem..." style="min-width: 200px;">`;
            break;
    }

    block.innerHTML = `
        ${content}
        <div class="block-controls">
            <button class="btn-delete" onclick="deleteBlock('${blockId}')" title="Excluir">✕</button>
        </div>
    `;
    block.dataset.type = type;
    buildArea.appendChild(block);
}

function deleteBlock(blockId) {
    document.getElementById(blockId).remove();
    if (buildArea.children.length === 0) {
        buildArea.innerHTML = `
            <div class="empty-state">
                <div class="empty-state-icon">👈</div>
                <h5>Arraste blocos aqui</h5>
                <p>Monte seu algoritmo arrastando blocos da paleta</p>
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
                <p>Monte seu algoritmo arrastando blocos da paleta</p>
            </div>
        `;
    }
}

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

document.getElementById('speedControl').addEventListener('input', e => {
    document.getElementById('speedLabel').textContent = e.target.value + 'ms';
});

function wait(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

function log(msg, color = '#00ff00') {
    const display = document.getElementById('executionDisplay');
    const line = document.createElement('div');
    line.className = 'execution-line highlight';
    line.style.color = color;
    line.textContent = msg;
    display.appendChild(line);
    display.scrollTop = display.scrollHeight;
}

async function executeProgram() {
    if (isExecuting) return;
    
    const blocks = Array.from(buildArea.querySelectorAll('.dropped-block'));
    if (blocks.length === 0) {
        alert('Adicione blocos primeiro!');
        return;
    }

    isExecuting = true;
    const display = document.getElementById('executionDisplay');
    const statusBadge = document.getElementById('statusBadge');
    display.innerHTML = '';
    statusBadge.className = 'status-badge running';
    statusBadge.textContent = 'Executando...';

    const speed = parseInt(document.getElementById('speedControl').value);

    try {
        for (let block of blocks) {
            await executeBlock(block, speed);
        }
        statusBadge.className = 'status-badge complete';
        statusBadge.textContent = 'Concluído!';
        log('✅ Execução concluída!', '#2196F3');
    } catch (err) {
        statusBadge.className = 'status-badge error';
        statusBadge.textContent = 'Erro';
        log('❌ Erro: ' + err.message, '#f44336');
    }

    isExecuting = false;
}

async function executeBlock(block, speed) {
    const type = block.dataset.type;
    const blockId = block.id;
    
    switch(type) {
        case 'for':
            await executeFor(blockId, speed);
            break;
        case 'while':
            await executeWhile(blockId, speed);
            break;
        case 'log':
            const textInput = document.getElementById(`${blockId}-text`);
            if (textInput && textInput.value.trim()) {
                log('💬 ' + textInput.value);
                await wait(speed);
            }
            break;
    }
}

async function executeFor(blockId, speed) {
    const startSlot = document.querySelector(`[onclick="openCardPicker('${blockId}-start')"]`);
    const endSlot = document.querySelector(`[onclick="openCardPicker('${blockId}-end')"]`);
    const suitFilter = document.getElementById(`${blockId}-suit`)?.value || 'any';
    
    if (!startSlot?.dataset.vnum || !endSlot?.dataset.vnum) {
        throw new Error('Configure as cartas inicial e final no bloco FOR');
    }
    
    const start = parseInt(startSlot.dataset.vnum);
    const end = parseInt(endSlot.dataset.vnum);
    
    log(`🔁 Iniciando FOR: ${label(start)} até ${label(end)} (${suitFilter})`, '#FF6B6B');
    
    if (start <= end) {
        for (let i = start; i <= end; i++) {
            log(`   i = ${label(i)}`);
            highlightCard(i, suitFilter);
            await wait(speed);
        }
    } else {
        for (let i = start; i >= end; i--) {
            log(`   i = ${label(i)}`);
            highlightCard(i, suitFilter);
            await wait(speed);
        }
    }
}

async function executeWhile(blockId, speed) {
    const varSlot = document.querySelector(`[onclick="openCardPicker('${blockId}-var')"]`);
    const valueSlot = document.querySelector(`[onclick="openCardPicker('${blockId}-value')"]`);
    const op = document.getElementById(`${blockId}-op`)?.value || '<=';
    const suitFilter = document.getElementById(`${blockId}-suit`)?.value || 'any';
    
    if (!varSlot?.dataset.vnum || !valueSlot?.dataset.vnum) {
        throw new Error('Configure as cartas no bloco WHILE');
    }
    
    let i = parseInt(varSlot.dataset.vnum);
    const limit = parseInt(valueSlot.dataset.vnum);
    
    log(`🔄 Iniciando WHILE: i=${label(i)}, condição: i ${op} ${label(limit)} (${suitFilter})`, '#4ECDC4');
    
    let iterations = 0;
    while (checkCondition(i, op, limit) && iterations < 100) {
        log(`   i = ${label(i)}`);
        highlightCard(i, suitFilter);
        await wait(speed);
        i++;
        iterations++;
    }
    
    if (iterations >= 100) {
        log('⚠️ Limite de 100 iterações atingido', '#ffa502');
    }
}

function checkCondition(a, op, b) {
    switch(op) {
        case '<=': return a <= b;
        case '<': return a < b;
        case '>=': return a >= b;
        case '>': return a > b;
        default: return false;
    }
}

function highlightCard(vnum, suitFilter) {
    document.querySelectorAll('.mini-card').forEach(card => {
        const cardText = card.textContent.trim();
        const cardValue = cardText.substring(0, cardText.length - 1);
        const cardVnum = valueToNum(cardValue);
        
        if (cardVnum === vnum) {
            card.classList.add('executing');
            setTimeout(() => card.classList.remove('executing'), 600);
        }
    });
}
</script>
</body>
</html>