-- SQLite
-- Insert sample data into the Product table
INSERT INTO Product (ProductName,ProductPrice,ProductCurrency, created_at, updated_at) VALUES
    ('4K Minicam', 7000, 'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('Thermocam', 7000, 'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('Lamp EMVLED 100', 1350, 'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('Lamp EMVLED 75', 1290, 'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('Lamp EMVLED 24 ', 1540, 'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('Lamp EMVLED 40', 1230, 'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     (' EMC USB Converter', 'x.x', 'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('Sequenzer AVT NT01', 'x.x', 'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

DROP TABLE IF EXISTS Product;

DELETE FROM Product
WHERE ProductID IN('9', '10', '11', '12', '13', '14', '15', '16');

-- SQLite
-- Insert sample data into the Component table
INSERT INTO Component (ComponentName, created_at, updated_at) VALUES
    ('4K Minicam Lens',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('Fiber Optics', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('Power Supply',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('Power Plug',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('Geographic area for power',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('Software',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);


-- SQLite
-- Insert sample data into the ProductComponent table
INSERT INTO ProductComponent (ProductID,ComponentID, created_at, updated_at) VALUES
    ('1', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('1', '2', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('1', '3',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('1', '4',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('1', '5',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('1', '6',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

-- SQLite
-- Insert sample data into the ComponentValue table
INSERT INTO ComponentValue (ComponentValueID,ComponentID,ComponentValueName,ComponentValuePrice,ComponentValueCurrency) VALUES
    ('1', '1','3.2mm',NULL,'EUR'),
     ('2', '1','4.5mm',NULL,'EUR'),
     ('3', '1','6.8mm',NULL,'EUR'),
     ('4', '1','12mm',NULL,'EUR'),
     ('5', '1','Other',NULL,'EUR'),
     ('6', '2','10m',NULL,'EUR'),
     ('7', '2','20m',NULL,'EUR'),
     ('8', '2','30m',NULL,'EUR'),
     ('9', '2','40m','x.x','EUR'),
     ('10', '2','70m','x.x','EUR'),
     ('11', '2','100m','x.x','EUR'),
     ('12', '3','Hardened switching power supply 230V/5V ',NULL,'EUR'),
     ('13', '3','Hardened nonswitching power supply 230V/5V ',NULL,'EUR'),
     ('14', '3',' Accumulator/chargeable batterie inside camera ',NULL,'EUR'),
     ('15', '4',' EU ',NULL,'EUR'),
     ('16', '4',' UK ',NULL,'EUR'),
     ('17', '5',' 230 V/ 50 Hz ',NULL,'EUR'),
     ('18', '5',' 110 VAC @ 60Hz ',NULL,'EUR'),
     ('19', '6',' Basic ',NULL,'EUR'),
     ('20', '6',' Minicam Plus ','x.x','EUR');
