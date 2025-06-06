-- Users (Landlords, Caretakers, Tenants)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    role ENUM('landlord', 'caretaker', 'tenant'),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Subscription Plans
CREATE TABLE subscriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    plan ENUM('free', 'basic', 'pro'),
    status ENUM('active', 'expired', 'canceled'),
    expiry_date DATE,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Apartments
CREATE TABLE apartments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    landlord_id INT,
    name VARCHAR(100),
    address TEXT,
    rent_amount DECIMAL(10,2),
    status ENUM('vacant', 'occupied'),
    FOREIGN KEY (landlord_id) REFERENCES users(id)
);

-- Tenants
CREATE TABLE tenants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    apartment_id INT,
    user_id INT,
    move_in_date DATE,
    lease_end DATE,
    FOREIGN KEY (apartment_id) REFERENCES apartments(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Maintenance Requests
CREATE TABLE maintenance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    apartment_id INT,
    tenant_id INT,
    caretaker_id INT,
    description TEXT,
    status ENUM('pending', 'in_progress', 'completed'),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (apartment_id) REFERENCES apartments(id),
    FOREIGN KEY (tenant_id) REFERENCES users(id),
    FOREIGN KEY (caretaker_id) REFERENCES users(id)
);
-- Caretakers
CREATE TABLE caretakers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNIQUE,
    assigned_apartment_id INT,
    hired_date DATE,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (assigned_apartment_id) REFERENCES apartments(id)
);
CREATE TABLE houses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    house_id INT UNIQUE,
    apartment_id INT,
    date_added DATE,
    rent_amount DECIMAL(10,2),
    FOREIGN KEY (apartment_id) REFERENCES apartments(id)
);
-- Rent Payments
CREATE TABLE payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tenant_id INT,
    apartment_id INT,
    amount DECIMAL(10,2),
    payment_date DATE,
    status ENUM('paid', 'overdue', 'pending'),
    FOREIGN KEY (tenant_id) REFERENCES users(id),
    FOREIGN KEY (apartment_id) REFERENCES apartments(id)
);