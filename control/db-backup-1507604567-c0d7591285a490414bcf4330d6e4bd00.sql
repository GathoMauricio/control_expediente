DROP TABLE IF EXISTS usuario;

CREATE TABLE `usuario` (
  `id_usuario` bigint(255) NOT NULL AUTO_INCREMENT,
  `tipo_usu` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `nom_usu` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `con_usu` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `curp` text COLLATE utf8mb4_spanish_ci,
  `nombre_usu` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `ape_pat` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `ape_mat` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `prof` text COLLATE utf8mb4_spanish_ci,
  `sex` text COLLATE utf8mb4_spanish_ci,
  `cedula_p` text COLLATE utf8mb4_spanish_ci,
  `matricula` text COLLATE utf8mb4_spanish_ci,
  `fecha_naci` date DEFAULT NULL,
  `cedula_esp` text COLLATE utf8mb4_spanish_ci,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO usuario VALUES("11","Doctor","doctor","doctor","","TESTE","KDKDJ","JDJFJ","","","","","","");



DROP TABLE IF EXISTS paciente;

CREATE TABLE `paciente` (
  `id_paciente` bigint(255) NOT NULL AUTO_INCREMENT,
  `fecha_reg` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `nombre_paci` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `paterno_paci` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `materno_paci` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `sex_paci` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `naci_paci` date DEFAULT NULL,
  `edad_paci` text COLLATE utf8mb4_spanish_ci,
  `lugar_paci` text COLLATE utf8mb4_spanish_ci,
  `rfc_paci` text COLLATE utf8mb4_spanish_ci,
  `curp_paci` text COLLATE utf8mb4_spanish_ci,
  `titular` text COLLATE utf8mb4_spanish_ci,
  `tel_cel` text COLLATE utf8mb4_spanish_ci,
  `tel_cas` text COLLATE utf8mb4_spanish_ci,
  `tel_ofi` text COLLATE utf8mb4_spanish_ci,
  `tel_otro` text COLLATE utf8mb4_spanish_ci,
  `calle` text COLLATE utf8mb4_spanish_ci,
  `no_ext` text COLLATE utf8mb4_spanish_ci,
  `no_int` text COLLATE utf8mb4_spanish_ci,
  `col` text COLLATE utf8mb4_spanish_ci,
  `mun` text COLLATE utf8mb4_spanish_ci,
  `edo_dir` text COLLATE utf8mb4_spanish_ci,
  `esco` text COLLATE utf8mb4_spanish_ci,
  `ocupa` text COLLATE utf8mb4_spanish_ci,
  `edo_civ` text COLLATE utf8mb4_spanish_ci,
  `comenta` text COLLATE utf8mb4_spanish_ci,
  `reli` text COLLATE utf8mb4_spanish_ci,
  `conocio` text COLLATE utf8mb4_spanish_ci,
  `correo` text COLLATE utf8mb4_spanish_ci,
  `nom_pad` text COLLATE utf8mb4_spanish_ci,
  `ocu_pad` text COLLATE utf8mb4_spanish_ci,
  `edad_pad` text COLLATE utf8mb4_spanish_ci,
  `tel_pad` text COLLATE utf8mb4_spanish_ci,
  `nom_mad` text COLLATE utf8mb4_spanish_ci,
  `ocu_mad` text COLLATE utf8mb4_spanish_ci,
  `edad_mad` text COLLATE utf8mb4_spanish_ci,
  `tel_mad` text COLLATE utf8mb4_spanish_ci,
  `nom_cony` text COLLATE utf8mb4_spanish_ci,
  `ocu_cony` text COLLATE utf8mb4_spanish_ci,
  `edad_cony` text COLLATE utf8mb4_spanish_ci,
  `tel_cony` text COLLATE utf8mb4_spanish_ci,
  `det_hero` text COLLATE utf8mb4_spanish_ci,
  `det_hera` text COLLATE utf8mb4_spanish_ci,
  `det_hijo` text COLLATE utf8mb4_spanish_ci,
  `det_hija` text COLLATE utf8mb4_spanish_ci,
  `alergia` text COLLATE utf8mb4_spanish_ci,
  `sangre` text COLLATE utf8mb4_spanish_ci,
  `nom_cont` text COLLATE utf8mb4_spanish_ci,
  `dir_cont` text COLLATE utf8mb4_spanish_ci,
  `par_cont` text COLLATE utf8mb4_spanish_ci,
  `tel_cont` text COLLATE utf8mb4_spanish_ci,
  `com_cont` text COLLATE utf8mb4_spanish_ci,
  `pase_id` text COLLATE utf8mb4_spanish_ci,
  `pase_tot` text COLLATE utf8mb4_spanish_ci,
  `part_a` text COLLATE utf8mb4_spanish_ci,
  `part_b` text COLLATE utf8mb4_spanish_ci,
  `part_c` text COLLATE utf8mb4_spanish_ci,
  `altec` text COLLATE utf8mb4_spanish_ci,
  `altes` text COLLATE utf8mb4_spanish_ci,
  `axa_sant` text COLLATE utf8mb4_spanish_ci,
  `axa_condu` text COLLATE utf8mb4_spanish_ci,
  `banor` text COLLATE utf8mb4_spanish_ci,
  `banse` text COLLATE utf8mb4_spanish_ci,
  `bnci` text COLLATE utf8mb4_spanish_ci,
  `emp` text COLLATE utf8mb4_spanish_ci,
  `gpo_med` text COLLATE utf8mb4_spanish_ci,
  `gpo_med_doc` text COLLATE utf8mb4_spanish_ci,
  `gpo_med_pro` text COLLATE utf8mb4_spanish_ci,
  `gpo_med_alm` text COLLATE utf8mb4_spanish_ci,
  `inse` text COLLATE utf8mb4_spanish_ci,
  `s_inves_cob` text COLLATE utf8mb4_spanish_ci,
  `s_inves_no_cob` text COLLATE utf8mb4_spanish_ci,
  `serfin` text COLLATE utf8mb4_spanish_ci,
  `tepe` text COLLATE utf8mb4_spanish_ci,
  `vita_afo` text COLLATE utf8mb4_spanish_ci,
  `vita_bancom_ope` text COLLATE utf8mb4_spanish_ci,
  `vita_banam` text COLLATE utf8mb4_spanish_ci,
  `vita_bancom_san` text COLLATE utf8mb4_spanish_ci,
  `vita_memb` text COLLATE utf8mb4_spanish_ci,
  `zurich` text COLLATE utf8mb4_spanish_ci,
  `d_a1` text COLLATE utf8mb4_spanish_ci,
  `d_b2` text COLLATE utf8mb4_spanish_ci,
  `d_c3` text COLLATE utf8mb4_spanish_ci,
  `d_d4` text COLLATE utf8mb4_spanish_ci,
  `d_e5` text COLLATE utf8mb4_spanish_ci,
  `d_f6` text COLLATE utf8mb4_spanish_ci,
  `d_g7` text COLLATE utf8mb4_spanish_ci,
  `d_h8` text COLLATE utf8mb4_spanish_ci,
  `d_i9` text COLLATE utf8mb4_spanish_ci,
  `d_j10` text COLLATE utf8mb4_spanish_ci,
  `d_k11` text COLLATE utf8mb4_spanish_ci,
  `d_l12` text COLLATE utf8mb4_spanish_ci,
  `d_m13` text COLLATE utf8mb4_spanish_ci,
  `d_n14` text COLLATE utf8mb4_spanish_ci,
  `d_o15` text COLLATE utf8mb4_spanish_ci,
  `d_p16` text COLLATE utf8mb4_spanish_ci,
  `d_q17` text COLLATE utf8mb4_spanish_ci,
  `d_r18` text COLLATE utf8mb4_spanish_ci,
  `d_s19` text COLLATE utf8mb4_spanish_ci,
  `d_t20` text COLLATE utf8mb4_spanish_ci,
  `d_u21` text COLLATE utf8mb4_spanish_ci,
  `d_v22` text COLLATE utf8mb4_spanish_ci,
  `d_x23` text COLLATE utf8mb4_spanish_ci,
  `d_y24` text COLLATE utf8mb4_spanish_ci,
  `d_z25` text COLLATE utf8mb4_spanish_ci,
  `d_a26` text COLLATE utf8mb4_spanish_ci,
  `d_b27` text COLLATE utf8mb4_spanish_ci,
  `d_c28` text COLLATE utf8mb4_spanish_ci,
  `edo_exp` text COLLATE utf8mb4_spanish_ci,
  `ref_exp` text COLLATE utf8mb4_spanish_ci,
  `hc_peso` text COLLATE utf8mb4_spanish_ci,
  `hc_talla` text COLLATE utf8mb4_spanish_ci,
  `hc_ta` text COLLATE utf8mb4_spanish_ci,
  `hc_fc` text COLLATE utf8mb4_spanish_ci,
  `hc_fr` text COLLATE utf8mb4_spanish_ci,
  `hc_tem` text COLLATE utf8mb4_spanish_ci,
  `hc_fum` text COLLATE utf8mb4_spanish_ci,
  `hc_ant_fam` text COLLATE utf8mb4_spanish_ci,
  `hc_ant_per_no_p` text COLLATE utf8mb4_spanish_ci,
  `hc_ant_per_p` text COLLATE utf8mb4_spanish_ci,
  `hc_pad` text COLLATE utf8mb4_spanish_ci,
  `hc_exp_fis` text COLLATE utf8mb4_spanish_ci,
  `hc_otros` text COLLATE utf8mb4_spanish_ci,
  `hc_rx` text COLLATE utf8mb4_spanish_ci,
  `hc_dx` text COLLATE utf8mb4_spanish_ci,
  `hc_tx` text COLLATE utf8mb4_spanish_ci,
  PRIMARY KEY (`id_paciente`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO paciente VALUES("5","2017-10-09","KAREN ANAHí","AGUILAR","VENTURA","M","1996-11-23","20","Ciudad de México","","AUVK961123MDFGNR04","","","","","","","","","","","--Seleccione un estado--","","","Casado/a.","","Anglicana","","","","","","","","","","","","","","","","","","","","","","","","","","VIP_194344","10000","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","Activo","","","","","","","","","","","","","","","","","dsf");
INSERT INTO paciente VALUES("6","2017-10-09","MAURICIO","JUAREZ","SORIANO","H","1999-02-03","18","--Seleccione un estado--","DHF99020337A","DHF9902033HOMO","","","","","","","","","","","--Seleccione un estado--","","","Casado/a.","","Anglicana","","","","","","","","","","","","","","","","","","","","","","","","","","VIP_195352","10000","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","Activo","","","","","","","","","","","","","","","","","");



DROP TABLE IF EXISTS consulta;

CREATE TABLE `consulta` (
  `id_consulta` bigint(255) NOT NULL AUTO_INCREMENT,
  `id_paciente` bigint(255) NOT NULL,
  `fecha_cons` date NOT NULL,
  `no_cons` int(11) NOT NULL,
  `edad_cons` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `pase_cons` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `fum_cons` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `no_evo` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `desc_evo` text COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id_consulta`),
  KEY `fk_paciente_consulta` (`id_paciente`),
  CONSTRAINT `fk_paciente_consulta` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id_paciente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO consulta VALUES("2","5","2017-10-09","1","20","VIP_194344","","","");



DROP TABLE IF EXISTS archivo;

CREATE TABLE `archivo` (
  `id_archivo` bigint(255) NOT NULL AUTO_INCREMENT,
  `id_paciente` bigint(255) NOT NULL,
  `fecha_arc` date NOT NULL,
  `nom_arc` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `tipo_arc` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `ubi_arc` text COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id_archivo`),
  KEY `fk_paciente_archivo` (`id_paciente`),
  CONSTRAINT `fk_paciente_archivo` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id_paciente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;




DROP TABLE IF EXISTS religion;

CREATE TABLE `religion` (
  `id_religion` int(11) NOT NULL AUTO_INCREMENT,
  `religion` text NOT NULL,
  PRIMARY KEY (`id_religion`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

INSERT INTO religion VALUES("1","Católica");
INSERT INTO religion VALUES("2","Apóstolica");
INSERT INTO religion VALUES("3","Romana");
INSERT INTO religion VALUES("4","Pentecosté");
INSERT INTO religion VALUES("5","Bautista");
INSERT INTO religion VALUES("6","Presbiteriana");
INSERT INTO religion VALUES("7","Espiritualista");
INSERT INTO religion VALUES("8","Ortodoxa");
INSERT INTO religion VALUES("9","Luteriano");
INSERT INTO religion VALUES("10","Judia");
INSERT INTO religion VALUES("11","Budista");
INSERT INTO religion VALUES("12","Metodista");
INSERT INTO religion VALUES("13","Luz del mundo");
INSERT INTO religion VALUES("14","Cristiana");
INSERT INTO religion VALUES("15","Nuevas expresiones");
INSERT INTO religion VALUES("16","Hindú");
INSERT INTO religion VALUES("17","Islámica");
INSERT INTO religion VALUES("18","Anglicana");
INSERT INTO religion VALUES("19","Mormones");
INSERT INTO religion VALUES("20","Ejercito de salvación");



DROP TABLE IF EXISTS edo_civil;

CREATE TABLE `edo_civil` (
  `id_edo_civil` int(11) NOT NULL AUTO_INCREMENT,
  `edo_civil` text NOT NULL,
  PRIMARY KEY (`id_edo_civil`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO edo_civil VALUES("1","Soltero/a.");
INSERT INTO edo_civil VALUES("2","Comprometido/a.");
INSERT INTO edo_civil VALUES("3","Casado/a.");
INSERT INTO edo_civil VALUES("4","Divorciado/a.");
INSERT INTO edo_civil VALUES("5","Viudo/a.");



