# Logic with Cards

A deck-based gamified web environment for teaching programming logic and
algorithms. The standard French deck of cards is used as a metaphor, following
the Concrete–Pictorial–Abstract (CPA) approach: manipulating cards (concrete),
interacting with blocks and animations (pictorial) and reading the equivalent
source code (abstract).

**Current version:** 2.0
**Live version:** https://logicacombaralho.infinityfreeapp.com/
**Interface language:** Brazilian Portuguese (pt-BR)

## What is new in version 2.0

- **Sequential search** module (manual and automatic modes).
- **Binary search** module (manual and automatic modes).

Version 1.0 contained the Logical Operators, Conditions, Repetition and Sorting
modules.

## Modules

| Module | File | Description |
|---|---|---|
| Menu | `index2.php` | Main menu with links to all modules. |
| Logical Operators | `operadores.php` | 45 challenges with increasing difficulty. The student selects the cards that satisfy a Boolean/arithmetic condition (e.g. "red AND value > 5"), by dragging or clicking. Hints, skipping and score. |
| Conditions | `condicao.php` | Block-based workspace with if-then, if-then-else, if-then-else-if and switch/case blocks that test colour, suit or value of a card. Execution log with adjustable speed. |
| Repetition | `repeticao.php` | Block-based workspace with `for` and `while` loops over a sequence of cards, with actions applied at each iteration and an execution log. |
| Sorting | `ordenacao.php` | Bubble, Selection and Insertion Sort with 5, 7 or 10 cards. Practice mode (validate, hint and undo buttons, step console) and visualisation mode (adjustable speed), plus the equivalent code in JavaScript, Python and Java. |
| Sequential Search | `buscasequencial.php` | *(new)* Decks of 5, 8 or 13 cards. In manual mode the cards are face down and the student flips them one by one, from left to right, until the target is found. In automatic mode the program performs the traversal. Hint, score and log. |
| Binary Search | `buscabinaria.php` | *(new)* Sorted decks of 7, 11 or 15 cards. In manual mode the student flips the middle card of the active range and decides whether the target is on the left, on the right or is that card. A range indicator and a pseudocode panel follow the steps. In automatic mode the program performs the search. Hint, score and log. |

## Requirements

- **Hosted version:** any modern web browser (no installation).
- **Running locally:** a web server with PHP support, for example
  [XAMPP](https://www.apachefriends.org/) or the PHP built-in server.
- An Internet connection is needed because the pages load
  [Bootstrap](https://getbootstrap.com/) 5.3.0 from the jsDelivr CDN.

The PHP files contain **no server-side logic and no database**: all the
behaviour is implemented in HTML, CSS and JavaScript inside each page. PHP is
only used to serve the pages.

## Running locally

### Option A: XAMPP

1. Install XAMPP and start the **Apache** service.
2. Copy this repository into the `htdocs` folder, for example
   `htdocs/logic-with-cards`.
3. Open http://localhost/logic-with-cards/index2.php in your browser.

### Option B: PHP built-in server

```bash
git clone https://github.com/Bateria-instantanea/logic-with-cards.git
cd logic-with-cards
php -S localhost:8000
```

Then open http://localhost:8000/index2.php.

## Usage

1. Open `index2.php` and choose a module in the menu.
2. Follow the instructions shown on the screen of each module.
3. In the sorting and search modules, choose the number of cards (difficulty)
   and, in the search modules, choose between **Manual** and **Automatic** mode.
4. Use the **Menu** button of each module to go back to the main menu.

## Repository structure

```
.
├── README.md
├── Licence.txt
├── index2.php            Main menu
├── operadores.php        Logical Operators
├── condicao.php          Conditions
├── repeticao.php         Repetition
├── ordenacao.php         Sorting
├── buscasequencial.php   Sequential Search (v2.0)
└── buscabinaria.php      Binary Search (v2.0)
```

## Dependencies

- Bootstrap 5.3.0 (CSS, and JS bundle in `operadores.php`), loaded from the
  jsDelivr CDN. Bootstrap is released under the MIT License.

## Citation

If you use this software, please cite:

> V. Ferreira, M. A. Vieira, D. Fernandes, J. Felix, F. Soares,
> T. H. Nascimento. *Logic with Cards: a deck-based gamified web environment
> for teaching programming logic and algorithms.* SoftwareX.

Version 1.0 and its usability evaluation (SUS and UEQ-S, 23 participants) are
described in:

> V. Ferreira, M. A. Vieira, D. Fernandes, J. Felix, F. Soares,
> T. H. Nascimento. *A deck-based gamified environment for programming
> education: design and evaluation.* COMPSAC 2026.

## License

Released under the MIT License. See [Licence.txt](Licence.txt).

## Contact

Questions and bug reports: please open an issue in this repository or write to
`conectadodigital123@gmail.com`.
