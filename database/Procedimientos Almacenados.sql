USE senatimat;

DELIMITER $$
CREATE PROCEDURE spu_estudiantes_listar()
BEGIN
	SELECT	EST.idestudiante,
				EST.apellidos, EST.nombres,
				EST.tipodocumento, EST.nrodocumento,
				EST.fechanacimiento,
				ESC.escuela,
				CAR.carrera,
				SED.sede,
				EST.fotografia
		FROM estudiantes EST
		INNER JOIN carreras CAR ON CAR.idcarrera = EST.idcarrera
		INNER JOIN sedes SED ON SED.idsede = EST.idsede
		INNER JOIN escuelas ESC ON ESC.idescuela = CAR.idescuela
		WHERE EST.estado = '1';
END $$

CALL spu_estudiantes_listar();

DELIMITER $$
CREATE PROCEDURE spu_estudiantes_registrar
(
	IN _apellidos 			VARCHAR(40),
	IN _nombres 			VARCHAR(40),
	IN _tipodocumento		CHAR(1),
	IN _nrodocumento		CHAR(8),
	IN _fechanacimiento	DATE,
	IN _idcarrera 			INT,
	IN _idsede 				INT,
	IN _fotografia 		VARCHAR(100)
)
BEGIN
	-- Validar el contenido de fotografía (CAMPO NULL)
	IF _fotografia = '' THEN 
		SET _fotografia = NULL;
	END IF;
	
	INSERT INTO estudiantes 
	(apellidos, nombres, tipodocumento, nrodocumento, fechanacimiento, idcarrera, idsede, fotografia) VALUES
	(_apellidos, _nombres, _tipodocumento, _nrodocumento, _fechanacimiento, _idcarrera, _idsede, _fotografia);
END $$

CALL spu_estudiantes_registrar('Francia Minaya', 'Jhon', 'D', '12345678', '1984-09-20', 5, 1, '');
CALL spu_estudiantes_registrar('Munayco', 'José', 'D', '77779999', '1999-09-20', 3, 2, NULL);
CALL spu_estudiantes_registrar('Prada', 'Teresa', 'C', '01234567', '2002-09-25', 3, 2, '');
SELECT * FROM estudiantes;

DELIMITER $$
CREATE PROCEDURE spu_obtener_fotografias (IN idestudiante_ INT)
BEGIN
  SELECT fotografia FROM estudiantes WHERE idestudiante = idestudiante_;
END 
$$CALL spu_obtener_fotografias(1);

DELIMITER $$
CREATE PROCEDURE spu_sedes_listar()
BEGIN
	SELECT * FROM sedes ORDER BY 2;
END $$

DELIMITER $$
CREATE PROCEDURE spu_escuelas_listar()
BEGIN 
	SELECT * FROM escuelas ORDER BY 2;
END $$

DELIMITER $$
CREATE PROCEDURE spu_carreras_listar(IN _idescuela INT)
BEGIN
	SELECT idcarrera, carrera 
		FROM carreras
		WHERE idescuela = _idescuela;
END $$

CALL spu_carreras_listar(3);


DELIMITER $$
CREATE PROCEDURE spu_estudiantes_eliminar(IN idestudiante_ INT)
BEGIN
	DELETE FROM estudiantes WHERE idestudiante = idestudiante_;
END $$
CALL spu_estudiantes_eliminar(11);

-- ///////////////////////////////////////////////////////////////////////////////////
-- COLABORADORES
-- LISTAR
DELIMITER $$
CREATE PROCEDURE spu_colaboradores_listar()
BEGIN
	SELECT 	COL.idcolaborador,
				COL.apellidos, COL.nombres,
				CARG.cargo,
				SED.sede,
				COL.telefono,
				COL.direccion,
				COL.tipocontrato, 
				COL.cv
	FROM colaboradores COL
	INNER JOIN cargos CARG ON CARG.idcargo = COL.idcargo
	INNER JOIN sedes SED  ON SED.idsede = COL.idsede
	WHERE COL.estado = '1';				
END$$
CALL spu_colaboradores_listar();

-- REGISTRAR
DELIMITER $$
CREATE PROCEDURE spu_colaboradores_registrar(
	IN apellidos_ 				VARCHAR(40),
	IN nombres_ 				VARCHAR(40),
	IN idcargo_				INT,
	IN idsede_ 				INT,
	IN telefono_ 				CHAR(9),
	IN direccion_				VARCHAR(40),
	IN tipocontrato_			CHAR(1),
	IN cv_ 					VARCHAR(100)
)
BEGIN
	-- VALIDACION DEL CONTENIDO CV (COMO CAMPO NULL)
	IF cv_ = '' THEN
		SET cv_ = NULL;
	END IF;
		
	INSERT INTO colaboradores
	(apellidos, nombres, idcargo, idsede, telefono, direccion, tipocontrato, cv) VALUES
	(apellidos_, nombres_, idcargo_, idsede_, telefono_, direccion_, tipocontrato_, cv_);
END $$

CALL spu_colaboradores_registrar('Salvatierra', 'Alejandro',1,3,'956473572','Calle San Alejandro','P','');
CALL spu_colaboradores_registrar('Quispe', 'Andres',2,4,'986362540', 'Av. Tupac Amaru','C','');
CALL spu_colaboradores_registrar('Munayco', 'Alosno',4,4,'985647322', 'Av. Lomas','P','');   
SELECT * FROM colaboradores;

DELIMITER $$
CREATE PROCEDURE spu_cargos_listar()
BEGIN
	SELECT * FROM cargos ORDER BY 2;
END $$
CALL spu_cargos_listar();


DELIMITER $$
CREATE PROCEDURE spu_colaboradores_eliminar(IN idcolaborador_ INT)
BEGIN
	DELETE FROM colaboradores WHERE idcolaborador = idcolaborador_;
END $$
CALL spu_colaboradores_eliminar();
SELECT * FROM colaboradores;


DELIMITER $$
CREATE PROCEDURE spu_obtener_cv (IN idcolaborador_ INT)
BEGIN
  SELECT cv FROM colaboradores WHERE idcolaborador = idcolaborador_;
END $$CALL spu_obtener_cv(1);

-- -----------------------------------------------------------------------
-- LOGIN
/*DELIMITER $$
CREATE PROCEDURE spu_usuarios_login(IN _nombre_de_usuario VARCHAR(30))
BEGIN
	SELECT 	idusuario, nombre_de_usuario, contraseña
	
	FROM usuarios
	WHERE nombre_de_usuario = _nombre_de_usuario;
END $$

CALL spu_usuarios_login('emer25');
SELECT * FROM usuarios;*/

DELIMITER $$
CREATE PROCEDURE spu_usuarios_login(IN _nombreusuario VARCHAR(30))
BEGIN
	SELECT 	idusuario, nombreusuario, claveacceso,
				apellidos, nombres, nivelacceso
	FROM usuarios
	WHERE nombreusuario = _nombreusuario AND estado = '1';
END $$

CALL spu_usuarios_login('emer25');

