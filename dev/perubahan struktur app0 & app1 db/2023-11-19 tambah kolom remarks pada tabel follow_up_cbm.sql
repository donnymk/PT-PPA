-- Tambah kolom 'remarks' pada tabel resume_follow_up_cbm
ALTER TABLE `resume_follow_up_cbm` 
ADD COLUMN `remarks` VARCHAR(255) NULL DEFAULT NULL AFTER `input_timestamp`;