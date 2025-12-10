-- Update user roles to include new roles
ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'guru_bk', 'wali_kelas', 'guru', 'orang_tua', 'siswa', 'kepala_sekolah');

-- Insert new users with additional roles
INSERT INTO users (name, username, email, password, role, created_at, updated_at) VALUES
('Kepala Sekolah', 'kepsek', 'kepsek@sitib.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'kepala_sekolah', NOW(), NOW()),
('Orang Tua Siswa', 'ortu', 'ortu@sitib.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'orang_tua', NOW(), NOW()),
('Ahmad Rizki Pratama', 'siswa001', 'siswa001@sitib.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'siswa', NOW(), NOW());