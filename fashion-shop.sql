/* Database MySQL
 Fashion Store: clothes, shoes, ...
 Designed By ChauCongTu
 07/2023
 */
CREATE TABLE settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description LONGTEXT NOT NULL,
    short_des TEXT NOT NULL,
    logo VARCHAR(100) NOT NULL,
    photo VARCHAR(100) NOT NULL,
    address VARCHAR(191) NOT NULL,
    phone VARCHAR(191) NOT NULL,
    email VARCHAR(191) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE banners (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(191) NOT NULL,
    summary VARCHAR(191) NOT NULL,
    photo VARCHAR(191) NOT NULL,
    path VARCHAR(191) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE brands (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(191) NOT NULL,
    slug VARCHAR(191) NOT NULL,
    photo VARCHAR(191) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    photo VARCHAR(191) NULL DEFAULT 'public/users/none.jpg',
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(11) NOT NULL,
    password VARCHAR(255) NOT NULL,
    address VARCHAR(500) NOT NULL,
    status ENUM('active', 'inactive', 'locked') DEFAULT 'active',
    role ENUM('admin', 'user') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(191) NOT NULL,
    slug VARCHAR(191) NOT NULL,
    summary TEXT NOT NULL,
    photo VARCHAR(191) NULL,
    is_parent TINYINT(1) NULL DEFAULT 1,
    parent_id INT NULL DEFAULT NULL,
    user_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users (id)
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(100) UNIQUE NOT NULL,
    name VARCHAR(191) NOT NULL,
    slug VARCHAR(191) UNIQUE NOT NULL,
    summary TEXT NOT NULL,
    description LONGTEXT NOT NULL,
    photo VARCHAR(191) NOT NULL,
    size VARCHAR(191) NULL NOT NULL,
    color VARCHAR(191) NULL NOT NULL,
    stock INT NULL DEFAULT 1,
    price DOUBLE(8, 2) NOT NULL,
    discount DOUBLE(8, 2) NOT NULL,
    is_featured TINYINT(1) NULL DEFAULT 0,
    status ENUM('default', 'new', 'hot'),
    cat_id INT NOT NULL,
    brand_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (cat_id) REFERENCES categories (id),
    FOREIGN KEY (brand_id) REFERENCES brands (id)
);

CREATE TABLE photos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    photo VARCHAR(191) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products (id)
);

CREATE TABLE coupons (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(100) NOT NULL,
    type ENUM('price', 'percent'),
    value FLOAT NOT NULL,
    usage_limit INT NULL DEFAULT 1,
    usage_used INT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(100) NOT NULL,
    user_id INT NOT NULL,
    sub_total DOUBLE(8, 2) NOT NULL,
    coupon FLOAT NULL,
    quantity INT NULL DEFAULT 0,
    payment_method ENUM('cod', 'atm', 'momo') NULL DEFAULT 'cod',
    payment_status ENUM('paid', 'unpaid') NULL DEFAULT 'unpaid',
    status ENUM(
        'ordered',
        'process',
        'delivering',
        'completed',
        'canceled'
    ) NULL DEFAULT 'ordered',
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(255) NOT NULL,
    post_code VARCHAR(191) NOT NULL,
    address1 TEXT NOT NULL,
    address2 TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users (id)
);

CREATE TABLE order_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    order_id INT NOT NULL,
    price DOUBLE(8, 2) NOT NULL,
    quantity INT NOT NULL,
    total_price DOUBLE(8, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products (id),
    FOREIGN KEY (order_id) REFERENCES orders (id)
);

CREATE TABLE wishlists (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    product_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users (id),
    FOREIGN KEY (product_id) REFERENCES products (id)
);

CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    product_id INT,
    reply_id INT,
    content VARCHAR(550) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users (id),
    FOREIGN KEY (product_id) REFERENCES products (id),
    FOREIGN KEY (reply_id) REFERENCES comments (id)
);

CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    product_id INT,
    rate INT NULL DEFAULT 5,
    review TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users (id),
    FOREIGN KEY (product_id) REFERENCES products (id)
);
