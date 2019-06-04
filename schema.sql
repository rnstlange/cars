CREATE TABLE IF NOT EXISTS owners
(
    id        INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    full_name VARCHAR(50) UNIQUE             NOT NULL
);

CREATE TABLE IF NOT EXISTS cars
(
    id    INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    owner INT,
    brand VARCHAR(50)                    NOT NULL,
    model VARCHAR(50)                    NOT NULL,
    year  YEAR                           NOT NULL,
    FOREIGN KEY (owner) REFERENCES owners (id)
);