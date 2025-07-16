// Exibe o modal apenas no primeiro acesso
window.onload = function() {
    const modal = document.getElementById('modal-primeiro-acesso');
    const closeBtn = document.querySelector('.modal .close');
    modal.style.display = 'flex'; // Sempre mostra a modal

    if (closeBtn) {
        closeBtn.onclick = function() {
            modal.style.display = 'none';
        }
    }
    // Fecha o modal ao clicar fora do conteúdo
    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
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

