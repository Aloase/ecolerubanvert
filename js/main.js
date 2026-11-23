/**
 * Ecole Ruban Vert — main.js  (version simple)
 *
 * Un seul fichier JS, aucune dépendance, aucune animation de défilement.
 * À charger avec style.css (avant </body>, avec « defer »).
 *
 * Sommaire
 *  00. Réglages, chemins, splash screen
 *  01. Menu hamburger (navigation verticale)
 *  02. Recherche
 *  03. Header, retour en haut, lien actif
 *  04. Logo + images à la place des icônes
 *  05. Hero : mots de bienvenue qui défilent
 *  06. Formes qui se construisent au scroll + sections découpées
 *  07. Accordéon, galerie, formulaire de contact
 */
(function () {
  'use strict';

  function $(s, c)  { return (c || document).querySelector(s); }
  function $$(s, c) { return Array.prototype.slice.call((c || document).querySelectorAll(s)); }
  var body = document.body;

  /* ============================================================
     00. RÉGLAGES, CHEMINS, SPLASH SCREEN
     ============================================================ */
  var CONFIG = {
    splash: true,            // écran d'accueil
    splashOnce: true,        // true = une seule fois par visite (pas au changement de page ni au retour) ; false = à chaque chargement
    splashWord: 'Ruban Vert',// mot écrit sous le logo
    splashSeconds: 4.8,      // durée du splash
    assets: 'assets/images/' // dossier des images, depuis la racine du site
  };

  // Racine du site déduite de l'emplacement de ce script (ex. /js/main.js → /)
  var me = document.currentScript;
  var ROOT = me && me.src ? me.src.replace(/[^\/]*\/[^\/?#]*(\?.*)?$/, '') : '';
  var IMG = ROOT + CONFIG.assets;
  var LOGO = IMG + 'erv-logo.png';             // logo couleurs (fond clair)
  var LOGO_WHITE = IMG + 'erv-logo-white.png'; // logo blanc (fond foncé)

  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // Une seule fois par visite : on se souvient dans sessionStorage (effacé à la fermeture de l'onglet)
  var splashShown = false;
  var splashSeen = false;
  try { splashSeen = CONFIG.splashOnce && sessionStorage.getItem('ervSplash') === '1'; } catch (e) {}

  if (CONFIG.splash && !reduce && !splashSeen) {
    splashShown = true;
    try { sessionStorage.setItem('ervSplash', '1'); } catch (e) {}
    var sp = document.createElement('div');
    sp.id = 'splash';
    sp.innerHTML = '<img class="splash-logo" src="' + LOGO + '" alt="École Ruban Vert">' +
      '<div class="splash-word" aria-label="' + CONFIG.splashWord + '">' + CONFIG.splashWord.split('').map(function (c, i) {
        return '<span' + (c === ' ' ? ' class="sp"' : '') + ' style="--m:' + i + '" aria-hidden="true">' + (c === ' ' ? '&nbsp;' : c) + '</span>';
      }).join('') + '</div>' +
      // Le ruban vert : il se dessine sous le mot à la fin de l'animation
      '<svg class="splash-ribbon" viewBox="0 0 640 90" aria-hidden="true">' +
        '<path pathLength="1" class="rb-shadow" d="M12 58 C 92 6, 168 100, 248 54 S 408 6, 488 54 S 590 92, 628 38"/>' +
        '<path pathLength="1" class="rb-main" d="M12 52 C 92 0, 168 94, 248 48 S 408 0, 488 48 S 590 86, 628 32"/>' +
        '<path pathLength="1" class="rb-light" d="M12 46 C 92 -6, 168 88, 248 42 S 408 -6, 488 42 S 590 80, 628 26"/>' +
      '</svg>';
    body.appendChild(sp);
    body.classList.add('splash-open');
    setTimeout(function () {
      sp.classList.add('leaving');
      body.classList.remove('splash-open');
      setTimeout(function () { if (sp.parentNode) sp.parentNode.removeChild(sp); }, 900);
    }, CONFIG.splashSeconds * 1000);
  }

  /* ============================================================
     01. MENU HAMBURGER — la navigation s'affiche à la verticale
     ============================================================ */
  var header = $('#main-header');
  var nav = $('#main-nav');
  var toggle = $('#nav-toggle');
  var closeBtn = $('#nav-close');

  if (nav && toggle) {
    // Les boutons (Apply, recherche, hamburger) doivent rester visibles quand le menu est fermé
    var inner = $('.header-inner');
    var actions = $('.nav-actions');
    if (inner) {
      if (actions && nav.contains(actions)) inner.appendChild(actions);
      if (!(actions && actions.contains(toggle))) inner.appendChild(toggle);   // le hamburger reste le dernier élément à droite
    }

    // Boutons d'action dans la barre : Apply Now, Contact Us, Book a Tour (à gauche de la loupe)
    // href = null → le lien est cherché automatiquement dans la page ; écrire une URL pour l'imposer.
    var HEADER_BTNS = [
      { label: 'Apply Now',   cls: 'hb-apply',   href: null, match: /apply|admission/i },
      { label: 'Contact Us',  cls: 'hb-contact', href: null, match: /contact/i },
      { label: 'Book a Tour', cls: 'hb-tour',    href: null, match: /tour|visit/i }
    ];
    if (actions) {
      var oldApply = $('.btn-apply', actions);
      var allLinks = $$('a[href]').filter(function (l) { return !l.classList.contains('hb') && l.getAttribute('href') !== '#'; });
      var find = function (re) {
        var hit = allLinks.filter(function (l) { return re.test(l.getAttribute('href')) || re.test(l.textContent); })[0];
        return hit ? hit.getAttribute('href') : null;
      };
      var contactHref = find(/contact/i) || '#contact';
      var make = function (d) {
        var href = d.href || (d.cls === 'hb-apply' && oldApply ? oldApply.getAttribute('href') : null) || find(d.match) || contactHref;
        var a = document.createElement('a');
        a.className = 'hb ' + d.cls;
        a.href = href;
        a.textContent = d.label;
        return a;
      };
      if (oldApply) oldApply.parentNode.removeChild(oldApply);
      HEADER_BTNS.slice().reverse().forEach(function (d) { actions.insertBefore(make(d), actions.firstChild); });
      // Même boutons en bas du panneau (utile sur mobile où la barre est trop étroite)
      var cta = document.createElement('div');
      cta.className = 'nav-panel-cta';
      HEADER_BTNS.forEach(function (d) { cta.appendChild(make(d)); });
      nav.appendChild(cta);
    }

    // Voile sombre derrière le panneau
    var backdrop = document.createElement('div');
    backdrop.className = 'nav-backdrop';
    (header || body).appendChild(backdrop);   // dans le header : même contexte d'empilement que le panneau

    var setNav = function (open) {
      nav.classList.toggle('open', open);
      backdrop.classList.toggle('open', open);
      body.classList.toggle('nav-open', open);
      toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    };
    toggle.setAttribute('aria-expanded', 'false');
    toggle.addEventListener('click', function () { setNav(!nav.classList.contains('open')); });
    if (closeBtn) closeBtn.addEventListener('click', function () { setNav(false); });
    backdrop.addEventListener('click', function () { setNav(false); });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') setNav(false); });

    // Sous-menus : un clic sur un élément qui en contient un le déplie (accordéon vertical)
    $$('.nav-item, .dropdown-item', nav).forEach(function (item) {
      var link = $(':scope > .nav-link, :scope > .dropdown-link', item);
      var sub = $(':scope > .dropdown, :scope > .sub-dropdown', item);
      if (!link || !sub) return;
      link.setAttribute('data-toggler', '1');
      // Le lien parent ne mène plus nulle part quand il déplie : on garde la page via « Overview »
      var href = link.getAttribute('href');
      if (href && href !== '#') {
        var li = document.createElement('li');
        li.className = 'dropdown-item';
        li.innerHTML = '<a class="dropdown-link dropdown-overview" href="' + href + '">Overview →</a>';
        sub.insertBefore(li, sub.firstChild);
      }
      link.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        item.classList.toggle('open');   // déplier ne ferme PAS le menu
      });
    });
    // Seuls les vrais liens de page referment le panneau
    $$('a[href]:not([href="#"]):not([data-toggler])', nav).forEach(function (a) {
      a.addEventListener('click', function () { setNav(false); });
    });
  }

  /* ============================================================
     02. RECHERCHE
     ============================================================ */
  (function () {
    var btn = $('#search-btn'), ov = $('#search-overlay'), close = $('#search-close'), input = $('#search-input');
    if (!btn || !ov) return;
    function shut() { ov.classList.remove('open'); body.style.overflow = ''; }
    btn.addEventListener('click', function () {
      ov.classList.add('open'); body.style.overflow = 'hidden';
      setTimeout(function () { if (input) input.focus(); }, 300);
    });
    if (close) close.addEventListener('click', shut);
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') shut(); });
  })();

  /* ============================================================
     03. HEADER, RETOUR EN HAUT, LIEN ACTIF
     ============================================================ */
  (function () {
    var topBtn = $('#scroll-top');
    function onScroll() {
      var y = window.pageYOffset || 0;
      if (header) header.classList.toggle('scrolled', y > 20);
      if (topBtn) topBtn.classList.toggle('visible', y > 600);
    }
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
    if (topBtn) topBtn.addEventListener('click', function () { window.scrollTo({ top: 0, behavior: 'smooth' }); });

    var path = window.location.pathname;
    $$('.nav-link, .dropdown-link').forEach(function (link) {
      var href = link.getAttribute('href');
      if (!href || href === '#') return;
      if (href === path || (href !== '/' && path.indexOf(href + '/') === 0)) {
        var item = link.closest('.nav-item');
        if (item) item.classList.add('active');
      }
    });
  })();

  /* ============================================================
     04. LOGO + IMAGES À LA PLACE DES ICÔNES
     ============================================================ */
  (function () {
    // Logo de l'école dans le header et le footer (si l'image ne charge pas, l'ancien logo reste)
    $$('.site-logo').forEach(function (a) {
      var inFooter = !!a.closest('#main-footer');
      var old = a.innerHTML;
      var img = document.createElement('img');
      img.className = 'logo-img';
      img.alt = 'École Ruban Vert — International School of Gabon';
      img.src = inFooter ? LOGO_WHITE : LOGO;
      img.onerror = function () { a.innerHTML = old; };
      img.onload = function () { a.innerHTML = ''; a.appendChild(img); };
    });

    // Cartes « liens rapides » : une photo à la place de l'emoji
    var QL = { sports: 'team-highfive.jpg', facilities: 'library-reading.jpg', vacancies: 'concept-teach.jpg',
               activities: 'student-art-drawing.jpg', news: 'students-celebrating.jpg', admissions: 'classroom-kids-writing.jpg' };
    $$('.quick-link-card').forEach(function (card) {
      var ic = $('.quick-link-icon', card), t = $('.quick-link-title', card);
      if (!ic) return;
      var key = (t ? t.textContent : '').trim().toLowerCase();
      ic.textContent = '';
      ic.style.backgroundImage = 'url(' + IMG + (QL[key] || 'classroom-kids-writing.jpg') + ')';
    });

    // Photos en arrière-plan de sections (sous un voile vert pour garder le texte lisible)
    var BG = { '.stats-section': 'gymnase-vide-1.jpg', '.testimonials': 'auditorium.jpg' };
    Object.keys(BG).forEach(function (sel) {
      var el = $(sel);
      if (!el) return;
      el.style.backgroundImage = 'linear-gradient(rgba(0,69,59,.80), rgba(0,69,59,.88)), url(' + IMG + BG[sel] + ')';
      el.style.backgroundSize = 'cover';
      el.style.backgroundPosition = 'center';
    });

    // Mission / Vision / Valeurs
    var MV = { mission: 'concept-teach.jpg', vision: 'students-celebrating.jpg', values: 'team-highfive.jpg' };
    $$('.mvv-card').forEach(function (card) {
      var ic = $('.mvv-icon', card);
      if (!ic) return;
      var k = Object.keys(MV).filter(function (n) { return card.classList.contains(n); })[0];
      if (!k) return;
      ic.textContent = '';
      ic.style.backgroundImage = 'url(' + IMG + MV[k] + ')';
    });
  })();

  /* ============================================================
     05. HERO — MBOLO, Bienvenue, Welcome, Bienvenido, arabe
     Modifier la liste ci-dessous pour changer ou ajouter des mots.
     ============================================================ */
  (function () {
    var content = $('.hero-content');
    if (!content) return;

    var WORDS = [
      { t: 'MBOLO',      c: '#ffd600' },                         // jaune
      { t: 'Bienvenue',  c: '#ee7917' },                         // orange
      { t: 'Welcome',    c: '#17a3dd' },                         // bleu
      { t: 'Bienvenido', c: '#ffffff' },                         // blanc
      { t: 'أهلاً وسهلاً', c: '#ffd600', lang: 'ar', dir: 'rtl' },  // arabe
      { t: '欢迎光临', c: '#17a3dd', lang: 'zh' },              // mandarin
    ];
    var TYPE = 130;     // vitesse d'écriture (ms par lettre)
    var ERASE = 55;     // vitesse d'effacement (ms par lettre)
    var HOLD = 1500;    // pause quand le mot est écrit (ms)

    var box = document.createElement('div');
    box.className = 'hero-greet';
    box.setAttribute('role', 'text');
    box.setAttribute('aria-label', 'MBOLO, Bienvenue, Welcome, Bienvenido, أهلاً وسهلاً');
    var line = document.createElement('span');
    line.className = 'line';
    line.setAttribute('aria-hidden', 'true');
    var txt = document.createElement('span');
    var caret = document.createElement('i');
    caret.className = 'caret';
    line.appendChild(txt); line.appendChild(caret);
    box.appendChild(line);
    content.insertBefore(box, content.firstChild);

    // Le badge « IB World School » passe au-dessus des mots
    var badge = $('.hero-badge', content);
    if (badge) content.insertBefore(badge, box);

    // Diaporama du fond : 3 images, 1,5 s chacune, en boucle
    var slides = $$('.hero-slide');
    if (slides.length > 1) {
      var si = 0;
      slides.forEach(function (s, k) { s.classList.toggle('active', k === 0); });
      setInterval(function () {
        slides[si].classList.remove('active');
        si = (si + 1) % slides.length;
        slides[si].classList.add('active');
      }, 4000);
    }

    function show(w) {
      line.style.setProperty('--c', w.c);
      line.className = 'line' + (w.lang === 'ar' ? ' ar' : '');
      if (w.lang) { line.lang = w.lang; line.dir = w.dir; } else { line.removeAttribute('lang'); line.dir = 'ltr'; }
    }

    // Mouvement réduit : on change de mot sans écrire lettre par lettre
    if (reduce) {
      var k = 0;
      show(WORDS[0]); txt.textContent = WORDS[0].t;
      setInterval(function () { k = (k + 1) % WORDS.length; show(WORDS[k]); txt.textContent = WORDS[k].t; }, 2400);
      return;
    }

    var wi = 0, ci = 0, erasing = false;
    show(WORDS[0]);
    // L'écriture démarre quand le splash se retire
    var startAt = (splashShown ? CONFIG.splashSeconds * 1000 + 400 : 0);
    setTimeout(function step() {
      var w = WORDS[wi], chars = Array.from(w.t);   // Array.from : respecte les lettres arabes
      var delay;
      if (!erasing) {
        ci++;
        txt.textContent = chars.slice(0, ci).join('');
        if (ci >= chars.length) { erasing = true; delay = HOLD; } else delay = TYPE;
      } else {
        ci--;
        txt.textContent = chars.slice(0, Math.max(ci, 0)).join('');
        if (ci <= 0) {
          erasing = false; ci = 0;
          wi = (wi + 1) % WORDS.length;
          show(WORDS[wi]);
          delay = 350;
        } else delay = ERASE;
      }
      setTimeout(step, delay);
    }, startAt);
  })();

  /* ============================================================
     05b. CARROUSEL « LEARNING AT ERV » (flèches, points, défilement auto, glisser au doigt)
     ============================================================ */
  (function () {
    var root = $('.learning-swiper');
    if (!root) return;
    var wrap = $('.swiper-wrapper', root);
    var slides = $$('.swiper-slide', wrap);
    var n = slides.length;
    if (n < 2) return;

    var ctr = document.createElement('div');
    ctr.className = 'l-controls';
    ctr.innerHTML = '<button type="button" class="l-btn l-prev" aria-label="Previous slide">&larr;</button>' +
      '<div class="l-dots">' + slides.map(function (_, i) { return '<button type="button" class="l-dot" aria-label="Slide ' + (i + 1) + '"></button>'; }).join('') + '</div>' +
      '<button type="button" class="l-btn l-next" aria-label="Next slide">&rarr;</button>';
    root.appendChild(ctr);
    var dots = $$('.l-dot', ctr);
    var idx = 0, timer = null;

    function go(i) {
      idx = (i + n) % n;
      wrap.style.transform = 'translateX(' + (-idx * 100) + '%)';
      dots.forEach(function (d, k) { d.classList.toggle('active', k === idx); });
      slides.forEach(function (s, k) { s.setAttribute('aria-hidden', k === idx ? 'false' : 'true'); });
    }
    function play() { stop(); if (!reduce) timer = setInterval(function () { go(idx + 1); }, 6500); }
    function stop() { if (timer) { clearInterval(timer); timer = null; } }

    $('.l-prev', ctr).addEventListener('click', function () { go(idx - 1); play(); });
    $('.l-next', ctr).addEventListener('click', function () { go(idx + 1); play(); });
    dots.forEach(function (d, k) { d.addEventListener('click', function () { go(k); play(); }); });
    root.addEventListener('mouseenter', stop);
    root.addEventListener('mouseleave', play);

    // Glisser au doigt / à la souris
    var sx = null;
    root.addEventListener('pointerdown', function (e) { if (e.target.closest('a, button')) return; sx = e.clientX; });
    window.addEventListener('pointerup', function (e) {
      if (sx === null) return;
      var dx = e.clientX - sx; sx = null;
      if (Math.abs(dx) > 50) { go(idx + (dx < 0 ? 1 : -1)); play(); }
    });
    root.setAttribute('tabindex', '0');
    root.addEventListener('keydown', function (e) {
      if (e.key === 'ArrowRight') { go(idx + 1); play(); }
      if (e.key === 'ArrowLeft') { go(idx - 1); play(); }
    });
    go(0); play();
  })();

  /* ============================================================
     05c. CARTES : elles réagissent à la souris (inclinaison 3D + reflet qui suit le curseur)
     ============================================================ */
  (function () {
    if (!window.matchMedia('(hover: hover) and (pointer: fine)').matches) return;
    var sel = '.quick-link-card, .mvv-card, .programme-scroll-card, .testimonial-card, .news-card, .stat-item, ' +
              '.sidebar-card, .team-card, .program-card, .contact-form, .contact-grid > div:first-child';
    $$(sel).forEach(function (el) {
      el.classList.add('hov');
      el.addEventListener('pointermove', function (e) {
        var r = el.getBoundingClientRect();
        var x = (e.clientX - r.left) / r.width, y = (e.clientY - r.top) / r.height;
        el.style.setProperty('--mx', (x * 100).toFixed(1) + '%');
        el.style.setProperty('--my', (y * 100).toFixed(1) + '%');
        if (!reduce) {
          el.style.setProperty('--ry', ((x - 0.5) * 10).toFixed(2) + 'deg');
          el.style.setProperty('--rx', ((0.5 - y) * 8).toFixed(2) + 'deg');
        }
      });
      el.addEventListener('pointerleave', function () {
        el.style.setProperty('--rx', '0deg');
        el.style.setProperty('--ry', '0deg');
      });
    });
  })();

  /* ============================================================
     06. FORMES QUI SE CONSTRUISENT AU SCROLL + SECTIONS DÉCOUPÉES
     Chaque section reçoit un bord haut non rectangulaire (trapèze, pointe, biais…)
     et un jeu de triangles / trapèzes / losanges qui viennent se placer en défilant.
     ============================================================ */
  (function () {
    var small = window.innerWidth <= 768;

    // 06.1 Bords découpés (le bord haut change d'une section à l'autre)
    var CUTS = ['trap', 'slant-r', 'peak', 'slant-l', 'valley', 'steps'];
    var cutTargets = ['.quick-links', '.section.bg-white', '.stats-section', '.mvv-section', '.programme-journey',
                      '.learning-story', '.testimonials', '.news-section', '.contact-section', '#main-footer'];
    var cutEls = [];
    cutTargets.forEach(function (sel) { var el = $(sel); if (el) cutEls.push(el); });
    cutEls.forEach(function (el, i) { el.classList.add('cut', 'cut-' + CUTS[i % CUTS.length]); });

    // 06.2 Formes : [type, gauche%, haut%, largeur(vw), ratio h/l, couleur, opacité, dx, dy, rotation]
    var PATH = {
      tri: 'polygon(50% 0,100% 100%,0 100%)', rtri: 'polygon(0 0,100% 100%,0 100%)',
      trap: 'polygon(18% 0,82% 0,100% 100%,0 100%)', para: 'polygon(25% 0,100% 0,75% 100%,0 100%)',
      diamond: 'polygon(50% 0,100% 50%,50% 100%,0 50%)', circle: 'circle(50% at 50% 50%)', square: 'none'
    };
    var TEMPLATES = [
      [['tri', 86, 4, 20, .9, 0, .30, 240, -200, 40], ['trap', -6, 70, 26, .45, 1, .32, -300, 200, -30],
       ['circle', 70, 80, 6, 1, 2, .95, 200, 300, 0], ['para', 12, 5, 10, .5, 3, .9, -200, -250, 25], ['rtri', 92, 52, 7, 1, 1, .95, 300, 0, -60]],
      [['rtri', -4, 8, 18, 1, 1, .30, -260, -160, -50], ['tri', 78, 66, 22, .85, 3, .28, 280, 240, 50],
       ['diamond', 6, 82, 6, 1, 0, .95, -200, 260, 40], ['trap', 62, 3, 16, .4, 2, .9, 200, -260, -20], ['circle', 2, 44, 4, 1, 2, .95, -300, 0, 0]],
      [['para', 60, 2, 24, .35, 2, .32, 300, -120, 20], ['tri', -5, 58, 18, .9, 0, .32, -280, 160, -35],
       ['square', 90, 40, 5, 1, 1, .95, 260, 40, 80], ['circle', 40, 88, 5, 1, 3, .95, 0, 300, 0], ['trap', 8, 4, 14, .45, 1, .9, -240, -220, 30]]
    ];
    var PAL_LIGHT = ['#ee7917', '#ffd600', '#17a3dd', '#8c044e'];
    var PAL_DARK  = ['#ffd600', '#ee7917', '#17a3dd', '#8c044e'];

    function isDark(el) {
      var m = getComputedStyle(el).backgroundColor.match(/\d+(\.\d+)?/g);
      if (!m) return false;
      return (0.2126 * m[0] + 0.7152 * m[1] + 0.0722 * m[2]) < 110;
    }

    var groups = [];
    var shapeTargets = ['.hero', '.page-hero'].concat(cutTargets);
    var wmTargets = ['.hero', '.section.bg-white', '.testimonials', '.contact-section'];
    var n = 0;
    shapeTargets.forEach(function (sel) {
      var el = $(sel);
      if (!el) return;
      var dark = isDark(el) || sel === '.hero';
      var pal = dark ? PAL_DARK : PAL_LIGHT;
      var layer = document.createElement('div');
      layer.className = 'shapes';
      layer.setAttribute('aria-hidden', 'true');
      el.classList.add('has-shapes');

      // Logo en filigrane
      if (wmTargets.indexOf(sel) > -1) {
        var wm = document.createElement('img');
        wm.className = 'wm ' + (n % 2 ? 'wm-l' : 'wm-r');
        wm.src = dark ? LOGO_WHITE : LOGO;
        wm.alt = '';
        layer.appendChild(wm);
      }

      var list = TEMPLATES[n % TEMPLATES.length].slice(0, small ? 3 : 5);
      var items = list.map(function (d) {
        var s = document.createElement('span');
        s.className = 'shape';
        s.style.cssText = 'left:' + d[1] + '%;top:' + d[2] + '%;width:' + d[3] + 'vw;height:' + (d[3] * d[4]).toFixed(2) + 'vw;' +
          'background:' + pal[d[5]] + ';clip-path:' + PATH[d[0]] + ';' +
          (d[0] === 'circle' ? 'border-radius:50%;' : '') +
          '--op:' + d[6] + ';--dx:' + d[7] + 'px;--dy:' + d[8] + 'px;--rot:' + d[9] + 'deg;--p:0;';
        layer.appendChild(s);
        return { el: s, y: d[2], p: -1 };
      });
      el.insertBefore(layer, el.firstChild);
      groups.push({ el: el, items: items });
      n++;
    });

    // 06.3 Au scroll : chaque forme se place selon la position de la section à l'écran
    if (reduce) {
      groups.forEach(function (g) { g.items.forEach(function (it) { it.el.style.setProperty('--p', 1); }); });
      return;
    }
    var ticking = false;
    function update() {
      ticking = false;
      var vh = window.innerHeight;
      groups.forEach(function (g) {
        var r = g.el.getBoundingClientRect();
        if (r.bottom < -200 || r.top > vh + 200) return;
        g.items.forEach(function (it) {
          var top = r.top + it.y / 100 * r.height;           // position de la forme dans la page
          var t = Math.max(0, Math.min(1, (vh * 0.95 - top) / (vh * 0.5)));
          t = t * t * (3 - 2 * t);                            // adoucit le mouvement
          t = Math.round(t * 100) / 100;
          if (t !== it.p) { it.p = t; it.el.style.setProperty('--p', t); }
        });
      });
    }
    function req() { if (!ticking) { ticking = true; requestAnimationFrame(update); } }
    window.addEventListener('scroll', req, { passive: true });
    window.addEventListener('resize', req);
    update();
  })();

  /* ============================================================
     07. ACCORDÉON, GALERIE, FORMULAIRE
     ============================================================ */
  $$('.accordion-header').forEach(function (h) {
    h.addEventListener('click', function () {
      var panel = h.nextElementSibling;
      var wasOpen = h.classList.contains('active');
      $$('.accordion-header').forEach(function (x) {
        x.classList.remove('active');
        if (x.nextElementSibling) x.nextElementSibling.classList.remove('open');
      });
      if (!wasOpen) { h.classList.add('active'); if (panel) panel.classList.add('open'); }
    });
  });

  (function () {
    var items = $$('.gallery-item[data-src]');
    if (!items.length) return;
    var lb = document.createElement('div');
    lb.style.cssText = 'position:fixed;inset:0;background:rgba(0,0,0,.92);z-index:3000;display:none;align-items:center;justify-content:center;cursor:zoom-out;';
    lb.innerHTML = '<button type="button" aria-label="Fermer" style="position:absolute;top:1.5rem;right:1.5rem;background:none;border:0;color:#fff;font-size:2.5rem;cursor:pointer;line-height:1;">&times;</button><img alt="" style="max-width:90vw;max-height:90vh;object-fit:contain;">';
    body.appendChild(lb);
    var img = $('img', lb);
    function shut() { lb.style.display = 'none'; body.style.overflow = ''; img.src = ''; }
    items.forEach(function (it) {
      it.addEventListener('click', function () {
        img.src = it.getAttribute('data-src');
        img.alt = it.getAttribute('data-alt') || '';
        lb.style.display = 'flex'; body.style.overflow = 'hidden';
      });
    });
    lb.addEventListener('click', function (e) { if (e.target === lb || e.target.tagName === 'BUTTON') shut(); });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') shut(); });
  })();

  (function () {
    var form = $('#contact-form');
    if (!form) return;
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var btn = $('.btn-submit', form), label = btn ? btn.innerHTML : '';
      if (btn) { btn.textContent = 'Envoi en cours…'; btn.disabled = true; }
      // Simulation : à remplacer par un vrai envoi (AJAX / PHP)
      setTimeout(function () {
        var msg = $('#form-message');
        if (msg) msg.innerHTML = '<div class="alert alert-success">Merci ! Votre message a été envoyé. Nous vous répondrons dans les plus brefs délais.</div>';
        form.reset();
        if (btn) { btn.innerHTML = label; btn.disabled = false; }
      }, 1500);
    });
  })();
})();