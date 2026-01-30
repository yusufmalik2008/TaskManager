-- =====================================================
-- 🚀 TASKMANAGER ENTERPRISE DATABASE INITIALIZER
-- XAMPP MariaDB Setup Script for CodeIgniter 4
-- Copy-paste into XAMPP MySQL Shell or phpMyAdmin
-- =====================================================

-- 🎯 STEP 1: CREATE FRESH DATABASE
DROP DATABASE IF EXISTS taskmanager;
CREATE DATABASE taskmanager CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE taskmanager;

-- =====================================================
-- ✅ TABLE: tasks (ENCRYPTION + AUDIT READY)
-- =====================================================
CREATE TABLE tasks (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,                    -- ← ENCRYPTED descriptions stored here!
    STATUS ENUM('pending','in_progress','completed') DEFAULT 'pending',
    priority ENUM('low','medium','high') DEFAULT 'medium',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    created_by VARCHAR(100) DEFAULT 'system',
    updated_by VARCHAR(100) DEFAULT 'system',
    deleted_at TIMESTAMP NULL,           -- Soft delete support
    project_id INT NULL,
    
    -- 🚀 PERFORMANCE INDEXES
    INDEX idx_status_priority (STATUS, priority),
    INDEX idx_project_created (project_id, created_at),
    INDEX idx_deleted (deleted_at)
) ENGINE=InnoDB;

-- =====================================================
-- ✅ TABLE: projects
-- =====================================================
CREATE TABLE projects (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_by VARCHAR(100) DEFAULT 'system',
    status ENUM('active','inactive','archived') DEFAULT 'active',
    
    INDEX idx_status_created (status, created_at)
) ENGINE=InnoDB;

-- =====================================================
-- 📊 MONITORING VIEWS (Enterprise Dashboard)
-- =====================================================
CREATE VIEW task_health AS
SELECT 
    STATUS as status,
    priority,
    COUNT(*) as count,
    AVG(DATEDIFF(NOW(), created_at)) as avg_age_days,
    MIN(created_at) as oldest_task,
    MAX(created_at) as newest_task
FROM tasks 
WHERE deleted_at IS NULL
GROUP BY STATUS, priority;

CREATE VIEW project_stats AS
SELECT 
    status,
    COUNT(*) as count,
    MIN(created_at) as oldest_project,
    MAX(created_at) as newest_project
FROM projects 
GROUP BY status;

-- =====================================================
-- 🧹 CLEANUP TRIGGERS (Auto-maintenance)
-- =====================================================
DELIMITER //
CREATE TRIGGER tasks_cleanup_audit 
BEFORE UPDATE ON tasks
FOR EACH ROW
BEGIN
    IF OLD.deleted_at IS NULL AND NEW.deleted_at IS NOT NULL THEN
        SET NEW.updated_by = 'system (soft-delete)';
    ELSE
        SET NEW.updated_by = 'system';
    END IF;
END//

CREATE TRIGGER tasks_prevent_hard_delete 
BEFORE DELETE ON tasks
FOR EACH ROW
BEGIN
    UPDATE tasks 
    SET deleted_at = NOW(), updated_by = 'system (soft-delete)' 
    WHERE id = OLD.id;
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Use soft delete instead';
END//
DELIMITER ;

-- =====================================================
-- 🧪 SAMPLE DATA (For testing encryption)
-- =====================================================
INSERT INTO projects (name, description, created_by) VALUES
('Website Redesign', 'Complete UI/UX overhaul with TailwindCSS', 'Setiadi'),
('API Development', 'RESTful API with CodeIgniter 4', 'Setiadi'),
('Database Migration', 'MariaDB optimization + indexing', 'Setiadi');

INSERT INTO tasks (title, description, status, priority, project_id, created_by) VALUES
('Design homepage layout', 'Create Figma prototype - mobile first approach', 'pending', 'high', 1, 'Setiadi'),
('Setup authentication routes', 'Implement JWT or session-based auth', 'in_progress', 'high', 2, 'Setiadi'),
('Create database backup script', 'Automated daily backups to S3/Google Drive', 'pending', 'medium', 3, 'Setiadi'),
('Write unit tests', 'Test encryption/decryption + CRUD operations', 'pending', 'medium', 2, 'Setiadi');

-- =====================================================
-- ✅ VERIFICATION QUERIES
-- =====================================================
-- Run these to verify everything works:
-- SELECT * FROM tasks LIMIT 3;
-- SELECT * FROM task_health;
-- SELECT * FROM project_stats;
-- SHOW TABLES;
-- DESCRIBE tasks;

-- 🎉 SUCCESS MESSAGE
SELECT '🚀 TASKMANAGER DATABASE INITIALIZED SUCCESSFULLY!' as status;
SELECT COUNT(*) as total_tables FROM information_schema.tables 
WHERE table_schema = 'taskmanager';
