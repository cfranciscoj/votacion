CREATE TABLE vto_candidatos(id_candidato     bigint NOT NULL auto_increment PRIMARY KEY,
                            nombre_candidato varchar(100) NOT NULL,
                            usr_creacion     varchar(100) NOT NULL,
                            fch_creacion     timestamp DEFAULT CURRENT_TIMESTAMP,
                            usr_modificacion varchar(100),
                            fch_modificacion timestamp);
                            
                            
CREATE TRIGGER creado_por_vto_candidatos_tr 
BEFORE INSERT ON vto_candidatos 
FOR EACH ROW 
SET NEW.usr_creacion = CURRENT_USER();

CREATE TRIGGER actualizado_por_vto_candidatos_tr 
BEFORE UPDATE ON vto_candidatos 
FOR EACH ROW 
SET NEW.usr_modificacion = CURRENT_USER(),
    NEW.fch_modificacion = CURRENT_TIMESTAMP;   


--vto_votos

CREATE TABLE vto_votos(id_voto          bigint NOT NULL auto_increment PRIMARY KEY,
                       id_candidato     bigint NOT NULL,
                       usr_creacion     varchar(100) NOT NULL,
                       fch_creacion     timestamp DEFAULT CURRENT_TIMESTAMP,
                       usr_modificacion varchar(100),
                       fch_modificacion timestamp);
					   
CREATE TRIGGER creado_por_vto_votos_tr 
BEFORE INSERT ON vto_votos 
FOR EACH ROW 
SET NEW.usr_creacion = CURRENT_USER();

CREATE TRIGGER actualizado_por_vto_votos_tr 
BEFORE UPDATE ON vto_votos 
FOR EACH ROW 
SET NEW.usr_modificacion = CURRENT_USER(),
    NEW.fch_modificacion = CURRENT_TIMESTAMP;  
	
	
	
	
--vto_votados
CREATE TABLE vto_votados(id_votado        bigint NOT NULL auto_increment PRIMARY KEY,
                         id_usuario       bigint NOT NULL,
						 email            varchar(191),
                         usr_creacion     varchar(100) NOT NULL,
                         fch_creacion     timestamp DEFAULT CURRENT_TIMESTAMP,
                         usr_modificacion varchar(100),
                         fch_modificacion timestamp);
					   
CREATE TRIGGER creado_por_vto_votados_tr 
BEFORE INSERT ON vto_votados 
FOR EACH ROW 
SET NEW.usr_creacion = CURRENT_USER();

CREATE TRIGGER actualizado_por_vto_votados_tr 
BEFORE UPDATE ON vto_votados 
FOR EACH ROW 
SET NEW.usr_modificacion = CURRENT_USER(),
    NEW.fch_modificacion = CURRENT_TIMESTAMP;  	