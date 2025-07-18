// Exibe o modal apenas no primeiro acesso
window.onload = function() {
    const modal = document.getElementById('modal-primeiro-acesso');
    const closeBtn = document.querySelector('.modal .close');
    // Verifica se já foi visto
    if (!localStorage.getItem('modalPrimeiroAcessoVisto')) {
        modal.style.display = 'flex';
    }
    if (closeBtn) {
        closeBtn.onclick = function() {
            modal.style.display = 'none';
            localStorage.setItem('modalPrimeiroAcessoVisto', 'true');
        }
    }
    // Fecha o modal ao clicar fora do conteúdo
    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
            localStorage.setItem('modalPrimeiroAcessoVisto', 'true');
        }
    }
}

// Carrossel simples acessível
document.addEventListener('DOMContentLoaded', function() {
  const slides = document.querySelectorAll('.carousel-slide');
  const dots = document.querySelectorAll('.carousel-dots .dot');
  const prev = document.querySelector('.carousel-arrow.left');
  const next = document.querySelector('.carousel-arrow.right');
  let current = 0;

  function showSlide(idx) {
    slides.forEach((slide, i) => {
      slide.classList.toggle('active', i === idx);
      dots[i].classList.toggle('active', i === idx);
    });
    current = idx;
  }

  prev.addEventListener('click', () => {
    showSlide((current - 1 + slides.length) % slides.length);
  });
  next.addEventListener('click', () => {
    showSlide((current + 1) % slides.length);
  });
  dots.forEach((dot, i) => {
    dot.addEventListener('click', () => showSlide(i));
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowLeft') prev.click();
    if (e.key === 'ArrowRight') next.click();
  });

  showSlide(0);
});

// Busca dinâmica de cursos
document.addEventListener('DOMContentLoaded', function() {
  const inputBusca = document.getElementById('input-busca');
  const formBusca = document.getElementById('form-busca');
  const cursosGrid = document.getElementById('cursosGrid');
  if (!inputBusca || !cursosGrid) return;

  // Evita o submit do formulário
  formBusca.addEventListener('submit', function(e) {
      e.preventDefault();
  });

  inputBusca.addEventListener('input', function() {
      const termo = this.value.toLowerCase();
      const cards = cursosGrid.querySelectorAll('.curso-card:not(.add-card)');
      cards.forEach(card => {
          const titulo = card.querySelector('h3')?.textContent.toLowerCase() || '';
          const descricao = card.querySelector('p')?.textContent.toLowerCase() || '';
          if (titulo.includes(termo) || descricao.includes(termo)) {
              card.style.display = '';
          } else {
              card.style.display = 'none';
          }
      });
  });
});