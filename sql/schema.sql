CREATE DATABASE sys_adverse_events;

USE sys_adverse_events;

CREATE TABLE adverse_events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo_evento VARCHAR(255) NOT NULL,
    nome_paciente VARCHAR(255) NOT NULL,
    sexo ENUM('Masculino', 'Feminino', 'Outro') NOT NULL,
    leito VARCHAR(255) NOT NULL,
    idade INT NOT NULL,
    tipo_incidente ENUM(
        'Near miss/Quase erro', 
        'Incidente sem danos', 
        'Evento Adverso Leve', 
        'Evento Adverso Moderado', 
        'Evento Adverso Grave', 
        'Evento Adverso com Óbito'
    ) NOT NULL,
    tipo_evento ENUM(
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
    analise_causa TEXT NOT NULL,
    plano_acao TEXT NOT NULL,
    responsaveis TEXT NOT NULL,
    prazo DATE NOT NULL
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);