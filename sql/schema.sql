CREATE DATABASE sistema_eventos_adversos;

USE sistema_eventos_adversos;

CREATE TABLE eventos_adversos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    codigo_evento VARCHAR(255) NOT NULL,
    nome_paciente VARCHAR(255) NOT NULL,
    sexo ENUM('Masculino', 'Feminino', 'Outro') NOT NULL,
    leito VARCHAR(255) NOT NULL,
    idade INT NOT NULL,
    tipo_incidente ENUM(
        'Associados à produto de saúde', 
        'Relacionado à cadeia medicamentosa', 
        'Broricoaspiração', 
        'Relacionados ao ato cirúrgico', 
        'Falha no cuidado', 
        'TEV-Tromboembolismo venoso', 
        'Infecção do sitio cirúrgico', 
        'Queda', 
        'Outro'
    ) NOT NULL,
    data_evento DATE NOT NULL,
    local_evento VARCHAR(255) NOT NULL,
    horario_evento TIME NOT NULL,
    descricao_evento TEXT NOT NULL,
    como_detectado ENUM(
        'Auditoria OPME', 
        'Contato com paciente', 
        'Gerenciamento de entregas e demandas', 
        'Prontuário do paciente', 
        'Outro'
    ) NOT NULL,
    acao_imediata TEXT NOT NULL,
    responsaveis TEXT NOT NULL
);

CREATE TABLE administradores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);
