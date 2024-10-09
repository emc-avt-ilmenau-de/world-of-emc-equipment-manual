-- SQLite
-- Insert sample data into the Product table
INSERT INTO Product (
    ProductName,
    ProductMiniDescription,
    ProductDescription,
    ProductPrice,
    ProductCurrency,
    ProductHomeImagePath,
    ProductMultimediaPath,
    created_at,
    updated_at
) VALUES (
    '4K Minicam',
   '{
    "en": {
        "ProductMiniDescription": "High resolution (UHD) Camera especially for EMC- und test laboratories and general applications."
    },
    "de": {
        "ProductMiniDescription": "Kamerasystem mit hoher Auflösung (UHD) speziell für EMV- und Prüflabore sowie allgemeine Anwendung."
    }
}', 
    '{"en":{"Features":
     [
        "4K Camera for EMC labs and test fields with high interference immunity",
        "different resolutions selectable (640 x 360 up to 3840 x 2160)",
        "Pan/Tilt/Zoom inside camera controlled by software",
        "Easy to use in hardware and software",
        "data transmission with optical fibers (USB 3.0)",
        "Small housing in slim design",
        "High field immunity > 200 V/m"
    ],
    "Options": [
        "Integrated rechargeable battery (5 Ah)",
        "Optic lens for different angles",
        "Pan/Tilt/Zoom inside camera controlled by software",
        "Higher interference immunity"
    ]
    }
    , 
    "de":{"Eigenschaften:":
     [
        "4K Kamera für EMV Labore und Prüffelder mit hoher Störfestigkeit",
        "unterschiedliche Auflösungen wählbar (640 x 360 bis zu 3840 x 2160)",
        "Schwenken/Neigen/Zoomen in der Kamera, gesteuert durch Software",
        "30 Bilder/s (für jede Auflösung, auch 4K)",
        "Sony Sensor hoher Qualität (IMX317)",
        "USB Video Class (UVC) kompatibel",
        "Datenübertragung mit Lichtwellenleitern (USB 3.0)",
        "kompaktes Gehäuse in schlankem Design",
        "hohe Störfestigkeit > 200 V/m"
    ],
    "Optionen:": [
        "integrierter Akkumulator (5 Ah)",
        "andere Brennweiten der Objektive",
        "höhere Störfestigkeit"
    ]
    }
    }' ,
    7000,
    'EUR',
    'Frontend/images/avt_emv4kminicam_1000.jpg',
    '{"en":{
        "image1": {
            "path": "Frontend\\images\\4kminicam1.png",
            "caption": "English caption"
        },
        "image2": {
            "path": "Frontend\\images\\4kminicam3.png",
            "caption": "English caption"
        },
        "video1": {
            "path": "Frontend\\images\\avt_minicam_video.mp4",
            "caption": "English caption"
        }
    }
    
    "de": {
        "image1": {
            "path": "Frontend\\images\\4kminicam1.png",
            "caption": "German caption"
        },
        "image2": {
            "path": "Frontend\\images\\4kminicam3.png",
            "caption": "German caption"
        },
        "video1": {
            "path": "Frontend\\images\\avt_minicam_video.mp4",
            "caption": "German caption"
        }
    }
}
}',
    CURRENT_TIMESTAMP,
    CURRENT_TIMESTAMP
);


     /*('Thermocam', 7000, 'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('Lamp EMVLED 100', 1350, 'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('Lamp EMVLED 75', 1290, 'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('Lamp EMVLED 24/40 ', 0, 'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),    
     ('EMC USB Converter', 'x.x', 'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('Sequenzer AVT NT01', 'x.x', 'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);*/

DROP TABLE IF EXISTS Product;

DELETE FROM Product
WHERE ProductID IN('7');

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


-- Sample json data insertion
/*INSERT INTO Product (ProductMedia) VALUES
('{
    "en": {
        "image1": {
            "path": "image1_path",
            "caption": "English caption"
        },
        "image2": {
            "path": "image2_path",
            "caption": "English caption"
        },
        "video": {
            "path": "video_path",
            "caption": "English caption"
        }
    },
    "de": {
        "image1": {
            "path": "image1_path",
            "caption": "German caption"
        },
        "image2": {
            "path": "image2_path",
            "caption": "English caption"
        },
        "video": {
            "path": "video_path",
            "caption": "English caption"
        }
    }
}');

$arr_media = json_decode($str_json, true);

foreach ($arr_media as $media):
    foreach ($media as $path => $caption)
        if ($path == 'image')
            <html img=''>
        else if ($path == 'video')
            <html img=''>
           * /