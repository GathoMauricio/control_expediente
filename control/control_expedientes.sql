

CREATE TABLE `archivo` (
  `id_archivo` bigint(255) NOT NULL,
  `id_paciente` bigint(255) NOT NULL,
  `nom_arc` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `tipo_arc` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `ubi_arc` text COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;



CREATE TABLE `consulta` (
  `id_consulta` bigint(255) NOT NULL,
  `id_paciente` bigint(255) NOT NULL,
  `fecha_cons` date NOT NULL,
  `edad_cons` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `pase_cons` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `fum_cons` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `no_evo` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `desc_evo` text COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;



CREATE TABLE `paciente` (
  `id_paciente` bigint(255) NOT NULL,
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
  `num_mad` text COLLATE utf8mb4_spanish_ci,
  `ocu_mad` text COLLATE utf8mb4_spanish_ci,
  `edad_mad` text COLLATE utf8mb4_spanish_ci,
  `tel_mad` text COLLATE utf8mb4_spanish_ci,
  `num_cony` text COLLATE utf8mb4_spanish_ci,
  `ocu_cony` text COLLATE utf8mb4_spanish_ci,
  `edad_coy` text COLLATE utf8mb4_spanish_ci,
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
  `s_conves_no_cob` text COLLATE utf8mb4_spanish_ci,
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
  `hc_per_p` text COLLATE utf8mb4_spanish_ci,
  `hc_pad` text COLLATE utf8mb4_spanish_ci,
  `hc_exp_fis` text COLLATE utf8mb4_spanish_ci,
  `hc_otros` text COLLATE utf8mb4_spanish_ci,
  `hc_rx` text COLLATE utf8mb4_spanish_ci,
  `hc_dx` text COLLATE utf8mb4_spanish_ci,
  `hc_tx` text COLLATE utf8mb4_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;


CREATE TABLE `usuario` (
  `id_usuario` bigint(255) NOT NULL,
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
  `cedula_esp` text COLLATE utf8mb4_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

ALTER TABLE `archivo`
  ADD PRIMARY KEY (`id_archivo`),
  ADD KEY `fk_paciente_archivo` (`id_paciente`);

ALTER TABLE `consulta`
  ADD PRIMARY KEY (`id_consulta`),
  ADD KEY `fk_paciente_consulta` (`id_paciente`);

ALTER TABLE `paciente`
  ADD PRIMARY KEY (`id_paciente`);

ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

ALTER TABLE `archivo`
  MODIFY `id_archivo` bigint(255) NOT NULL AUTO_INCREMENT;

ALTER TABLE `consulta`
  MODIFY `id_consulta` bigint(255) NOT NULL AUTO_INCREMENT;

ALTER TABLE `paciente`
  MODIFY `id_paciente` bigint(255) NOT NULL AUTO_INCREMENT;

ALTER TABLE `usuario`
  MODIFY `id_usuario` bigint(255) NOT NULL AUTO_INCREMENT;

ALTER TABLE `archivo`
  ADD CONSTRAINT `fk_paciente_archivo` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id_paciente`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `consulta`
  ADD CONSTRAINT `fk_paciente_consulta` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id_paciente`) ON DELETE CASCADE ON UPDATE CASCADE;

