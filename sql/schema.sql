CREATE DATABASE sys_adverse_events;

USE sys_adverse_events;

CREATE TABLE adverse_events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo_evento VARCHAR(255) NOT NULL,
    nome VARCHAR(100),
    nome_paciente VARCHAR(100) NOT NULL,
    sexo ENUM('Masculino', 'Feminino') NOT NULL,
    leito VARCHAR(10) NOT NULL,
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
    local_evento VARCHAR(100) NOT NULL,
    horario_evento TIME NOT NULL,
    descricao_evento TEXT NOT NULL,
    como_detectado ENUM(
        'Auditoria OPME', 
        'Contato com paciente', 
        'Gerenciamento de entregas e demandas', 
        'Prontuário do paciente', 
        'Outro'
    ) NOT NULL,
    acao_imediata TEXT NOT NULL
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(255) NOT NULL
);
