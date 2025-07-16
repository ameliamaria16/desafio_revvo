-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS desafio_revvo CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE desafio_revvo;

-- Tabela de cursos
CREATE TABLE cursos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descricao TEXT,
    imagem VARCHAR(255),
    preco DECIMAL(10,2) DEFAULT 0.00,
    duracao VARCHAR(100),
    categoria VARCHAR(100),
    status ENUM('ativo', 'inativo') DEFAULT 'ativo',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabela do slideshow
CREATE TABLE slideshow (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descricao TEXT,
    imagem VARCHAR(255) NOT NULL,
    link_botao VARCHAR(255),
    texto_botao VARCHAR(100) DEFAULT 'Saiba Mais',
    ordem INT DEFAULT 0,
    status ENUM('ativo', 'inativo') DEFAULT 'ativo',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Inserir dados de exemplo para cursos
INSERT INTO cursos (titulo, descricao, imagem, preco, duracao, categoria) VALUES
('Desenvolvimento Web Full Stack', 'Aprenda a desenvolver aplicações web completas com as tecnologias mais modernas do mercado.', 'curso-web.jpg', 299.90, '40 horas', 'Programação'),
('Marketing Digital', 'Domine as estratégias de marketing digital e aumente suas vendas online.', 'curso-marketing.jpg', 199.90, '30 horas', 'Marketing'),
('Design Gráfico', 'Crie designs profissionais e aprenda a usar as principais ferramentas do mercado.', 'curso-design.jpg', 249.90, '35 horas', 'Design'),
('Gestão de Projetos', 'Aprenda a gerenciar projetos de forma eficiente e profissional.', 'curso-gestao.jpg', 179.90, '25 horas', 'Gestão');

-- Inserir dados de exemplo para slideshow
INSERT INTO slideshow (titulo, descricao, imagem, link_botao, texto_botao, ordem) VALUES
('Bem-vindo à Revvo', 'Descubra uma nova forma de aprender com nossos cursos online de qualidade.', 'slide1.jpg', '/cursos', 'Ver Cursos', 1),
('Cursos em Destaque', 'Conheça nossos cursos mais populares e comece sua jornada de aprendizado hoje.', 'slide2.jpg', '/destaques', 'Ver Destaques', 2),
('Método Exclusivo', 'Nossa metodologia única garante que você aprenda de forma eficiente e prática.', 'slide3.jpg', '/metodologia', 'Conhecer Método', 3); 