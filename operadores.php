<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operadores - Aprenda com Baralho</title>
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
            padding: 25px 30px;
            box-shadow: 0 25px 80px rgba(0,0,0,0.4);
            max-width: 1400px;
            margin: 0 auto;
        }

        h1 {
            font-size: 32px;
            font-weight: 800;
            background: linear-gradient(135deg, #ff4757 0%, #e84118 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 4px;
            text-align: center;
        }

        /* ── LAYOUT PRINCIPAL: topo compacto + baralho ── */
        .top-panel {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 16px;
            align-items: start;
        }

        /* coluna esquerda */
        .left-col { display: flex; flex-direction: column; gap: 12px; }

        /* Challenge */
        .challenge-box {
            background: linear-gradient(135deg, #ff4757, #e84118);
            color: white;
            padding: 18px 20px;
            border-radius: 14px;
            text-align: center;
            box-shadow: 0 6px 20px rgba(255,71,87,0.35);
            animation: fadeIn 0.4s ease;
        }

        .challenge-label { font-size: 13px; font-weight: 600; opacity: 0.85; margin-bottom: 4px; }
        .challenge-text  { font-size: 28px; font-weight: 800; line-height: 1.2; }

        @keyframes fadeIn {
            from { opacity:0; transform: translateY(-12px); }
            to   { opacity:1; transform: translateY(0); }
        }

        /* Modos */
        .mode-selector {
            display: flex;
            gap: 8px;
        }

        .mode-btn {
            flex: 1;
            padding: 10px 14px;
            border: 3px solid #ff4757;
            border-radius: 10px;
            background: white;
            color: #ff4757;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.25s;
            font-size: 14px;
            text-align: center;
        }

        .mode-btn.active {
            background: linear-gradient(135deg, #ff4757, #e84118);
            color: white;
            border-color: transparent;
            box-shadow: 0 5px 15px rgba(255,71,87,0.35);
            transform: translateY(-2px);
        }

        .mode-btn:hover:not(.active) {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(255,71,87,0.15);
        }

        /* Botões de controle */
        .controls-row {
            display: flex;
            gap: 8px;
        }

        .btn-game {
            flex: 1;
            padding: 10px 8px;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.25s;
            box-shadow: 0 3px 10px rgba(0,0,0,0.12);
            text-align: center;
        }

        .btn-game:hover { transform: translateY(-2px); box-shadow: 0 6px 16px rgba(0,0,0,0.2); }
        .btn-info-game    { background: linear-gradient(135deg, #4facfe, #00f2fe); color: white; }
        .btn-warning-game { background: linear-gradient(135deg, #f09819, #ff512f); color: white; }
        .btn-primary-game { background: linear-gradient(135deg, #ff4757, #e84118); color: white; }
        .btn-success-game { background: linear-gradient(135deg, #56ab2f, #a8e063); color: white; }

        /* Tip */
        .tip-box {
            background: linear-gradient(135deg, #ffeaa7, #fdcb6e);
            padding: 10px 14px;
            border-radius: 10px;
            border-left: 5px solid #f39c12;
            font-size: 13px;
            display: none;
            animation: slideDown 0.25s ease;
        }

        @keyframes slideDown {
            from { opacity:0; transform:translateY(-8px); }
            to   { opacity:1; transform:translateY(0); }
        }

        .tip-box strong { display:block; margin-bottom:3px; color:#d35400; font-size:14px; }

        /* coluna direita */
        .right-col { display: flex; flex-direction: column; gap: 12px; }

        /* Answer Zone */
        .answer-zone {
            flex: 1;
            min-height: 160px;
            border: 3px dashed #dee2e6;
            border-radius: 14px;
            padding: 14px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
            justify-content: center;
            background: linear-gradient(to bottom, #f8f9fa, #e9ecef);
            transition: all 0.25s;
        }

        .answer-zone.drag-over {
            border-color: #ff4757;
            background: rgba(255,71,87,0.06);
            transform: scale(1.01);
            box-shadow: 0 0 20px rgba(255,71,87,0.2);
        }

        .answer-zone-label {
            font-size: 16px;
            color: #adb5bd;
            font-weight: 600;
            width: 100%;
            text-align: center;
        }

        /* Verificar + feedback inline */
        .verify-row {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .btn-verify {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.25s;
            background: linear-gradient(135deg, #56ab2f, #a8e063);
            color: white;
            box-shadow: 0 4px 14px rgba(86,171,47,0.35);
        }

        .btn-verify:hover { transform: translateY(-2px); box-shadow: 0 7px 20px rgba(86,171,47,0.45); }

        .feedback-inline {
            font-size: 15px;
            font-weight: 700;
            white-space: nowrap;
            min-width: 160px;
            text-align: center;
        }

        .feedback-inline.correct { color: #28a745; }
        .feedback-inline.wrong   { color: #dc3545; }
        .feedback-inline.warning { color: #e67e22; }

        /* Progresso */
        .progress-bar-wrap {
            background: #e9ecef;
            height: 20px;
            border-radius: 12px;
            overflow: hidden;
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

        .progress-meta {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            font-weight: 600;
            color: #666;
            margin-bottom: 4px;
        }

        /* Stats */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(4,1fr);
            gap: 10px;
            margin-bottom: 14px;
        }

        .stat-box {
            text-align: center;
            padding: 10px 8px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.07);
            transition: transform 0.25s;
        }

        .stat-box:hover { transform: translateY(-4px); }

        .stat-value {
            font-size: 26px;
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
            letter-spacing: 0.4px;
            margin-top: 3px;
        }

        /* ── BARALHO ── */
        .deck-section { margin-top: 8px; }

        .suit-filter {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin: 10px 0 14px;
        }

        .suit-filter-btn {
            width: 52px;
            height: 52px;
            border-radius: 10px;
            border: 3px solid #dee2e6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            cursor: pointer;
            background: white;
            transition: all 0.25s;
            box-shadow: 0 3px 8px rgba(0,0,0,0.08);
        }

        .suit-filter-btn:hover    { transform: translateY(-4px); box-shadow: 0 7px 18px rgba(0,0,0,0.15); }
        .suit-filter-btn.active   { border-color: #ff4757; box-shadow: 0 6px 16px rgba(255,71,87,0.25); transform: translateY(-2px); }

        .suit-group {
            background: white;
            border-radius: 14px;
            padding: 16px;
            margin-bottom: 14px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.07);
        }

        .suit-group.d-none { display: none; }

        .suit-header {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 2px solid #f8f9fa;
        }

        .suit-icon { font-size: 30px; margin-right: 12px; }
        .suit-name { font-size: 18px; font-weight: 700; color: #495057; }

        .cards-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }

        /* Cards */
        .card {
            width: 72px;
            height: 104px;
            border: 3px solid #2c2c2c;
            border-radius: 9px;
            background: linear-gradient(145deg, #fff, #f5f5f5);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 24px;
            cursor: grab;
            user-select: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            transition: all 0.25s cubic-bezier(0.4,0,0.2,1);
        }

        .card:hover    { transform: translateY(-9px) scale(1.05); box-shadow: 0 13px 28px rgba(0,0,0,0.25); }
        .card.dragging { opacity:0.5; transform:rotate(7deg) scale(0.96); cursor:grabbing; }
        .card.red      { color: #dc3545; }
        .card.black    { color: #000; }

        .card.correct {
            animation: correctPulse 0.6s ease;
            border-color: #28a745;
            box-shadow: 0 0 26px rgba(40,167,69,0.55);
        }

        .card.wrong {
            animation: wrongShake 0.5s ease;
            border-color: #dc3545;
            box-shadow: 0 0 26px rgba(220,53,69,0.55);
        }

        @keyframes correctPulse {
            0%,100% { transform:scale(1); }
            50%      { transform:scale(1.13); }
        }

        @keyframes wrongShake {
            0%,100% { transform:translateX(0); }
            25%     { transform:translateX(-9px); }
            75%     { transform:translateX(9px); }
        }

        .card-value  { font-size: 28px; line-height: 1; }
        .card-symbol { font-size: 22px; margin-top: 4px; }

        @media (max-width: 900px) {
            .top-panel { grid-template-columns: 1fr; }
            .stats-row { grid-template-columns: repeat(2,1fr); }
        }

        @media (max-width: 540px) {
            h1 { font-size: 24px; }
            .challenge-text { font-size: 20px; }
            .card { width: 60px; height: 88px; font-size: 20px; }
        }
    </style>
</head>
<body>
<div class="container-fluid" style="max-width:1460px;margin:0 auto;padding:0 15px;">
<div class="main-container">

    <h1>🧠 Operadores Lógicos e Aritméticos</h1>
    <p class="text-center text-muted mb-3" style="font-size:14px;">Resolva desafios usando operadores com cartas!</p>

    <!-- Stats compactas -->
    <div class="stats-row">
        <div class="stat-box">
            <div class="stat-value" id="stat-correct">0</div>
            <div class="stat-label">✅ Acertos</div>
        </div>
        <div class="stat-box">
            <div class="stat-value" id="stat-wrong">0</div>
            <div class="stat-label">❌ Erros</div>
        </div>
        <div class="stat-box">
            <div class="stat-value" id="stat-current">1</div>
            <div class="stat-label">📍 Atual</div>
        </div>
        <div class="stat-box">
            <div class="stat-value" id="stat-difficulty">Fácil</div>
            <div class="stat-label">🎯 Dificuldade</div>
        </div>
    </div>

    <!-- Painel principal: esquerda + direita -->
    <div class="top-panel">

        <!-- COLUNA ESQUERDA: desafio + modos + controles + dica -->
        <div class="left-col">

            <div class="challenge-box" id="challenge-box">
                <div class="challenge-label">Desafio:</div>
                <div class="challenge-text" id="challenge-text">Carregando...</div>
            </div>

            <div class="mode-selector">
                <div class="mode-btn active" id="mode-drag" onclick="setMode('drag')">🖱️ Modo Arrastar</div>
                <div class="mode-btn" id="mode-click" onclick="setMode('click')">👆 Modo Clique</div>
            </div>

            <div class="controls-row">
                <button class="btn-game btn-info-game"    onclick="mostrarDica()">💡 Ver Dica</button>
                <button class="btn-game btn-warning-game" onclick="pularDesafio()">⏭️ Pular</button>
                <button class="btn-game btn-primary-game" onclick="limparZona()">🔄 Limpar</button>
            </div>

            <div class="tip-box" id="tip-box"></div>

            <!-- Progresso -->
            <div>
                <div class="progress-meta">
                    <span id="progress-text">Desafio 1 de 45</span>
                    <span id="difficulty-text">Nível: Fácil</span>
                </div>
                <div class="progress-bar-wrap">
                    <div class="progress-bar-fill" id="progress-bar" style="width:0%">0%</div>
                </div>
            </div>
        </div>

        <!-- COLUNA DIREITA: zona de resposta + verificar + feedback -->
        <div class="right-col">

            <div class="answer-zone" id="answer-zone">
                <div class="answer-zone-label">🎯 Arraste ou clique nas cartas que atendem a condição</div>
            </div>

            <div class="verify-row">
                <button class="btn-verify" onclick="verificarResposta()">✔️ Verificar Resposta</button>
                <div class="feedback-inline" id="feedback"></div>
            </div>

        </div>
    </div>

    <!-- ── BARALHO ── -->
    <div class="deck-section">
        <div class="suit-filter">
            <div class="suit-filter-btn active" data-suit="hearts"   onclick="toggleSuit('hearts')"   title="Copas"><span style="color:#dc3545;">♥</span></div>
            <div class="suit-filter-btn active" data-suit="diamonds" onclick="toggleSuit('diamonds')" title="Ouros"><span style="color:#dc3545;">♦</span></div>
            <div class="suit-filter-btn active" data-suit="clubs"    onclick="toggleSuit('clubs')"    title="Paus"><span style="color:#000;">♣</span></div>
            <div class="suit-filter-btn active" data-suit="spades"   onclick="toggleSuit('spades')"   title="Espadas"><span style="color:#000;">♠</span></div>
        </div>

        <div id="suit-hearts" class="suit-group">
            <div class="suit-header">
                <div class="suit-icon" style="color:#dc3545;">♥</div>
                <div class="suit-name">Copas</div>
            </div>
            <div class="cards-row" id="hearts-cards"></div>
        </div>

        <div id="suit-diamonds" class="suit-group">
            <div class="suit-header">
                <div class="suit-icon" style="color:#dc3545;">♦</div>
                <div class="suit-name">Ouros</div>
            </div>
            <div class="cards-row" id="diamonds-cards"></div>
        </div>

        <div id="suit-clubs" class="suit-group">
            <div class="suit-header">
                <div class="suit-icon" style="color:#000;">♣</div>
                <div class="suit-name">Paus</div>
            </div>
            <div class="cards-row" id="clubs-cards"></div>
        </div>

        <div id="suit-spades" class="suit-group">
            <div class="suit-header">
                <div class="suit-icon" style="color:#000;">♠</div>
                <div class="suit-name">Espadas</div>
            </div>
            <div class="cards-row" id="spades-cards"></div>
        </div>
    </div>

</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
const suits = {
    hearts:   { symbol: '♥', color: 'red',   name: 'copas'    },
    diamonds: { symbol: '♦', color: 'red',   name: 'ouros'    },
    clubs:    { symbol: '♣', color: 'black', name: 'paus'     },
    spades:   { symbol: '♠', color: 'black', name: 'espadas'  }
};
const values = ['A','2','3','4','5','6','7','8','9','10','J','Q','K'];

const desafios = [
    { cond: "vermelho E valor > 5", tipo:"Fácil", dica:"Vermelho = ♥ ou ♦; valores: A=1, J=11, Q=12, K=13", check: (v,s,c) => c==='red' && v>5 },
    { cond: "preto E valor < 4", tipo:"Fácil", dica:"Preto = ♣ ou ♠; valores menores que 4", check: (v,s,c) => c==='black' && v<4 },
    { cond: "valor + 3 = 10", tipo:"Fácil", dica:"Quais cartas somadas com 3 resultam em 10? (7+3=10)", check: (v,s,c) => v+3===10 },
    { cond: "ouros E valor % 2 = 0", tipo:"Fácil", dica:"% indica resto da divisão. Cartas pares de Ouros", check: (v,s,c) => s==='diamonds' && v%2===0 },
    { cond: "valor - 2 = 8", tipo:"Fácil", dica:"Quais cartas menos 2 resultam em 8? (10-2=8)", check: (v,s,c) => v-2===8 },
    { cond: "espadas E valor <= 3", tipo:"Fácil", dica:"Cartas de Espadas menores ou iguais a 3", check: (v,s,c) => s==='spades' && v<=3 },
    { cond: "valor * 2 <= 10", tipo:"Fácil", dica:"Cartas que multiplicadas por 2 são <= 10", check: (v,s,c) => v*2<=10 },
    { cond: "valor > 8", tipo:"Fácil", dica:"Qualquer carta maior que 8", check: (v,s,c) => v>8 },
    { cond: "copas E (valor + 5) >= 15", tipo:"Fácil", dica:"Copas que somadas com 5 são >= 15", check: (v,s,c) => s==='hearts' && (v+5)>=15 },
    { cond: "valor / 2 = 5", tipo:"Fácil", dica:"Cartas que divididas por 2 resultam em 5 (10/2=5)", check: (v,s,c) => v/2===5 },
    { cond: "ouros OU paus", tipo:"Fácil", dica:"Cartas de Ouros ou Paus", check: (v,s,c) => s==='diamonds'||s==='clubs' },
    { cond: "copas E valor <= 10", tipo:"Fácil", dica:"Cartas de Copas até 10", check: (v,s,c) => s==='hearts' && v<=10 },
    { cond: "vermelho E par", tipo:"Fácil", dica:"Cartas vermelhas com valores pares", check: (v,s,c) => c==='red' && v%2===0 },
    { cond: "preto E ímpar", tipo:"Fácil", dica:"Cartas pretas com valores ímpares", check: (v,s,c) => c==='black' && v%2===1 },
    { cond: "valor = 11 OU valor = 12", tipo:"Fácil", dica:"Todos os Valetes (J) e Damas (Q)", check: (v,s,c) => v===11||v===12 },
    { cond: "(valor + 4) > 10 E vermelho", tipo:"Médio", dica:"Cartas vermelhas que somadas com 4 dão mais que 10", check: (v,s,c) => (v+4)>10 && c==='red' },
    { cond: "(copas OU ouros) E valor >= 9", tipo:"Médio", dica:"Cartas vermelhas >= 9", check: (v,s,c) => (s==='hearts'||s==='diamonds') && v>=9 },
    { cond: "paus E (valor - 3) < 5", tipo:"Médio", dica:"Paus que subtraindo 3 resultam em menos de 5", check: (v,s,c) => s==='clubs' && (v-3)<5 },
    { cond: "espadas E valor > 4 E valor < 10", tipo:"Médio", dica:"Espadas entre 5 e 9", check: (v,s,c) => s==='spades' && v>4 && v<10 },
    { cond: "valor * 3 >= 20", tipo:"Médio", dica:"Cartas que multiplicadas por 3 são >= 20", check: (v,s,c) => v*3>=20 },
    { cond: "(vermelho E par) OU valor = 13", tipo:"Médio", dica:"Vermelhas pares OU Reis (K)", check: (v,s,c) => (c==='red'&&v%2===0)||v===13 },
    { cond: "ouros E (valor * 2) <= 12", tipo:"Médio", dica:"Ouros que o dobro do valor é <= 12", check: (v,s,c) => s==='diamonds' && (v*2)<=12 },
    { cond: "valor <= 9 E (paus OU espadas)", tipo:"Médio", dica:"Cartas pretas até 9", check: (v,s,c) => v<=9 && (s==='clubs'||s==='spades') },
    { cond: "valor primo", tipo:"Médio", dica:"Primos: 2, 3, 5, 7, 11(J), 13(K)", check: (v,s,c) => isPrime(v) },
    { cond: "copas E (valor - 1) % 3 = 0", tipo:"Médio", dica:"Copas onde (valor-1) é múltiplo de 3", check: (v,s,c) => s==='hearts' && (v-1)%3===0 },
    { cond: "(valor > 4 E valor < 9) OU valor = 12", tipo:"Médio", dica:"Entre 5 e 8 OU Damas (Q)", check: (v,s,c) => (v>4&&v<9)||v===12 },
    { cond: "valor = 13 E preto", tipo:"Médio", dica:"Reis pretos", check: (v,s,c) => v===13&&c==='black' },
    { cond: "valor = 11 OU (ouros E valor >= 7)", tipo:"Médio", dica:"Valetes (J) OU Ouros >= 7", check: (v,s,c) => v===11||(s==='diamonds'&&v>=7) },
    { cond: "copas OU (espadas E valor >= 12)", tipo:"Médio", dica:"Todas Copas OU Espadas Q/K", check: (v,s,c) => s==='hearts'||(s==='spades'&&v>=12) },
    { cond: "ímpar E vermelho", tipo:"Médio", dica:"Cartas vermelhas ímpares", check: (v,s,c) => v%2===1&&c==='red' },
    { cond: "(valor * 2 - 3) > 10 OU preto", tipo:"Difícil", dica:"Cartas onde (valor×2-3)>10 OU são pretas", check: (v,s,c) => (v*2-3)>10||c==='black' },
    { cond: "(copas E par) OU (espadas E valor > 9)", tipo:"Difícil", dica:"Copas pares OU Espadas > 9", check: (v,s,c) => (s==='hearts'&&v%2===0)||(s==='spades'&&v>9) },
    { cond: "vermelho E ((valor + 3) / 2) > 5", tipo:"Difícil", dica:"Vermelhas onde (valor+3)/2 > 5", check: (v,s,c) => c==='red'&&((v+3)/2)>5 },
    { cond: "(ouros E valor >= 8 E ímpar) OU (espadas E valor % 3 = 0)", tipo:"Difícil", dica:"Ouros ímpares >= 8 OU Espadas múltiplos de 3", check: (v,s,c) => (s==='diamonds'&&v>=8&&v%2===1)||(s==='spades'&&v%3===0) },
    { cond: "paus E (valor - 2) * 3 < 20", tipo:"Difícil", dica:"Paus onde (valor-2)×3 < 20", check: (v,s,c) => s==='clubs'&&(v-2)*3<20 },
    { cond: "(primo E preto) OU (valor >= 12 E copas)", tipo:"Difícil", dica:"Pretas primas OU Copas Q/K", check: (v,s,c) => (isPrime(v)&&c==='black')||(v>=12&&s==='hearts') },
    { cond: "(valor / 2 >= 4) OU (espadas E ímpar)", tipo:"Difícil", dica:"Cartas onde valor/2>=4 OU Espadas ímpares", check: (v,s,c) => (v/2>=4)||(s==='spades'&&v%2===1) },
    { cond: "(copas E valor >= 9) OU (ouros E valor <= 4)", tipo:"Difícil", dica:"Copas >= 9 OU Ouros <= 4", check: (v,s,c) => (s==='hearts'&&v>=9)||(s==='diamonds'&&v<=4) },
    { cond: "ouros E ((valor + 5) % 4 = 0)", tipo:"Difícil", dica:"Ouros onde (valor+5) é múltiplo de 4", check: (v,s,c) => s==='diamonds'&&(v+5)%4===0 },
    { cond: "(vermelho E valor < 4) OU (valor >= 11 E preto)", tipo:"Difícil", dica:"Vermelhas < 4 OU Pretas >= J", check: (v,s,c) => (c==='red'&&v<4)||(v>=11&&c==='black') },
    { cond: "(valor * valor) <= 25 E copas", tipo:"Difícil", dica:"Copas onde valor² <= 25", check: (v,s,c) => (v*v)<=25&&s==='hearts' },
    { cond: "(valor = 12 E vermelho) OU (valor = 13 E preto)", tipo:"Difícil", dica:"Damas vermelhas OU Reis pretos", check: (v,s,c) => (v===12&&c==='red')||(v===13&&c==='black') },
    { cond: "preto E ((valor + 1) / 3 > 3)", tipo:"Difícil", dica:"Pretas onde (valor+1)/3 > 3", check: (v,s,c) => c==='black'&&((v+1)/3)>3 },
    { cond: "(espadas E valor - 5 < 5) OU valor = 1", tipo:"Difícil", dica:"Espadas onde valor-5<5 OU Ases", check: (v,s,c) => (s==='spades'&&v-5<5)||v===1 },
    { cond: "((copas OU ouros) E valor > 7) OU (paus E par)", tipo:"Difícil", dica:"Vermelhas > 7 OU Paus pares", check: (v,s,c) => ((s==='hearts'||s==='diamonds')&&v>7)||(s==='clubs'&&v%2===0) }
];

let index = 0, currentMode = 'drag', statsCorrect = 0, statsWrong = 0;

function isPrime(n){ if(n<=1)return false; if(n<=3)return true; if(n%2===0)return false; for(let i=3;i*i<=n;i+=2)if(n%i===0)return false; return true; }
function valueToNum(v){ if(v==='A')return 1; if(v==='J')return 11; if(v==='Q')return 12; if(v==='K')return 13; return parseInt(v,10); }

function setMode(mode){
    currentMode = mode;
    document.getElementById('mode-drag').classList.toggle('active', mode==='drag');
    document.getElementById('mode-click').classList.toggle('active', mode==='click');
    document.querySelectorAll('.cards-row .card').forEach(c => {
        c.draggable = (mode==='drag');
        c.style.cursor = (mode==='click') ? 'pointer' : 'grab';
    });
    const lbl = answerZone.querySelector('.answer-zone-label');
    if(lbl) lbl.textContent = mode==='drag' ? '🎯 Arraste as cartas que atendem a condição' : '🎯 Clique nas cartas que atendem a condição';
}

function criarBaralho(){
    for(let sk in suits){
        const suit = suits[sk];
        const container = document.getElementById(`${sk}-cards`);
        values.forEach(value => {
            const card = document.createElement('div');
            card.className = `card ${suit.color}`;
            card.draggable = (currentMode==='drag');
            card.dataset.id   = `${value}-${sk}`;
            card.dataset.value = value;
            card.dataset.vnum  = valueToNum(value);
            card.dataset.suit  = sk;
            card.innerHTML = `<div class="card-value">${value}</div><div class="card-symbol">${suit.symbol}</div>`;
            card.addEventListener('dragstart', e => { if(currentMode==='drag'){ e.dataTransfer.effectAllowed='copy'; e.target.classList.add('dragging'); window.draggedCard=e.target; } });
            card.addEventListener('dragend',   e => { e.target.classList.remove('dragging'); });
            card.addEventListener('click',     () => { if(currentMode==='click') adicionarCartaPorClique(card); });
            container.appendChild(card);
        });
    }
}

function adicionarCartaPorClique(orig){
    if(Array.from(answerZone.querySelectorAll('.card')).some(c=>c.dataset.id===orig.dataset.id)) return;
    const lbl = answerZone.querySelector('.answer-zone-label');
    if(lbl) lbl.remove();
    const clone = orig.cloneNode(true);
    clone.draggable=false; clone.style.cursor='pointer'; clone.title='Clique para remover';
    ['id','value','vnum','suit'].forEach(k=>clone.dataset[k]=orig.dataset[k]);
    clone.onclick=function(){ this.remove(); if(!answerZone.querySelectorAll('.card').length) answerZone.innerHTML=`<div class="answer-zone-label">🎯 ${currentMode==='drag'?'Arraste':'Clique n'}as cartas que atendem a condição</div>`; };
    answerZone.appendChild(clone);
}

const answerZone = document.getElementById('answer-zone');
answerZone.addEventListener('dragover', e => { if(currentMode==='drag'){ e.preventDefault(); answerZone.classList.add('drag-over'); } });
answerZone.addEventListener('dragleave', () => answerZone.classList.remove('drag-over'));
answerZone.addEventListener('drop', e => { if(currentMode==='drag'){ e.preventDefault(); answerZone.classList.remove('drag-over'); if(window.draggedCard) adicionarCartaPorClique(window.draggedCard); } });

function limparZona(){ answerZone.innerHTML=`<div class="answer-zone-label">🎯 ${currentMode==='drag'?'Arraste':'Clique n'}as cartas que atendem a condição</div>`; }

function toggleSuit(sk){
    const g=document.getElementById(`suit-${sk}`), b=document.querySelector(`.suit-filter-btn[data-suit="${sk}"]`);
    g.classList.contains('d-none') ? (g.classList.remove('d-none'), b.classList.add('active')) : (g.classList.add('d-none'), b.classList.remove('active'));
}

function atualizarProgresso(){
    const tot=desafios.length, cur=index+1, pct=Math.round(index/tot*100);
    document.getElementById('progress-text').innerText=`Desafio ${cur} de ${tot}`;
    const bar=document.getElementById('progress-bar'); bar.style.width=pct+'%'; bar.textContent=pct+'%';
    document.getElementById('difficulty-text').innerText=`Nível: ${desafios[index].tipo||'Médio'}`;
    document.getElementById('stat-current').textContent=cur;
    document.getElementById('stat-difficulty').textContent=desafios[index].tipo||'Médio';
}

function novoDesafio(){
    document.getElementById('challenge-text').innerText=desafios[index].cond;
    document.getElementById('tip-box').style.display='none';
    document.getElementById('feedback').innerText='';
    document.getElementById('feedback').className='feedback-inline';
    atualizarProgresso(); limparZona();
}

function mostrarDica(){
    const tb=document.getElementById('tip-box');
    tb.innerHTML=`<strong>💡 Dica:</strong> ${desafios[index].dica||'Tente pensar em cor, naipe e valor.'}`;
    tb.style.display='block';
}

function pularDesafio(){ index=(index+1)%desafios.length; novoDesafio(); }

function verificarResposta(){
    const fb=document.getElementById('feedback');
    const clones=[...answerZone.querySelectorAll('.card')];
    if(!clones.length){ fb.innerHTML='⚠️ Adicione ao menos 1 carta'; fb.className='feedback-inline warning'; return; }

    const todasCartas=document.querySelectorAll('.cards-row .card');
    const corrSet=new Set();
    todasCartas.forEach(card=>{
        const v=parseInt(card.dataset.vnum,10), s=card.dataset.suit, c=(s==='hearts'||s==='diamonds')?'red':'black';
        if(desafios[index].check(v,s,c)) corrSet.add(card.dataset.id);
    });

    const selSet=new Set(clones.map(c=>c.dataset.id));
    const todasOk=clones.every(c=>corrSet.has(c.dataset.id));
    const pegouTodas=[...corrSet].every(id=>selSet.has(id));

    clones.forEach(c=>{ c.classList.add(corrSet.has(c.dataset.id)?'correct':'wrong'); });
    setTimeout(()=>clones.forEach(c=>c.classList.remove('correct','wrong')),600);

    if(todasOk && pegouTodas){
        fb.innerHTML='✔️ Perfeito! Todas corretas!'; fb.className='feedback-inline correct';
        statsCorrect++; document.getElementById('stat-correct').textContent=statsCorrect;
        setTimeout(()=>{ index=(index+1)%desafios.length; novoDesafio(); },1500);
    } else if(todasOk && !pegouTodas){
        fb.innerHTML=`⚠️ Faltam ${corrSet.size-selSet.size} carta(s)!`; fb.className='feedback-inline warning';
        statsWrong++; document.getElementById('stat-wrong').textContent=statsWrong;
    } else if(!todasOk && pegouTodas){
        fb.innerHTML='❌ Cartas incorretas incluídas!'; fb.className='feedback-inline wrong';
        statsWrong++; document.getElementById('stat-wrong').textContent=statsWrong;
    } else {
        fb.innerHTML='❌ Resposta incorreta. Revise!'; fb.className='feedback-inline wrong';
        statsWrong++; document.getElementById('stat-wrong').textContent=statsWrong;
    }
}

criarBaralho();
novoDesafio();
</script>
</body>
</html>