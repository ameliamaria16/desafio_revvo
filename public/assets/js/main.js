// Exibe o modal apenas no primeiro acesso
window.onload = function() {
    const modal = document.getElementById('modal-primeiro-acesso');
    const closeBtn = document.querySelector('.modal .close');
    if (!localStorage.getItem('modalAcessado')) {
        modal.style.display = 'flex';
        localStorage.setItem('modalAcessado', 'true');
    }
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

const cursos = [
    {
      titulo: "Pellentesque malesuada",
      descricao: "Curabitur blandit tempus porttitor. Nullam quis risus eget urna mollis ornare vel eu leo.",
      imagem: "https://res.cloudinary.com/dd1vq4hwj/image/upload/v1752618663/images_f7pdra.jpg",
      link: "#"
    },
  ];
  
  function renderizarCursos() {
    const grid = document.getElementById('cursosGrid');
    grid.querySelectorAll('.curso-card:not(.add-card)').forEach(card => card.remove());
  
    cursos.forEach(curso => {
      const card = document.createElement('div');
      card.className = 'curso-card';
      card.innerHTML = `
        <img src="${curso.imagem}" alt="${curso.titulo}">
        <div class="curso-info">
          <h3>${curso.titulo}</h3>
          <p>${curso.descricao}</p>
          <a href="${curso.link}" class="curso-btn">Ver curso</a>
        </div>
      `;
      grid.insertBefore(card, grid.querySelector('.add-card'));
    });
  }
  
  document.addEventListener('DOMContentLoaded', renderizarCursos);