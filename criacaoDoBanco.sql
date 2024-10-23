-- Criação do banco de dados
CREATE DATABASE SistemaEscolar;

-- Selecionar o banco de dados recém-criado
USE SistemaEscolar;

-- Criação da tabela Alunos
CREATE TABLE Alunos (
    id_aluno INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    data_nascimento DATE NOT NULL,
    endereco VARCHAR(255),
    telefone VARCHAR(15),
    email VARCHAR(100) UNIQUE
);

-- Criação da tabela Cursos
CREATE TABLE Cursos (
    id_curso INT AUTO_INCREMENT PRIMARY KEY,
    nome_curso VARCHAR(100) NOT NULL,
    duracao INT NOT NULL COMMENT 'Duração em meses',
    descricao TEXT
);

-- Criação da tabela Professores
CREATE TABLE Professores (
    id_professor INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    especialidade VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    telefone VARCHAR(15)
);

-- Criação da tabela Matriculas
CREATE TABLE Matriculas (
    id_matricula INT AUTO_INCREMENT PRIMARY KEY,
    id_aluno INT NOT NULL,
    id_curso INT NOT NULL,
    data_matricula DATE NOT NULL,
    FOREIGN KEY (id_aluno) REFERENCES Alunos(id_aluno),
    FOREIGN KEY (id_curso) REFERENCES Cursos(id_curso)
);

-- Criação da tabela Aulas
CREATE TABLE Aulas (
    id_aula INT AUTO_INCREMENT PRIMARY KEY,
    id_curso INT NOT NULL,
    id_professor INT NOT NULL,
    data_aula DATE NOT NULL,
    conteudo TEXT,
    FOREIGN KEY (id_curso) REFERENCES Cursos(id_curso),
    FOREIGN KEY (id_professor) REFERENCES Professores(id_professor)
);
