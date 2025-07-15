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