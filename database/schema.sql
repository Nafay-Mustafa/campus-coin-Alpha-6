-- Campus Coin database schema summary
CREATE TABLE users (
 id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
 name VARCHAR(255) NOT NULL,
 email VARCHAR(255) UNIQUE NOT NULL,
 email_verified_at TIMESTAMP NULL,
 password VARCHAR(255) NOT NULL,
 academic_year VARCHAR(100) NULL,
 monthly_allowance DECIMAL(12,2) DEFAULT 0,
 saving_goal DECIMAL(12,2) DEFAULT 0,
 is_admin BOOLEAN DEFAULT FALSE,
 remember_token VARCHAR(100) NULL,
 created_at TIMESTAMP NULL,
 updated_at TIMESTAMP NULL
);

CREATE TABLE categories (
 id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
 name VARCHAR(255) NOT NULL,
 type ENUM('income','expense') NOT NULL,
 is_default BOOLEAN DEFAULT TRUE,
 user_id BIGINT UNSIGNED NULL,
 created_at TIMESTAMP NULL,
 updated_at TIMESTAMP NULL
);

ALTER TABLE categories ADD CONSTRAINT fk_categories_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE;

CREATE TABLE transactions (
 id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
 user_id BIGINT UNSIGNED NOT NULL,
 category_id BIGINT UNSIGNED NOT NULL,
 amount DECIMAL(12,2) NOT NULL,
 type ENUM('income','expense') NOT NULL,
 description VARCHAR(255) NULL,
 ai_suggested_category BIGINT UNSIGNED NULL,
 date DATE NOT NULL,
 is_recurring BOOLEAN DEFAULT FALSE,
 recurring_frequency VARCHAR(30) NULL,
 created_at TIMESTAMP NULL,
 updated_at TIMESTAMP NULL
);

CREATE TABLE budgets (
 id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
 user_id BIGINT UNSIGNED NOT NULL,
 category_id BIGINT UNSIGNED NOT NULL,
 month DATE NOT NULL,
 limit_amount DECIMAL(12,2) NOT NULL,
 created_at TIMESTAMP NULL,
 updated_at TIMESTAMP NULL
);

CREATE TABLE insights (
 id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
 user_id BIGINT UNSIGNED NOT NULL,
 month DATE NOT NULL,
 summary_text TEXT NOT NULL,
 tip_text TEXT NULL,
 created_at TIMESTAMP NULL,
 updated_at TIMESTAMP NULL
);

CREATE TABLE bookmarks (
 id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
 user_id BIGINT UNSIGNED NOT NULL,
 type VARCHAR(30) DEFAULT 'tip',
 title VARCHAR(255) NOT NULL,
 content TEXT NOT NULL,
 created_at TIMESTAMP NULL,
 updated_at TIMESTAMP NULL
);

ALTER TABLE transactions
 ADD CONSTRAINT fk_transactions_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
 ADD CONSTRAINT fk_transactions_category FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE RESTRICT,
 ADD CONSTRAINT fk_transactions_ai_category FOREIGN KEY (ai_suggested_category) REFERENCES categories(id) ON DELETE SET NULL;

ALTER TABLE budgets
 ADD CONSTRAINT fk_budgets_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
 ADD CONSTRAINT fk_budgets_category FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE;

ALTER TABLE insights ADD CONSTRAINT fk_insights_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE;
ALTER TABLE bookmarks ADD CONSTRAINT fk_bookmarks_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE;

-- Exact indexes and uniqueness rules are maintained by the Laravel migrations.
