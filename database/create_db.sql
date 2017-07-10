DROP TABLE IF EXISTS offers;

CREATE TABLE offers (
    id VARCHAR(64) NOT NULL PRIMARY KEY,
    name VARCHAR(32) NOT NULL,
    cost DECIMAL(12, 2) NOT NULL,
    country VARCHAR(60) NOT NULL,
    state VARCHAR(60) NOT NULL,
    max_limit DECIMAL(12, 2) NOT NULL
);

CREATE INDEX offer_name ON offers(name);
CREATE INDEX cost ON offers(cost);
