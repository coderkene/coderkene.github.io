
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(20) NOT NULL,
    country VARCHAR(50) NOT NULL,
    dob DATE NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    referral_code VARCHAR(50),
    currency VARCHAR(10) NOT NULL,
    investment_goal VARCHAR(50) NOT NULL,
    id_document VARCHAR(255) NOT NULL,
    proof_of_address VARCHAR(255) NOT NULL,
    two_factor_enabled BOOLEAN DEFAULT 0,
    verification_code VARCHAR(6),
    is_verified BOOLEAN DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
