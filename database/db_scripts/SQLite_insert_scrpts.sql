-- SQLite
-- Insert sample data into the Product table 4k minicam
INSERT INTO Product (
    ProductID,
    CategoryID,
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
    '1',
    '1',
    '4K MiniCam',
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
        "Different resolutions selectable (640 x 360 up to 3840 x 2160)",
        "Pan/Tilt/Zoom inside camera controlled by software",
        "Easy to use in hardware and software",
        "High quality vision sensor",
        "USB Video Class (UVC) compliant",
        "Data transmission with optical fibers (USB 3.0)",
        "Small housing in slim design",
        "High field immunity > 200 V/m"
    ],
    "Options": [
        "Integrated rechargeable battery (5 Ah)",
        "Optic lens for different angles"
    ]
    }
    , 
    "de":{"Eigenschaften:":
     [
        "4K Kamera für EMV Labore und Prüffelder mit hoher Störfestigkeit",
        "Unterschiedliche Auflösungen wählbar (640 x 360 bis zu 3840 x 2160)",
        "Schwenken/Neigen/Zoomen in der Kamera, gesteuert durch Software",
        "Einfache Nutzung von Hardware und Software",
        "Hochwertiger Vision-Sensor",
        "USB Video Class (UVC) kompatibel",
        "Datenübertragung mit Lichtwellenleitern (USB 3.0)",
        "Kompaktes Gehäuse in schlankem Design",
        "Hohe Störfestigkeit > 200 V/m"
    ],
    "Optionen:": [
        "Integrierter Akkumulator (5 Ah)",
        "Andere Brennweiten der Objektive"
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
    },
    
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
}',
    CURRENT_TIMESTAMP,
    CURRENT_TIMESTAMP
);

-- SQLite
-- Insert sample data into the Product table thermocam

INSERT INTO Product (
    ProductID,
    CategoryID,
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
    '2',
    '1',
    'ThermoCam',
   '{
    "en": {
        "ProductMiniDescription": "LWIR Thermography Camera especially for EMC- und test laboratories, and general applications."
    },
    "de": {
        "ProductMiniDescription": "LWIR Thermographie Kamera speziell für EMV- und Prüflabore, sowie allgemeine Anwendungen."
    }
}', 
    '{"en":{"Features":
     [
        "LWIR Camera for EMC labs and test fields with high interference imunity",
        "Different resolutions",
        "Selectable focal length",
        "Selectable frame rate",
        "Wide thermal wavelength range",
        "Wide temperature range",
        "Data transmission with optical fibers",
        "Compact housing in slim design",
        "High field immunity > 200 V/m"
    ],
    "Options": [
        "Integrated rechargeable battery (5 Ah)",
        "Optic lens for different angles"
    ]
    }
    , 
    "de":{"Eigenschaften:":
     [
        "LWIR Kamera für EMV-Labore und Prüffelder mit hoher Störfestigkeit",
        "Unterschiedliche Auflösungen",
        "Auswählbare Brennweite",
        "Auswählbare Bildwiederholrate",
        "Großer thermischer Wellenlängenbereich",
        "Großer Temperaturbereich",
        "Datenübertragung mit Lichtwellenleitern",
        "Kompaktes Gehäuse in schlankem Design",
        "Hohe Störfestigkeit > 200 V/m"
    ],
    "Optionen:": [
        "Integrierter Akkumulator (5 Ah)",
        "Andere Brennweiten der Objektive"
    ]
    }
    }' ,
    7000,
    'EUR',
    'Frontend/images/thermocam_1000-768x488.jpg',
    '{"en":{
        "image1": {
            "path": "Frontend\\images\\thermocam_1000-768x488.jpg",
            "caption": "English caption"
        },
        "image2": {
            "path": "Frontend\\images\\thermocam2.pdf.png",
            "caption": "English caption"
        },
        "video1": {
            "path": "Frontend\\images\\avt_thermocam_video.mp4",
            "caption": "English caption"
        }
    },
    
    "de": {
        "image1": {
            "path": "Frontend\\images\\thermocam_1000-768x488.jpg",
            "caption": "German caption"
        },
        "image2": {
            "path": "Frontend\\images\\thermocam2.pdf.png",
            "caption": "German caption"
        },
        "video1": {
            "path": "Frontend\\images\\avt_thermocam_video.mp4",
            "caption": "German caption"
        }
    }
}',
    CURRENT_TIMESTAMP,
    CURRENT_TIMESTAMP
);

-- SQLite
-- Insert sample data into the Product table Cam Controller
INSERT INTO Product (
    ProductID,
    CategoryID,
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
    '9',
    '1',
    '{
    "en": {
        "ProductName": "CamControl"
    },
    "de": {
        "ProductName": "CamControl"
    }
}',
   '{
    "en": {
        "ProductMiniDescription": "AVT EMC CamControl Control unit for high resolution (UHD) and thermal cameras for EMC- and test laboratories, as well as general applications."
    },
    "de": {
        "ProductMiniDescription": "AVT EMC CamControl Steuergerät für hochauflösende (UHD) und Wärmebildkameras für EMV- und Prüflabore, sowie für allgemeine Anwendungen."
    }
}', 
    '{"en":{"Features":
     [
        "Control unit for AVT cameras in the visual and infrared wavelength range",
        "Controls up to or one 4K MiniCam and one2 AVT EMC 4K MiniCams ThermoCam or 2 ThermoCams with USB3 fiber line",
        "Small housing in (12,5 x10,5 x 5 cm)smart design (12,5 x10,5 x 5 cm)",
        "Output to HDMI monitors with FullHD resolution (4K resolution option)",
        "4.3 inch on deviceIPS touch display on device",
        "LEDs for power and connected cameras (Cam 1, Cam 2)",
        "Power connection via USB-C plug (5 V/2,5 A)",
        "Automatic detection of connected cameras",
        "Realization of camera functions (pan/tilt/zoom/resolution/ compression/brightness/contrast/temperature etc.)"
    ],
    "Options": [
        "Mouse and keyboard connection",
        "Ethernet connection to PC or Laptop"
    ]
    }
    , 
    "de":{"Eigenschaften:":
     [
        "Steuergerät für AVT-Kameras im visuellen und infraroten Wellenlängenbereich",
        "Steuert bis zu oder eine 4K MiniCam und eine2 AVT EMC 4K MiniCams ThermoCam oder 2 ThermoCams mit USB3-Faserleitung",
        "Kleines Gehäuse im (12,5 x10,5 x 5 cm)schicken Design (12,5 x10,5 x 5 cm)",
        "Ausgabe an HDMI-Monitore mit FullHD-Auflösung (4K-Auflösung optional)",
        "4,3 Zoll auf dem GerätIPS-Touch-Display auf dem Gerät",
        "LEDs für Stromversorgung und angeschlossene Kameras (Cam 1, Cam 2)",
        "Stromanschluss über USB-C-Stecker (5 V/2,5 A)",
        "Automatische Erkennung von angeschlossenen Kameras",
        "Realisierung von Kamerafunktionen (Schwenken/Neigen/Zoomen/Auflösung/Komprimierung/Helligkeit/Kontrast/Temperatur usw.)"
    ],
    "Optionen:": [
        "Anschluss von Maus und Tastatur",
        "Ethernet-Anschluss an PC oder Laptop"
    ]
    }
    }' ,
    00,
    'EUR',
    'Frontend/images/camcontrol.png',
    '{"en":{
        "image1": {
            "path": "Frontend\\images\\CamControl01_001.png",
            "caption": "English caption"
        },
        "image2": {
            "path": "Frontend\\images\\CamControl01_002.png",
            "caption": "English caption"
        },
        "image3": {
            "path": "Frontend\\images\\CamControl01_003.png",
            "caption": "English caption"
        },
        "image4": {
            "path": "Frontend\\images\\CamControl02_001.png",
            "caption": "English caption"
        },
        "image5": {
            "path": "Frontend\\images\\CamControl02_002.png",
            "caption": "English caption"
        },
        "video1": {
            "path": "Frontend\\images\\CamControl01.mp4",
            "caption": "English caption"
        }
    },
    
    "de": {
        "image1": {
            "path": "Frontend\\images\\CamControl01_001.png",
            "caption": "German caption"
        },
        "image2": {
            "path": "Frontend\\images\\CamControl01_002.png",
            "caption": "German caption"
        },
        "image3": {
            "path": "Frontend\\images\\CamControl01_003.png",
            "caption": "English caption"
        },
        "image4": {
            "path": "Frontend\\images\\CamControl02_001.png",
            "caption": "English caption"
        },
        "image5": {
            "path": "Frontend\\images\\CamControl02_002.png",
            "caption": "English caption"
        },
        "video1": {
            "path": "Frontend\\images\\CamControl01.mp4",
            "caption": "German caption"
        }
    }
}',
    CURRENT_TIMESTAMP,
    CURRENT_TIMESTAMP
);


-- SQLite
-- Insert sample data into the Product table Intercom
INSERT INTO Product (
    ProductID,
    CategoryID,
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
    '11',
    '1',
    '{
    "en": {
        "ProductName": "Intercom"
    },
    "de": {
        "ProductName": "Intercom"
    }
}',
   '{
    "en": {
        "ProductMiniDescription": "AVT EMC Intercom 2-way audio communication for EMC halls,  measuring cabins and for all environments with special electromagnetic requirements."
    },
    "de": {
        "ProductMiniDescription": "AVT EMC Gegensprechanlage 2-Wege Audiokommunikation für EMV-Hallen, Messkabinen und für alle Umgebungen mit besonderen elektromagnetischen Anforderungen."
    }
}', 
    '{"en":{"Features":
     [
        "Intercom system between test lab and control room",
        "Designed for EMC-laboratories and test fields",
        "Microfon frequency range: 150 Hz... 6.8 kHz",
        "Transfer frequency range: 150 Hz... 15 kHz",
        "Dynamic equalizer for communication",
        "Duplex audio and echo cancellation",
        "High battery power for long working time",
        "Controlled by PC, Laptop or AVT CamControl",
        "German product"
    ],
    "Options": [
        "Extended battery power",
        "Various housing colors",
        "Various fiber optic length"
    ],

       "Warranty":[
        "Standard: 2 years; optionally extendable by 1 year each"
    ],
    
     "Flyer Link": [
      "Frontend\\flayers\\AVT_EMC_Intercom-Flyer_en_v1_00.pdf"
    ]

    }
    , 
    "de":{"Eigenschaften:":
     [
        "Gegensprechanlage zwischen Testlabor und Kontrollraum",
        "Konzipiert für EMV-Laboratorien und Testfelder",
        "Mikrofon-Frequenzbereich: 150 Hz... 6,8 kHz",
        "Übertragungsfrequenzbereich: 150 Hz... 15 kHz",
        "Dynamischer Equalizer für die Kommunikation",
        "Duplex-Audio und Echounterdrückung",
        "Hohe Batterieleistung für lange Arbeitszeiten",
        "Gesteuert durch PC, Laptop oder AVT CamControl",
        "Deutsches Produkt"
    ],
    "Optionen:": [
        "Erweiterte Batterieleistung",
        "Verschiedene Gehäusefarben",
        "Verschiedene Lichtwellenleiterlängen"
    ],
     "Garantie:":[
        "Standard: 2 Jahre; optional verlängerbar um je 1 Jahre"
    ],

    "Flugblatt Link:": [
      "Frontend\\flayers\\AVT_EMC_Intercom-Flyer_en_v1_00.pdf"
    ]
    }
    }' ,
    00,
    'EUR',
    'Frontend/images/Intercom0222_01.png',
    '{"en":{
        "image1": {
            "path": "Frontend\\images\\Intercom0222_01.png",
            "caption": "English caption"
        },
        "image2": {
            "path": "Frontend\\images\\Intercom0198_01.png",
            "caption": "English caption"
        },
        "image3": {
            "path": "Frontend\\images\\Intercom0222.png",
            "caption": "English caption"
        },
        "image4": {
            "path": "Frontend\\images\\Intercom0198.png",
            "caption": "English caption"
        },
       
        "video1": {
            "path": "Frontend\\images\\IntercomAnimation.mp4",
            "caption": "English caption"
        }
    },
    
    "de": {
        "image1": {
            "path": "Frontend\\images\\Intercom0222_01.png",
            "caption": "German caption"
        },
        "image2": {
            "path": "Frontend\\images\\Intercom0198_01.png",
            "caption": "German caption"
        },
        "image3": {
            "path": "Frontend\\images\\Intercom0222.png",
            "caption": "English caption"
        },
        "image4": {
            "path": "Frontend\\images\\Intercom0198.png",
            "caption": "English caption"
        },
       
        "video1": {
            "path": "Frontend\\images\\IntercomAnimation.mp4",
            "caption": "German caption"
        }
    }
}',
    CURRENT_TIMESTAMP,
    CURRENT_TIMESTAMP
);

-- SQLite
-- Insert sample data into the Product table Lamp EMVLED 100

INSERT INTO Product (
    ProductID,
    CategoryID,
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
    '3',
    '2',
    'Lamp EMVLED 100',
   '{
    "en": {
        "ProductMiniDescription": "The EMC-resistant, dimmable (optional) and low-emission LED lights and drivers are the ideal LED lighting system for EMC and test labs, as well as generally interference-sensitive environments."
    },
    "de": {
        "ProductMiniDescription": "Die EMV-resistenten, dimmbaren (optional) und emissionsarmen LED-Leuchten und -Treiber sind das ideale LED-Beleuchtungssystem für EMV- und Prüflabore sowie allgemein störungsempfindliche Umgebungen."
    }
}', 
    '{"en":{"Features":
     [
        "LED light for EMC laboratories and testfield with 100 W output",
        "High luminous flux from 10,000 lm for one luminaire",
        "High color rendering index Ra (CRI) 90 to 97 (option)",
        "High efficiency, therefore low heat load",
        "Lowest electrical and electromagnetic interference (noise limit)",
        "Selectable light color (2700 K - 4000 K)",
        "Selectable opening angle (22° - 80°) of the reflectors",
        "Input voltage range (220 - 240 V~/ 50 Hz, deviating optional)",
        "Developed and manufactured in Germany"
    ],
    "Options": [
        "Dimmable (10... 100 %)",
        "Higher outputs (>100... 200 W / 10 000... 25 000 lm)"
    ],
    "Additional services":[
        "Cable extensions for LED lamps",
        "Installation services",
        "Planning and lighting calculations"   
    ],
    "Warranty":[
        "Standard: 2 years; optionally extendable by 1 year each"
    ]

    }
    , 
    "de":{"Eigenschaften:":
     [
        "LED-Leuchte für EMV-Labore und Prüffelder mit 100 W Leistung",
        "Hoher Lichtstrom ab 10.000 lm für eine Leuchte",
        "Hoher Farbwiedergabewert Ra (CRI) 90 bis 97 (Option)",
        "Hohe Effizienz, dadurch geringe Wärmebelastung",
        "Geringste elektrische und elektromagnetische Störungen (Rauschgrenze)",
        "Auswählbare Lichtfarbe (2700 K - 4000 K)",
        "Auswählbarer Öffnungswinkel (22° - 80°) der Reflektoren",
        "Eingangsspannungsbereich (220 - 240 V~/ 50 Hz, abweichend optional)",
        "Deutsches Produkt"
    ],
    "Optionen:": [
        "Dimmbar (10... 100 %)",
        "Höhere Leistungen (>100... 200 W / 10 000... 25 000 lm)"
    ],
    "Zusätzliche Dienstleistungen:": [
        "Kabelverlängerungen für LED-Leuchten",
        "Installationsdienstleistungen",
        "Planung und Beleuchtungsberechnungen"    
    ],
    "Garantie:":[
        "Standard: 2 Jahre; optional verlängerbar um je 1 Jahre"
    ]
    }
    }' ,
    7000,
    'EUR',
    'Frontend/images/emvled100_2_2000-768x698.jpg',
    '{"en":{
        "image1": {
            "path": "Frontend\\images\\emvled100_2_2000-768x698.jpg",
            "caption": "English caption"
        },
        "image2": {
            "path": "Frontend\\images\\Lamp EMVLED 100 – AVT GmbH.png",
            "caption": "English caption"
        },
        "video1": {
            "path": "Frontend\\images\\avt_emvled_540p.mp4",
            "caption": "English caption"
        }
    },
    
    "de": {
        "image1": {
            "path": "Frontend\\images\\emvled100_2_2000-768x698.jpg",
            "caption": "German caption"
        },
        "image2": {
            "path": "Frontend\\images\\Lamp EMVLED 100 – AVT GmbH.png",
            "caption": "German caption"
        },
        "video1": {
            "path": "Frontend\\images\\avt_emvled_540p.mp4",
            "caption": "German caption"
        }
    }
}',
    CURRENT_TIMESTAMP,
    CURRENT_TIMESTAMP
);

-- SQLite
-- Insert sample data into the Product table Lamp EMVLED 75
INSERT INTO Product (
    ProductID,
    CategoryID,
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
    '4',
    '2',
    'Lamp EMVLED 75',
   '{
    "en": {
        "ProductMiniDescription": "The EMC-resistant, dimmable (optional) and low-emission LED lights and drivers are the ideal LED lighting system for EMC and test labs, as well as generally interference-sensitive environments."
    },
    "de": {
        "ProductMiniDescription": "Die EMV-resistenten, dimmbaren (optional) und emissionsarmen LED-Leuchten und -Treiber sind das ideale LED-Beleuchtungssystem für EMV- und Prüflabore sowie allgemein störungsempfindliche Umgebungen."
    }
}', 
    '{"en":{"Features":
     [
        "LED light for EMC laboratories and testfield with 75 W output",
        "High luminous flux from 10,000 lm for one luminaire",
        "High color rendering index Ra (CRI) 90 to 97 (option)",
        "High efficiency, therefore low heat load",
        "Lowest electrical and electromagnetic interference (noise limit)",
        "Selectable light color (2700 K - 4000 K)",
        "Selectable opening angle (15° - 80°) of the reflectors",
        "Input voltage range (220 - 240 V~/ 50 Hz, deviating optional)",
        "Slim design - perfect fluorescent lamp replacement",
        "Developed and manufactured in Germany"
    ],
    "Options": [
        "Dimmable (10... 100 %)",
        "Higher outputs (>100... 200 W / 10 000... 25 000 lm)"
    ],
    "Additional services":[
        "Cable extensions for LED lamps",
        "Installation services",
        "Planning and lighting calculations"   
    ],
    "Warranty":[
        "Standard: 2 years; optionally extendable by 1 year each"
    ]

    }
    , 
    "de":{"Eigenschaften:":
     [
        "LED-Leuchte für EMV-Labore und Prüffelder mit 75 W Leistung",
        "Hoher Lichtstrom ab 10.000 lm für eine Leuchte",
        "Hoher Farbwiedergabewert Ra (CRI) 90 bis 97 (Option)",
        "Hohe Effizienz, dadurch geringe Wärmebelastung",
        "Geringste elektrische und elektromagnetische Störungen (Rauschgrenze)",
        "Auswählbare Lichtfarbe (2700 K - 4000 K)",
        "Auswählbarer Öffnungswinkel (15° - 80°) der Reflektoren",
        "Eingangsspannungsbereich (220 - 240 V~/ 50 Hz, abweichend optional)",
        "Schlankes Design - perfekter Leuchtstofflampenersatz",
        "Deutsches Produkt"
    ],
    "Optionen:": [
        "Dimmbar (10... 100 %)",
        "Höhere Leistungen (>100... 200 W / 10 000... 25 000 lm)"
    ],
    "Zusätzliche Dienstleistungen:": [
        "Kabelverlängerungen für LED-Leuchten",
        "Installationsdienstleistungen",
        "Planung und Beleuchtungsberechnungen"    
    ],
    "Garantie:":[
        "Standard: 2 Jahre; optional verlängerbar um je 1 Jahre"
    ]
    }
    }' ,
    7000,
    'EUR',
    'Frontend/images/emvled75_1000.jpg',
    '{"en":{
        "image1": {
            "path": "Frontend\\images\\emvled75_1000.jpg",
            "caption": "English caption"
        },
        "image2": {
            "path": "Frontend\\images\\lamp75.png",
            "caption": "English caption"
        },
        "video1": {
            "path": "Frontend\\images\\avt_emvled_540p.mp4",
            "caption": "English caption"
        }
    },
    
    "de": {
        "image1": {
            "path": "Frontend\\images\\emvled75_1000.jpg",
            "caption": "German caption"
        },
        "image2": {
            "path": "Frontend\\images\\lamp75.png",
            "caption": "German caption"
        },
        "video1": {
            "path": "Frontend\\images\\avt_emvled_540p.mp4",
            "caption": "German caption"
        }
    }
}',
    CURRENT_TIMESTAMP,
    CURRENT_TIMESTAMP
);


-- SQLite
-- Insert sample data into the Product table Lamp EMVLED 24/40
INSERT INTO Product (
    ProductID,
    CategoryID,
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
    '5',
    '2',
    'Lamp EMVLED Lamp EMVLED 24/40',
   '{
    "en": {
        "ProductMiniDescription": "The EMC-resistant, dimmable (optional) and low-emission LED lights and drivers are the ideal LED lighting system for EMC and test labs, as well as generally interference-sensitive environments."
    },
    "de": {
        "ProductMiniDescription": "Die EMV-resistenten, dimmbaren (optional) und emissionsarmen LED-Leuchten und -Treiber sind das ideale LED-Beleuchtungssystem für EMV- und Prüflabore sowie allgemein störungsempfindliche Umgebungen."
    }
}', 
    '{"en":{"Features":
     [
        "LED light for EMC laboratories and testfield with up to 40 W output",
        "High luminous flux up to over 4000 lm each lamp",
        "High color rendering index Ra (CRI) 90 to 97 (option)",
        "High efficiency, therefore low heat load",
        "Lowest electrical and electromagnetic interference (noise limit)",
        "Selectable light color (2700 K - 5000 K)",
        "Selectable opening angle (15° - 80°) of the reflectors",
        "Supply voltage for driver range 230 VAC (optional different)",
        "Developed and manufactured in Germany"
    ],
    "Options": [
        "Dimmable (10... 100 %)",
        "Different power"
    ],
    "Additional services":[
        "Cable extensions for LED lamps",
        "Installation services",
        "Planning and lighting calculations"   
    ],
    "Warranty":[
        "Standard: 2 years; optionally extendable by 1 year each"
    ]

    }
    , 
    "de":{"Eigenschaften:":
     [
        "LED-Leuchte für EMV-Labore und Prüffeld mit bis zu 40 W Leistung",
        "Hoher Lichtstrom bis zu über 4000 lm pro Lampe",
        "Hoher Farbwiedergabewert Ra (CRI) 90 bis 97 (Option)",
        "Hohe Effizienz, dadurch geringe Wärmebelastung",
        "Geringste elektrische und elektromagnetische Störungen (Rauschgrenze)",
        "Auswählbare Lichtfarbe (2700 K - 5000 K)",
        "Auswählbarer Öffnungswinkel (15° - 80°) der Reflektoren",
        "Versorgungsspannung für Treiberbereich 230 VAC (optional abweichend)",
        "Deutsches Produkt"
    ],
    "Optionen:": [
        "Dimmbar (10... 100 %)",
        "Unterschiedliche Leistung"
    ],
    "Zusätzliche Dienstleistungen:": [
        "Kabelverlängerungen für LED-Leuchten",
        "Installationsdienstleistungen",
        "Planung und Beleuchtungsberechnungen"    
    ],
    "Garantie:":[
        "Standard: 2 Jahre; optional verlängerbar um je 1 Jahre"
    ]
    }
    }' ,
    7000,
    'EUR',
    'Frontend/images/emvled024_800-768x844.jpg',
    '{"en":{
        "image1": {
            "path": "Frontend\\images\\emvled024_800-768x844.jpg",
            "caption": "English caption"
        },
        "image2": {
            "path": "Frontend\\images\\Lamp EMVLED 24_40 – AVT GmbH.png",
            "caption": "English caption"
        },
        "video1": {
            "path": "Frontend\\images\\avt_emvled_540p.mp4",
            "caption": "English caption"
        }
    },
    
    "de": {
        "image1": {
            "path": "Frontend\\images\\emvled024_800-768x844.jpg",
            "caption": "German caption"
        },
        "image2": {
            "path": "Frontend\\images\\Lamp EMVLED 24_40 – AVT GmbH.png",
            "caption": "German caption"
        },
        "video1": {
            "path": "Frontend\\images\\avt_emvled_540p.mp4",
            "caption": "German caption"
        }
    }
}',
    CURRENT_TIMESTAMP,
    CURRENT_TIMESTAMP
);


-- SQLite
-- Insert sample data into the Product table EMC LED Driver
INSERT INTO Product (
    ProductID,
    CategoryID,
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
    '6',
    '2',
    'EMC LED Driver',
   '{
    "en": {
        "ProductMiniDescription": "The EMC-resistant, dimmable (optional) and low-emission LED lights and drivers are the ideal LED lighting system for EMC and test labs, as well as generally interference-sensitive environments."
    },
    "de": {
        "ProductMiniDescription": "Die EMV-resistenten, dimmbaren (optional) und emissionsarmen LED-Leuchten und -Treiber sind das ideale LED-Beleuchtungssystem für EMV- und Prüflabore sowie allgemein störungsempfindliche Umgebungen."
    }
}', 
    '{"en":{"Features":
     [
        "Driver power from 70 W to 250 W",
        "Driver EMVC immun and very low emission",
        "Driver can be installed inside or outside the EMC equipment",
        "Optionally dimmable: 20 % to 100 %",
        "Cabling as fixed installation or as 230 V cable with plugs and sockets for LED cabling",
        "Developed and manufactured in Germany"
    ],
    "Options": [
        "Different housing colors possible (black as standard)",
        "Different housing forms possible"
    ],
    "Additional services":[
        "Cable extensions for LED lamps",
        "Installation services",
        "Planning and lighting calculations",
        "EMC-proof camera system with pan-tilt head"   
    ],
    "Warranty":[
        "Standard: 2 years; optionally extendable by 1 year each"
    ]

    }
    , 
    "de":{"Eigenschaften:":
     [
        "Teiberleistung zwischen 70 W bis 200 W",
        "Treiber EMV-fest (> 100 V/m) und besonders emmisionsarm (Rauschgrenze)",
        "Treiber kann innerhalb oder außerhalb der EMV-Kabine/Halle eingebaut werden",
        "Optional dimmbar: 20 % bis 100 %",
        "Verkabelung als Festinstallation oder als 230 V Kabel mit Stecker und Buchsen der LED-Verkabelung",
        "Deutsches Produkt"
    ],
    "Optionen:": [
        "Verschiedene Gehäusefarben möglich (standardmäßig schwarz)",
        "Verschiedene Gehäuseformen möglich (abgesetzter Treiber oder mit Leuchte an Halterung)"
    ],
    "Zusätzliche Dienstleistungen:": [
        "Kabelverlängerungen für LED-Leuchten",
        "Installationsdienstleistungen",
        "Planung und Beleuchtungsberechnungen",
        "EMV-festes Kamerasystem und IR-Kamerasystem"    
    ],
    "Garantie:":[
        "Standard: 2 Jahre; optional verlängerbar um je 1 Jahre"
    ]
    }
    }' ,
    600,
    'EUR',
    'Frontend/images/AVT_EMVTLED070-1024x892.jpg',
    '{"en":{
        "image1": {
            "path": "Frontend\\images\\AVT_EMVTLED070-1024x892.jpg",
            "caption": "English caption"
        },
        "image2": {
            "path": "Frontend\\images\\EMC_LED_Driver _AVT_GmbH.png",
            "caption": "English caption"
        },
        "video1": {
            "path": "Frontend\\images\\avt_emvled_540p.mp4",
            "caption": "English caption"
        }
    },
    
    "de": {
        "image1": {
            "path": "Frontend\\images\\AVT_EMVTLED070-1024x892.jpg",
            "caption": "German caption"
        },
        "image2": {
            "path": "Frontend\\images\\EMC_LED_Driver _AVT_GmbH.png",
            "caption": "German caption"
        },
        "video1": {
            "path": "Frontend\\images\\avt_emvled_540p.mp4",
            "caption": "German caption"
        }
    }
}',
    CURRENT_TIMESTAMP,
    CURRENT_TIMESTAMP
);


-- SQLite
-- Insert sample data into the Product table EMC USB Converter
INSERT INTO Product (
    ProductID,
    CategoryID,
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
    '7',
    '3',
    'EMC USB Converter',
   '{
    "en": {
        "ProductMiniDescription": "Electro-optical USB-Converter especially for EMC and test laboratories, as well as general applications."
    },
    "de": {
        "ProductMiniDescription": "USB-Umwandler elektrisch-optisch speziell für EMV- und Prüflabore sowie allgemeine Anwendungen."
    }
}', 
    '{"en":{"Features":
     [
        "USB 1.0 - 3.0 Converter",
        "USB-device types 1.0 - 2.0 and 3.0",
        "Maximum transmission data rate up to 5 Gbit/s",
        "Full data transparency (no driver dependency)",
        "Power supply for EUT with 5 V / 3 A /15 W",
        "Power supply device with 85 - 250 VAC / 47 - 63 Hz",
        "Wide temperature range",
        "Data transmission and control with fiber optic cable",
        "Variants of fiber cable length 10 m / 20 m / 30 m / 50 m / 70 m / 100 m",
        "High interference immunity > 200 V/m",
        "Developed and manufactured in Germany"
    ]

    }
    , 
    "de":{"Eigenschaften:":
     [
        "USB 1.0 - 3.0 Konverter",
        "Gerätetypen für USB 1.0 - 2.0 und 3.0",
        "Maximale Übertragungsgeschwindigkeit bis 5 Gbit/s",
        "Volle Datentransparenz (keine Treiberabhängigkeit)",
        "Spannungsversorgung EUT mit 5 V / 3 A /15 W",
        "Spannungsversorgung Gerät 85 - 250 VAC / 47 - 63 Hz",
        "Großer Temperaturbereich",
        "Datenübertragung und Steuerung mit Lichtwellenleiter",
        "Varianten der LWL-Längen 10 m / 20 m / 30 m / 50 m / 70 m / 100 m",
        "Hohe Störfestigkeit > 200 V/m",
        "Deutsches Produkt"
    ]
    }
    }' ,
    1000,
    'EUR',
    'Frontend/images/usb.jpg',
    '{"en":{
        "image1": {
            "path": "Frontend\\images\\usb.jpg",
            "caption": "English caption"
        },
        "image2": {
            "path": "Frontend\\images\\EMV USB Konverter – AVT GmbH.png",
            "caption": "English caption"
        },
        "video1": {
            "path": "Frontend\\images\\avt_usb_converter.mp4",
            "caption": "English caption"
        }
    },
    
    "de": {
        "image1": {
            "path": "Frontend\\images\\usb.jpg",
            "caption": "German caption"
        },
        "image2": {
            "path": "Frontend\\images\\EMV USB Konverter – AVT GmbH.png",
            "caption": "German caption"
        },
        "video1": {
            "path": "Frontend\\images\\avt_usb_converter.mp4",
            "caption": "German caption"
        }
    }
}',
    CURRENT_TIMESTAMP,
    CURRENT_TIMESTAMP
);


-- SQLite
-- Insert sample data into the Product table Sequenzer AVT NT01
INSERT INTO Product (
    ProductID,
    CategoryID,
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
    '8',
    '3',
    'Sequenzer AVT NT01 ',
   '{
    "en": {
        "ProductMiniDescription": "Sequencer to control any processes for test and inspection arrangements with high accuracy. The sequencer is particularly suitable for EMC measurement and testing technology. The simple installation and commissioning are outstanding features of the device."
    },
    "de": {
        "ProductMiniDescription": "Sequenzer zur Steuerung beliebiger Abläufe für Test- und Prüfanordnungen mit hoher Genauigkeit. Der Sequenzer ist besonders geeignet für die EMV-Mess- und -Prüftechnik. Die einfache Installation und Inbetriebnahme sind herausragende Eigenschaften des Gerätes."
    }
}', 
    '{"en":{"Features":
     [
        "Control of highly precise processes with FPGA technology",
        "From 8 to 72 output trigger channels",
        "Good compatibility with devices because of optical and electrical 12V outputs",
        "Channel output as trigger signal and inverted trigger signal",
        "Synchronization of the trigger signals with a reference variable or external signal",
        "Switches for start, reset, standby and safety circuit",
        "Comfortable operation with rotary encoder and graphic display",
        "Connection of an external HD monitor possible",
        "Possibility of control by PC software via Ethernet or RS232",
        "Minimal installation effort, no software maintenance",
        "Saving and retrieval of parameters directly on the sequencer",
        "Devices can be cascaded",
        "Adjustable repeat of sequences",
        "Freely programmable trigger programs",
        "19″ rack mount",
        "Developed and manufactured in Germany"
    ]
    
    }
    , 
    "de":{"Eigenschaften:":
     [
        "Steuern hochgenauer Abläufe mit FPGA-Technik",
        "Ausgabe von 8 bis zu 72 Triggerkanälen",
        "Gute Kompatibilität mit Geräten durch optische und elektrische 12V Ausgäng",
        "Kanalausgabe als Triggersignal und invertiertes Triggersignal",
        "Synchronisation der Triggersignale mit einer Bezugsgröße oder externen Signal",
        "Interner Zero Crossing Detector (ZCD)",
        "Schalter für Start, Reset, Bereitschaft und Sicherheitskreis",
        "Komfortable Bedienung mit Drehgeber und Grafikdisplay",
        "Anschluss eines externen HD-Monitors möglich",
        "Gerät kann autark ohne PC verwendet werden",
        "Möglichkeit der Steuerung per PC-Software über Ethernet oder RS232",
        "Geringer Installationsaufwand, keine Softwarepflege",
        "Speichern und Abrufen von Parametern direkt am Sequenzer",
        "Geräte kaskadierbar",
        "Einstellbare Wiederholungen von Sequenzen",
        "Freie programmierbarkeit der Triggerprogramme",
        "19″ Rackeinbau",
        "Deutsches Produkt"
    ]
    
    }
    }' ,
    2000,
    'EUR',
    'Frontend/images/sequenzer.jpg',
    '{"en":{
        "image1": {
            "path": "Frontend\\images\\sequenzer.jpg",
            "caption": "English caption"
        },
        "image2": {
            "path": "Frontend\\images\\EMC_Sequencer _ AVT_GmbH1.png",
            "caption": "English caption"
        },
        "video1": {
            "path": "Frontend\\images\\avt_usb_converter.mp4",
            "caption": "English caption"
        }
    },
    
    "de": {
        "image1": {
            "path": "Frontend\\images\\sequenzer.jpg",
            "caption": "German caption"
        },
        "image2": {
            "path": "Frontend\\images\\EMC_Sequencer _ AVT_GmbH1.png",
            "caption": "German caption"
        },
        "video1": {
            "path": "Frontend\\images\\avt_usb_converter.mp4",
            "caption": "German caption"
        }
    }
}',
    CURRENT_TIMESTAMP,
    CURRENT_TIMESTAMP
);



-- SQLite
-- Insert sample data into the Product table Sequenzer Help Light
INSERT INTO Product (
    ProductID,
    CategoryID,
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
    '10',
    '3',
    '{
    "en": {
        "ProductName": "AVT EMC HELP"
    },
    "de": {
        "ProductName": "AVT EMC HILFE"
    }
    
    }',
   '{
    "en": {
        "ProductMiniDescription": "Anti-panic LED light during powerloss for EMC halls,  measuring cabins and for all environments with special electromagnetic requirements."
    },
    "de": {
        "ProductMiniDescription": "Anti-Panik-LED-Leuchte bei Stromausfall für EMV-Hallen, Messkabinen und für alle Umgebungen mit besonderen elektromagnetischen Anforderungen."
    }
}', 
     
     '{"en":{"Features":
     [
        "Highly Emmission-free Light during Powerloss (HELP)",
        "Designed for EMC-laboratories and test fields with 5 W power",
        "Selectable color rendering value Ra (CRI) between 65... 90 typ.",
        "Selectable light signs or plates",
        "Minimal EMC interference (noise level)",
        "Selectable light color (2700 K - 5000 K)",
        "Battery power for more than 1 hour during powerloss",
        "Supply voltage 230 VAC (optional different)",
        "Developed and manufactured in Germany"
    ],
    "Options": [
        "Extended battery power",
        "Different power of LEDs",
        "Various housing colors"
    ],
    "Additional services":[
        "Cable extensions for LED lamps",
        "Installation services",
        "Planning and lighting calculations"   
    ],
    "Warranty":[
        "Standard: 2 years; optionally extendable by 1 year each"
    ],

    "Flyer Link": [
        "path": "Frontend\\flayers\\AVT_EMC_HELP-Flyer_en_v1_00.pdf"
    ]

    }
    , 
    "de":{"Eigenschaften:":
     [
        "Hochemissionsfreies Licht bei Leistungsverlust (HELP)",
        "Konzipiert für EMV-Labore und Testfelder mit 5 W Leistung",
        "Wählbarer Farbwiedergabewert Ra (CRI) zwischen 65... 90 typ.",
        "Wählbare Lichtzeichen oder Schilder",
        "Minimale EMV-Störungen (Rauschpegel)",
        "Auswählbare Lichtfarbe (2700 K - 5000 K)",
        "Batterieleistung für mehr als 1 Stunde bei Stromausfall",
        "Versorgungsspannung 230 VAC (optional anders)",
        "Deutsches Produkt"
    ],
    "Optionen:": [
        "Erweiterte Batterieleistung",
        "Unterschiedliche Leistung der LEDs",
        "Verschiedene Gehäusefarben"

    ],
    "Zusätzliche Dienstleistungen:": [
        "Kabelverlängerungen für LED-Leuchten",
        "Installationsdienstleistungen",
        "Planung und Beleuchtungsberechnungen"    
    ],
    "Garantie:":[
        "Standard: 2 Jahre; optional verlängerbar um je 1 Jahre"
    ],

    "Flugblatt Link:": [
        "path": "Frontend\\flayers\\AVT_EMC_HELP-Flyer_en_v1_00.pdf"
    ]

    }
    }' ,
    1000,
    'EUR',
    'Frontend/images/Help01.jpg',
    '{"en":{
        "image1": {
            "path": "Frontend\\images\\Help01.jpg",
            "caption": "English caption"
        },
        "image2": {
            "path": "Frontend\\images\\HELP_light5.png",
            "caption": "English caption"
        },
        "image3": {
            "path": "Frontend\\images\\HELP_light7a.png",
            "caption": "English caption"
        }
    },
    
    "de": {
        "image1": {
            "path": "Frontend\\images\\Help01.jpg",
            "caption": "German caption"
        },
        "image2": {
            "path": "Frontend\\images\\HELP_light5.png",
            "caption": "German caption"
        },
        "image3": {
            "path": "Frontend\\images\\HELP_light7a.png",
            "caption": "German caption"
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

DROP TABLE IF EXISTS ComponentValue;

DELETE FROM ProductComponent
WHERE ProductID IN('1');

-- SQLite
-- Insert sample data into the Component table
INSERT INTO Component (ComponentID,ComponentName, created_at, updated_at) VALUES
    ('1','4K Minicam Lens',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('2','Fiber Optics', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('3','Power Supply',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('4','Power Plug',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('5','Geographic area for power',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('6','Software',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
      ('7','Thermocam Lens',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

      INSERT INTO Component (ComponentID,ComponentName, created_at, updated_at) VALUES
    ('8','Color Temperature',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('9','Reflector', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('10','Lamp 100 Variant',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

      INSERT INTO Component (ComponentID,ComponentName, created_at, updated_at) VALUES
    ('11','{
    "en": {
        "ComponentName": "Object Area"
    },
    "de": {
        "ComponentName": "Objekt Bereich"
    }
}',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);


-- SQLite
-- Insert sample data into the Component table
INSERT INTO Component (ComponentID,ComponentName, created_at, updated_at) VALUES
    ('1','{"en":{ 4K MiniCam Lens
       
    },
    
    "de": {
        4K-MiniCam Objektive

    }
}',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('2','{"en":{ Fiber Optics
       
    },
    
    "de": {
        Glasfaserkabel


    }
}', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('3','{"en":{ Power Supply
       
    },
    
    "de": {
       Stromversorgung



    }
}',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('4','{"en":{ Power Plug
       
    },
    
    "de": {
       Netzanschlussstecker
    }
}',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('5','{"en":{ Geographic area for power
       
    },
    
    "de": {
      Geografische Region für die Stromversorgung




    }
}',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('6','{"en":{Software      
    },
    
    "de": {
       Software
    }
}',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
      ('7','{"en":{ ThermoCam Lens
       
    },
    
    "de": {
       ThermoCam Objektive



    }
}',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
      ('8','{"en":{Color Temperature
       
    },
    
    "de": {
       Bitte wählen Sie die Komponenten aus:




    }
}',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('9','{"en":{ Reflector
       
    },
    
    "de": {
       Reflektor




    }
}', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('10','{"en":{  EMVLED 100 Variants
       
    },
    
    "de": {
       EMVLED 100 Varianten




    }
}',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);


     UPDATE Category
SET CategoryName = '{
    "en": {
        "CategoryName": "LED Lamp"
    },
    "de": {
        "CategoryName": "LED Leuchte"
    }
}'
WHERE CategoryID = 2;


 UPDATE ComponentValue
SET ComponentValueName = '{
    "en": {
        "ComponentValueName": "110 VAC/60 Hz"
    },
    "de": {
        "ComponentValueName": "110 VAC/60 Hz"
    }
}'

WHERE ComponentValueID = 15;


     UPDATE Component
SET ComponentName = '{
    "en": {
        "ComponentName": "4K MiniCam Power Supply (AC to 5VDC)"
    },
    "de": {
        "ComponentName": "4K MiniCam Stromversorgung (AC to 5VDC)"
    }
}'

WHERE ComponentID = 3;



     UPDATE Product
SET ProductName = '{
    "en": {
        "ProductName": "4K MiniCam"
    },
    "de": {
        "ProductName": "4K MiniCam"
    }
}'

WHERE ProductID = 1;

 UPDATE Product
SET ProductName = '{
    "en": {
        "ProductName": "ThermoCam"
    },
    "de": {
        "ProductName": "ThermoCam"
    }
}'

WHERE ProductID = 2;

UPDATE Product
SET ProductName = '{
    "en": {
        "ProductName": "Lamp EMVLED 100"
    },
    "de": {
        "ProductName": "Leuchte EMVLED 100"
    }
}'

UPDATE Product
SET ProductPrice = '2000'

WHERE ProductID = 9;

UPDATE Product
SET ProductName = '{
    "en": {
        "ProductName": "Lamp EMVLED 24/40"
    },
    "de": {
        "ProductName": "Leuchte EMVLED 24/40"
    }
}'

WHERE ProductID = 5;

UPDATE Product
SET ProductName = '{
    "en": {
        "ProductName": "EMC LED Driver"
    },
    "de": {
        "ProductName": "EMV LED Treiber"
    }
}'

WHERE ProductID = 6;

UPDATE Product
SET ProductName = '{
    "en": {
        "ProductName": "EMC USB Converter"
    },
    "de": {
        "ProductName": "EMV USB Konverter"
    }
}'

WHERE ProductID = 7;

UPDATE Product
SET ProductName = '{
    "en": {
        "ProductName": "Sequenzer AVT NT01 "
    },
    "de": {
        "ProductName": "Sequenzer AVT NT01 "
    }
}'

WHERE ProductID = 8;




-- SQLite
-- Insert sample data into the ProductComponent table
INSERT INTO ProductComponent (ProductID,ComponentID, created_at, updated_at) VALUES
    ('1', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('1', '2', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('1', '3',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('1', '4',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('1', '5',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('1', '6',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('2', '7', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('2', '2', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('2', '3',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('2', '4',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('2', '5',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('2', '6',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

     INSERT INTO ProductComponent (ProductID,ComponentID, created_at, updated_at) VALUES
    
     ('3', '8', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('3', '9', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('3', '4',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('3', '10',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('3', '5',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

     INSERT INTO ProductComponent (ProductID,ComponentID, created_at, updated_at) VALUES
    
     ('4', '4', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('4', '5', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('4', '8',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('4', '13',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('4', '16',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

      INSERT INTO ProductComponent (ProductID,ComponentID, created_at, updated_at) VALUES
    
     ('5', '17', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('5', '4', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('5', '5',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('5', '8',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('5', '9',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('5', '13',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

     
     INSERT INTO ProductComponent (ProductID,ComponentID, created_at, updated_at) VALUES
    
     ('11', '27', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('11', '2', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

     INSERT INTO ProductComponent (ProductID,ComponentID, created_at, updated_at) VALUES
    
     ('7', '18', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('7', '2', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('7', '4',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('7', '19',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

      INSERT INTO ProductComponent (ProductID,ComponentID, created_at, updated_at) VALUES
    
     ('8', '20', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO ProductComponent (ProductID,ComponentID, created_at, updated_at) VALUES
    ('1', '11', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

    INSERT INTO ProductComponent (ProductID,ComponentID, created_at, updated_at) VALUES
    ('2', '21', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

    INSERT INTO ProductComponent (ProductID,ComponentID, created_at, updated_at) VALUES
    ('2', '26', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
-- SQLite
-- Insert sample data into the ComponentValue table
INSERT INTO ComponentValue (ComponentValueID,ComponentID,ComponentValueName,ComponentValuePrice,ComponentValueCurrency,created_at,updated_at) VALUES
    ('1', '1','3.2mm',NULL,'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('2', '1','4.5mm',NULL,'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('3', '1','6.8mm',NULL,'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('4', '1','12mm',NULL,'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('5', '2','10m',NULL,'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('6', '2','20m',NULL,'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('7', '2','30m',NULL,'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('8', '2','40m','100','EUR',CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('9', '2','70m','200','EUR',CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('10', '2','100m','300','EUR',CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('11', '3','Hardened switching power supply 230V/5V ',NULL,'EUR',CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('12', '3','Hardened nonswitching power supply 230V/5V ',NULL,'EUR',CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('13', '3',' Accumulator/chargeable batterie inside camera ',NULL,'EUR',CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('14', '5',' 230 V/ 50 Hz ',NULL,'EUR',CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('15', '5',' 110 VAC @ 60Hz ',NULL,'EUR',CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('16', '6',' Basic ',NULL,'EUR',CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('17', '6',' Minicam Plus ','2000','EUR',CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
      ('18', '7','4 mm',NULL,'EUR',CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('19', '7','6 mm',NULL,'EUR',CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('20', '7','9 mm',NULL,'EUR',CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('21', '8','2700 K',NULL,'EUR',CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('22', '8','3000 K',NULL,'EUR',CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('23', '8','4000 K',NULL,'EUR',CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('24', '9','15°',NULL,'EUR',CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('25', '9','30°',NULL,'EUR',CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('26', '9','40°',NULL,'EUR',CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('27', '9','80°',NULL,'EUR',CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('28', '10','Variant 2',NULL,'EUR',CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('29', '10','Variant 3',NULL,'EUR',CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);



UPDATE Category
SET CategoryName = '{
    "en": {
        "CategoryName": "Audio Visual Equipment"
    },
    "de": {
        "CategoryName": "Audio Visuelle System"
    }
}'

WHERE CategoryID = 1;

     
     UPDATE ComponentValue
SET ComponentValueName = '{
    "en": {
        "ComponentValueName": "Variant 3"
    },
    "de": {
        "ComponentValueName": "Variante 3"
    }
}'

WHERE ComponentValueID = 29;


 UPDATE ComponentValue
SET ComponentValueName = '{
    "en": {
        "ComponentValueName": "12 mm"
    },
    "de": {
        "ComponentValueName": "12 mm"
    }
}'
WHERE ComponentValueID = 4;


UPDATE ComponentValue
SET ComponentValueName = '{
    "en": {
        "ComponentValueName": "2x AVT-EMVLED-040 + 1x driver"
    },
    "de": {
        "ComponentValueName": "2x AVT-EMVLED-040 + 1x Treiber"
    }
}'

WHERE ComponentValueID = 46;

UPDATE Product
SET ProductPrice = '2000'

WHERE ProductID = 11;

UPDATE Product
SET ProductHomeImagePath =  'Frontend/images/HelpLight.png'

WHERE ProductID = 10;


UPDATE Product
SET ProductCurrency = 'EUR'

WHERE ProductID = 5;



INSERT INTO Component (ComponentID,ComponentName, created_at, updated_at) VALUES
    ('12','{
    "en": {
        "ComponentName": "Length of Cable Between Driver and Lamp"
    },
    "de": {
        "ComponentName": "Länge der Kabel zwischen Treiber und Lampe"
    }
}',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),

 ('13','{
    "en": {
        "ComponentName": "Length of Cable Between Driver and Power Plug"
    },
    "de": {
        "ComponentName": "Kabellänge zwischen Treiber und Netzstecker"
    }
}',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO Component (ComponentID,ComponentName, created_at, updated_at) VALUES
    ('14','{
    "en": {
        "ComponentName": "Length of Cabel"
    },
    "de": {
        "ComponentName": "Länge der Kabel"
    }
}',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

 
INSERT INTO Component (ComponentID,ComponentName, created_at, updated_at) VALUES
    ('15','{
    "en": {
        "ComponentName": "Variant 2 Power Plug"
    },
    "de": {
        "ComponentName": "Variante 2 Netzanschlussstecker"
    }
}',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO Component (ComponentID,ComponentName, created_at, updated_at) VALUES
    ('16','{
    "en": {
        "ComponentName": "EMVLED 75 Variant"
    },
    "de": {
        "ComponentName": "EMVLED 75 Varianten"
    }
}',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO Component (ComponentID,ComponentName, created_at, updated_at) VALUES
    ('17','{
    "en": {
        "ComponentName": "Lamp EMVLED 24/40"
    },
    "de": {
        "ComponentName": "Lampe EMVLED 24/40"
    }
}',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO Component (ComponentID,ComponentName, created_at, updated_at) VALUES
    ('18','{
    "en": {
        "ComponentName": "USB-device types"
    },
    "de": {
        "ComponentName": "USB-Geräte-Typen"
    }
}',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO Component (ComponentID,ComponentName, created_at, updated_at) VALUES
    ('19','{
    "en": {
        "ComponentName": "Internal Power Supply Option"
    },
    "de": {
        "ComponentName": "Interne Stromversorgungsoptionen"
    }
}',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO Component (ComponentID,ComponentName, created_at, updated_at) VALUES
    ('20','{
    "en": {
        "ComponentName": "Sequencer"
    },
    "de": {
        "ComponentName": "Sequenzer "
    }
}',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO Component (ComponentID,ComponentName, created_at, updated_at) VALUES
    ('21','{
    "en": {
        "ComponentName": "Thermocam Software"
    },
    "de": {
        "ComponentName": "Thermocam Software"
    }
}',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO Component (ComponentID,ComponentName, created_at, updated_at) VALUES
    ('22','{
    "en": {
        "ComponentName": "Length of Cable Between Power Supply and Power Plug"
    },
    "de": {
        "ComponentName": "Länge des Kabels zwischen Netzgerät und Netzstecker"
    }
}',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);


INSERT INTO Component (ComponentID,ComponentName, created_at, updated_at) VALUES
    ('26','{
    "en": {
        "ComponentName": "ThermoCam Stromversorgung (AC to 5VDC)"
    },
    "de": {
        "ComponentName": "ThermoCam Stromversorgung (AC to 5VDC)"
    }
}',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);


INSERT INTO Component (ComponentID,ComponentName, created_at, updated_at) VALUES
    ('23','{
    "en": {
        "ComponentName": "Help Light Color Temperature"
    },
    "de": {
        "ComponentName": "Hilfe Licht Farbtemperatur"
    }
}',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO Component (ComponentID,ComponentName, created_at, updated_at) VALUES
    ('24','{
    "en": {
        "ComponentName": "Help Light Battery"
    },
    "de": {
        "ComponentName": "Hilfe Licht Batterie"
    }
}',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);


INSERT INTO Component (ComponentID,ComponentName, created_at, updated_at) VALUES
    ('25','{
    "en": {
        "ComponentName": "Help Light Power supply"
    },
    "de": {
        "ComponentName": "Hilfe Licht Stromversorgung"
    }
}',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);




INSERT INTO Component (ComponentID,ComponentName, created_at, updated_at) VALUES
    ('27','{
    "en": {
        "ComponentName": "Intercom Power supply"
    },
    "de": {
        "ComponentName": "Intercom Stromversorgung"
    }
}',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);


INSERT INTO ComponentValue (ComponentValueID,ComponentID,ComponentValueName,ComponentValuePrice,ComponentValueCurrency,created_at,updated_at) VALUES
    ('69', '27','{
    "en": {
        "ComponentValueName": "M: mains supply"
    },
    "de": {
        "ComponentValueName": "M: Netzversorgung"
    }
}',NULL,'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('70', '27','{
    "en": {
        "ComponentValueName": "B: battery powered"
    },
    "de": {
        "ComponentValueName": "B: batteriebetrieben"
    }
}',NULL,'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);







INSERT INTO ComponentValue (ComponentValueID,ComponentID,ComponentValueName,ComponentValuePrice,ComponentValueCurrency,created_at,updated_at) VALUES
    ('66', '26','{
    "en": {
        "ComponentValueName": "Hardened switching power supply"
    },
    "de": {
        "ComponentValueName": "EMV-feste Schaltnetzteile"
    }
}',NULL,'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('67', '26','{
    "en": {
        "ComponentValueName": "Hardened nonswitching power supply "
    },
    "de": {
        "ComponentValueName": "EMV-feste Analognetzteile"
    }
}',NULL,'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
 ('68', '26','{
    "en": {
        "ComponentValueName": "Accumulator/chargeable batterie inside camera "
    },
    "de": {
        "ComponentValueName": "Akkumulator innerhalb der Kamera"
    }
}',NULL,'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO ComponentValue (ComponentValueID,ComponentID,ComponentValueName,ComponentValuePrice,ComponentValueCurrency,created_at,updated_at) VALUES
    ('30', '12','{
    "en": {
        "ComponentValueName": "2m"
    },
    "de": {
        "ComponentValueName": "2m"
    }
}',NULL,'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('31', '12','{
    "en": {
        "ComponentValueName": "3m"
    },
    "de": {
        "ComponentValueName": "3m"
    }
}',NULL,'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
 ('32', '12','{
    "en": {
        "ComponentValueName": "5m"
    },
    "de": {
        "ComponentValueName": "5m"
    }
}',NULL,'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
 ('33', '13','{
    "en": {
        "ComponentValueName": "1.5m"
    },
    "de": {
        "ComponentValueName": "1.5m"
    }
}',NULL,'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
 ('34', '13','{
    "en": {
        "ComponentValueName": "3m"
    },
    "de": {
        "ComponentValueName": "3m"
    }
}',NULL,'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
 ('35', '13','{
    "en": {
        "ComponentValueName": "4.5m"
    },
    "de": {
        "ComponentValueName": "4.5m"
    }
}',NULL,'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);




INSERT INTO ComponentValue (ComponentValueID, ComponentID, ComponentValueName, ComponentValuePrice, ComponentValueCurrency, created_at, updated_at) VALUES
    ('58', '23', '{
        "en": {
            "ComponentValueName": "2700 K"
        },
        "de": {
            "ComponentValueName": "2700 K"
        }
    }', NULL, 'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('59', '23', '{
        "en": {
            "ComponentValueName": "3000 K"
        },
        "de": {
            "ComponentValueName": "3000 K"
        }
    }', NULL, 'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('60', '23', '{
        "en": {
            "ComponentValueName": "3500 K"
        },
        "de": {
            "ComponentValueName": "3500 K"
        }
    }', NULL, 'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('61', '23', '{
        "en": {
            "ComponentValueName": "4000 K"
        },
        "de": {
            "ComponentValueName": "4000 K"
        }
    }', NULL, 'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('62', '23', '{
        "en": {
            "ComponentValueName": "5000 K"
        },
        "de": {
            "ComponentValueName": "5000 K"
        }
    }', NULL, 'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('63', '24', '{
        "en": {
            "ComponentValueName": "LE (Lead)"
        },
        "de": {
            "ComponentValueName": "LE (Blei)"
        }
    }', NULL, 'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('64', '24', '{
        "en": {
            "ComponentValueName": "LI (LiFePO4)"
        },
        "de": {
            "ComponentValueName": "LI (LiFePO4)"
        }
    }', NULL, 'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('65', '25', '{
        "en": {
            "ComponentValueName": "230 VAC (50 Hz)"
        },
        "de": {
            "ComponentValueName": "230 VAC (50 Hz)"
        }
    }', NULL, 'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);




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
           */




-- SQLite
-- Insert sample data into the Category table
INSERT INTO Category (CategoryID,CategoryName, created_at, updated_at) VALUES
        ('1','Camera',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
        ('2','Led', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     
     
     
        ('3','Other',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);


UPDATE Product
SET ProductMultimediaPath = '{"en":{
        "image1": {
            "path": "Frontend\\images\\HelpLight.png",
            "caption": "English caption"
        },
        "image2": {
            "path": "Frontend\\images\\HELP_light5.png",
            "caption": "English caption"
        },
        "image3": {
            "path": "Frontend\\images\\HELP_light7a.png",
            "caption": "English caption"
        }
    },
    
    "de": {
        "image1": {
            "path": "Frontend\\images\\HelpLight.png",
            "caption": "German caption"
        },
        "image2": {
            "path": "Frontend\\images\\HELP_light5.png",
            "caption": "German caption"
        },
        "image3": {
            "path": "Frontend\\images\\HELP_light7a.png",
            "caption": "German caption"
        }
    }
}'
WHERE ProductID = 10;



UPDATE Product
SET ProductMultimediaPath =  '{"en":{
        "image1": {
            "path": "Frontend\\images\\CamControl02_003.png",
            "caption": "English caption"
        },
        "image2": {
            "path": "Frontend\\images\\CamControl01_002.png",
            "caption": "English caption"
        },
        "image3": {
            "path": "Frontend\\images\\CamControl01_003.png",
            "caption": "English caption"
        },
        "image4": {
            "path": "Frontend\\images\\CamControl02_001.png",
            "caption": "English caption"
        },
        "image5": {
            "path": "Frontend\\images\\CamControl02_002.png",
            "caption": "English caption"
        },
        "video1": {
            "path": "Frontend\\images\\CamControl02.mp4",
            "caption": "English caption"
        }
    },
    
    "de": {
        "image1": {
            "path": "Frontend\\images\\CamControl02_003.png",
            "caption": "German caption"
        },
        "image2": {
            "path": "Frontend\\images\\CamControl01_002.png",
            "caption": "German caption"
        },
        "image3": {
            "path": "Frontend\\images\\CamControl01_003.png",
            "caption": "English caption"
        },
        "image4": {
            "path": "Frontend\\images\\CamControl02_001.png",
            "caption": "English caption"
        },
        "image5": {
            "path": "Frontend\\images\\CamControl02_002.png",
            "caption": "English caption"
        },
        "video1": {
            "path": "Frontend\\images\\CamControl02.mp4",
            "caption": "German caption"
        }
    }
}'
WHERE ProductID = 9;

INSERT INTO Component (ComponentID,ComponentName, created_at, updated_at) VALUES
    ('7','Thermocam Lens',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);


    INSERT INTO ProductComponent (ProductID,ComponentID, created_at, updated_at) VALUES
    ('2', '7', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('2', '2', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('2', '3',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('2', '4',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('2', '5',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('2', '6',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

      INSERT INTO ProductComponent (ProductID,ComponentID, created_at, updated_at) VALUES
    ('10', '23', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('10', '24', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('10', '25',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

      INSERT INTO ProductComponent (ProductID,ComponentID, created_at, updated_at) VALUES
    ('3', '12', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('3', '13', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);



INSERT INTO ComponentValue (ComponentValueID,ComponentID,ComponentValueName,ComponentValuePrice,ComponentValueCurrency, created_at, updated_at) VALUES
    ('23', '8','2700 K',NULL,'EUR',CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('24', '8','3000 K',NULL,'EUR',CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('25', '8','4000 K',NULL,'EUR',CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('26', '9','15°',NULL,'EUR',CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('27', '9','30°',NULL,'EUR',CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('28', '9','40°',NULL,'EUR',CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('29', '9','80°',NULL,'EUR',CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('30', '10','Variant 2',NULL,'EUR',CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('31', '10','Variant 3',NULL,'EUR',CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);


     


DELETE FROM ComponentValue
WHERE ComponentValueID = '46';


DELETE FROM ProductComponent
WHERE ComponentID = '6' and ProductID= '2';




INSERT INTO ComponentValue (ComponentValueID,ComponentID,ComponentValueName,ComponentValuePrice,ComponentValueCurrency) VALUES
    ('4', '1','12mm',NULL,'EUR');
     
     ('17', '5','Other',NULL,'EUR');


     INSERT INTO ProductComponent (ProductID,ComponentID, created_at, updated_at) VALUES
    ('1', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('1', '4',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('1', '5',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

     INSERT INTO ProductComponent (ProductID,ComponentID, created_at, updated_at) VALUES
    
     ('2', '4',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
     ('2', '5',  CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

PRAGMA table_info(Component);
PRAGMA table_info(ComponentValue);
PRAGMA foreign_keys = ON;

SELECT * FROM Component WHERE ComponentID = 8;

SELECT sqlite_version();

PRAGMA integrity_check;


UPDATE Component
SET ComponentMultimediaPath = '{"en":{
        "image1": {
            "path": "Frontend\\images\\MiniCam_Akku-versions.png",
            "caption": "English caption"
        },
        "image2": {
            "path": "Frontend\\images\\Netzteil01.png",
            "caption": "English caption"
        }
    },
    
    "de": {
        "image1": {
            "path": "Frontend\\images\\MiniCam_Akku-versions.png",
            "caption": "German caption"
        },
        "image2": {
            "path": "Frontend\\images\\Netzteil01.png",
            "caption": "German caption"
        }
    }
}'
WHERE ComponentID = 3;

UPDATE Component
SET ComponentMultimediaPath = '{"en":{
       
        "image1": {
            "path": "Frontend\\images\\Netzteil01.png",
            "caption": "English caption"
        }
    },
    
    "de": {
        
        "image1": {
            "path": "Frontend\\images\\Netzteil01.png",
            "caption": "German caption"
        }
    }
}'
WHERE ComponentID = 26;



UPDATE Component
SET ComponentMultimediaPath = '{
  "en": {
    "image1": {
      "path": "Frontend\\images\\ThermoCam_Lens.png",
      "caption": "English caption"
    }
  },
  "de": {
    "image1": {
      "path": "Frontend\\images\\ThermoCam_Lens.png"
    }
  }
}'

WHERE ComponentID = 7;





UPDATE Product
SET ProductDescription =  '{"en":{"Features":
    [
        "LWIR Camera for EMC labs and test fields with high interference imunity",
        "Different resolutions",
        "Selectable focal length",
        "Selectable frame rate",
        "Wide thermal wavelength range",
        "Wide temperature range",
        "Data transmission with optical fibers",
        "Compact housing in slim design",
        "High field immunity > 200 V/m"
    ],
    "Options": [
        "Integrated rechargeable battery (5 Ah)",
        "Optic lens for different angles"
    ],
     "Flyer Link": [
        "Frontend\\flayers\\AVT_EMC4K_MIniCam_Flyer_en_v1_3.pdf"
    ]
    }
    , 
    "de":{"Eigenschaften:":
     [
        "4K Kamera für EMV Labore und Prüffelder mit hoher Störfestigkeit",
        "Unterschiedliche Auflösungen wählbar (640 x 360 bis zu 3840 x 2160)",
        "Schwenken/Neigen/Zoomen in der Kamera, gesteuert durch Software",
        "Einfache Nutzung von Hardware und Software",
        "Hochwertiger Vision-Sensor",
        "USB Video Class (UVC) kompatibel",
        "Datenübertragung mit Lichtwellenleitern (USB 3.0)",
        "Kompaktes Gehäuse in schlankem Design",
        "Hohe Störfestigkeit > 200 V/m"
    ],
    "Optionen:": [
        "Integrierter Akkumulator (5 Ah)",
        "Andere Brennweiten der Objektive"
    ],
    "Flugblatt Link:": [
        "Frontend\\flayers\\AVT_EMC4K_MIniCam_Flyer_de_v1_3.pdf"
    ]
    }
    }'
WHERE ProductID = 1;



UPDATE Product
SET ProductDescription =  '{"en":{"Features":
     [
        "LWIR Camera for EMC labs and test fields with high interference imunity",
        "Different resolutions",
        "Selectable focal length",
        "Selectable frame rate",
        "Wide thermal wavelength range",
        "Wide temperature range",
        "Data transmission with optical fibers",
        "Compact housing in slim design",
        "High field immunity > 200 V/m"
    ],
    "Options": [
        "Integrated rechargeable battery (5 Ah)",
        "Optic lens for different angles"
    ],
     "Flyer Link": [
        "Frontend\\flayers\\AVT_EMCThermoCam_Flyer_en_v1_3.pdf"
    ]
    }
    , 
    "de":{"Eigenschaften:":
     [
        "LWIR Kamera für EMV-Labore und Prüffelder mit hoher Störfestigkeit",
        "Unterschiedliche Auflösungen",
        "Auswählbare Brennweite",
        "Auswählbare Bildwiederholrate",
        "Großer thermischer Wellenlängenbereich",
        "Großer Temperaturbereich",
        "Datenübertragung mit Lichtwellenleitern",
        "Kompaktes Gehäuse in schlankem Design",
        "Hohe Störfestigkeit > 200 V/m"
    ],
    "Optionen:": [
        "Integrierter Akkumulator (5 Ah)",
        "Andere Brennweiten der Objektive"
    ],
    "Flugblatt Link:": [
        "Frontend\\flayers\\AVT_EMCThermoCam_Flyer_de_v1_3.pdf"
    ]
    }
    }'
WHERE ProductID = 2;


UPDATE Product
SET ProductDescription = '{
  "en": {
    "Features": [
      "Highly emission-free light during power loss (HELP)",
      "Designed for EMC laboratories and test fields with 5 W power",
      "Selectable color rendering value (Ra/CRI) between 65 and 90 (typ.)",
      "Selectable light signs or plates",
      "Minimal EMC interference (noise level)",
      "Selectable light color (2700 K - 5000 K)",
      "Battery power for more than 1 hour during power loss",
      "Supply voltage: 230 VAC (optional alternative)",
      "Developed and manufactured in Germany"
    ],
    "Options": [
      "Extended battery power",
      "Different power of LEDs",
      "Various housing colors"
    ],
    "Additional services": [
      "Cable extensions for LED lamps",
      "Installation services",
      "Planning and lighting calculations"
    ],
    "Warranty": [
      "Standard: 2 years; optionally extendable by 1 year each"
    ],
    "Flyer Link": [
      "Frontend\\flayers\\AVT_EMC_HELP-Flyer_en_v1_02.pdf"
    ]
  },
  "de": {
    "Eigenschaften:": [
      "Hochemissionsfreies Licht bei Leistungsverlust (HELP)",
      "Konzipiert für EMV-Labore und Testfelder mit 5 W Leistung",
      "Wählbarer Farbwiedergabewert Ra (CRI) zwischen 65 und 90 (typ.)",
      "Wählbare Lichtzeichen oder Schilder",
      "Minimale EMV-Störungen (Rauschpegel)",
      "Auswählbare Lichtfarbe (2700 K - 5000 K)",
      "Batterieleistung für mehr als 1 Stunde bei Stromausfall",
      "Versorgungsspannung: 230 VAC (optional anders)",
      "Deutsches Produkt"
    ],
    "Optionen:": [
      "Erweiterte Batterieleistung",
      "Unterschiedliche Leistung der LEDs",
      "Verschiedene Gehäusefarben"
    ],
    "Zusätzliche Dienstleistungen:": [
      "Kabelverlängerungen für LED-Leuchten",
      "Installationsdienstleistungen",
      "Planung und Beleuchtungsberechnungen"
    ],
    "Garantie:": [
      "Standard: 2 Jahre; optional verlängerbar um je 1 Jahr"
    ],
    "Flugblatt Link:": [
      "Frontend\\flayers\\AVT_EMC_HELP-Flyer_en_v1_02.pdf"
    ]
  }
}'
WHERE ProductID = 10;



UPDATE Product
SET ProductDescription =  '{"en":{"Features":
      [
        "LED light for EMC laboratories and testfield with 100 W output",
        "High luminous flux from 10,000 lm for one luminaire",
        "High color rendering index Ra (CRI) 90 to 97 (option)",
        "High efficiency, therefore low heat load",
        "Lowest electrical and electromagnetic interference (noise limit)",
        "Selectable light color (2700 K - 4000 K)",
        "Selectable opening angle (22° - 80°) of the reflectors",
        "Input voltage range (220 - 240 V~/ 50 Hz, deviating optional)",
        "Developed and manufactured in Germany"
    ],
    "Options": [
        "Dimmable on driver (40... 100%)",
        "Higher outputs with different drivers"
    ],
    "Additional services":[
        "Cable extensions for LED lamps",
        "Installation services",
        "Planning and lighting calculations"   
    ],
    "Warranty":[
        "Standard: 2 years; optionally extendable by 1 year each"
    ],
     "Flyer Link": [
        "Frontend\\flayers\\AVT_EMCLED100-Flyer_de_v1_6.pdf"
    ]
    }
    , 
    "de":{"Eigenschaften:":
     [
        "LED-Leuchte für EMV-Labore und Prüffelder mit 100 W Leistung",
        "Hoher Lichtstrom ab 10.000 lm für eine Leuchte",
        "Hoher Farbwiedergabewert Ra (CRI) 90 bis 97 (Option)",
        "Hohe Effizienz, dadurch geringe Wärmebelastung",
        "Geringste elektrische und elektromagnetische Störungen (Rauschgrenze)",
        "Auswählbare Lichtfarbe (2700 K - 4000 K)",
        "Auswählbarer Öffnungswinkel (22° - 80°) der Reflektoren",
        "Eingangsspannungsbereich (220 - 240 V~/ 50 Hz, abweichend optional)",
        "Deutsches Produkt"
    ],
    "Optionen:": [
        "Dimmbar über Treiber (40... 100%)",
        "Höhere Leistungen mit verschiedenen Treibern"
    ],
    "Zusätzliche Dienstleistungen:": [
        "Kabelverlängerungen für LED-Leuchten",
        "Installationsdienstleistungen",
        "Planung und Beleuchtungsberechnungen"    
    ],
    "Garantie:":[
        "Standard: 2 Jahre; optional verlängerbar um je 1 Jahre"
    ],
    "Flugblatt Link:": [
        "Frontend\\flayers\\AVT_EMCLED100-Flyer_de_v1_6.pdf"
    ]
    }
    }'
WHERE ProductID = 3;


UPDATE Product
SET ProductDescription =  '{"en":{"Features":
      [
        "LED light for EMC laboratories and testfield with 75 W output",
        "High luminous flux from 10,000 lm for one luminaire",
        "High color rendering index Ra (CRI) 90 to 97 (option)",
        "High efficiency, therefore low heat load",
        "Lowest electrical and electromagnetic interference (noise limit)",
        "Selectable light color (2700 K - 4000 K)",
        "Selectable opening angle (15° - 80°) of the reflectors",
        "Input voltage range (220 - 240 V~/ 50 Hz, deviating optional)",
        "Slim design - perfect fluorescent lamp replacement",
        "Developed and manufactured in Germany"
    ],
    "Options": [
        "Dimmable on driver (40... 100%)",
        "Higher outputs with different drivers"
    ],
    "Additional services":[
        "Cable extensions for LED lamps",
        "Installation services",
        "Planning and lighting calculations"   
    ],
    "Warranty":[
        "Standard: 2 years; optionally extendable by 1 year each"
    ]
,
     "Flyer Link": [
        "Frontend\\flayers\\AVT_EMCLED75-Flyer_de_v1_1.pdf"
    ]
    }
    , 
    "de":{"Eigenschaften:":
      [
        "LED-Leuchte für EMV-Labore und Prüffelder mit 75 W Leistung",
        "Hoher Lichtstrom ab 10.000 lm für eine Leuchte",
        "Hoher Farbwiedergabewert Ra (CRI) 90 bis 97 (Option)",
        "Hohe Effizienz, dadurch geringe Wärmebelastung",
        "Geringste elektrische und elektromagnetische Störungen (Rauschgrenze)",
        "Auswählbare Lichtfarbe (2700 K - 4000 K)",
        "Auswählbarer Öffnungswinkel (15° - 80°) der Reflektoren",
        "Eingangsspannungsbereich (220 - 240 V~/ 50 Hz, abweichend optional)",
        "Schlankes Design - perfekter Leuchtstofflampenersatz",
        "Deutsches Produkt"
    ],
    "Optionen:": [
        "Dimmbar über Treiber (40... 100%)",
        "Höhere Leistungen mit verschiedenen Treibern"
    ],
    "Zusätzliche Dienstleistungen:": [
        "Kabelverlängerungen für LED-Leuchten",
        "Installationsdienstleistungen",
        "Planung und Beleuchtungsberechnungen"    
    ],
    "Garantie:":[
        "Standard: 2 Jahre; optional verlängerbar um je 1 Jahre"
    ],
    "Flugblatt Link:": [
        "Frontend\\flayers\\AVT_EMCLED75-Flyer_de_v1_1.pdf"
    ]
    }
    }'
WHERE ProductID = 4;

UPDATE Product
SET ProductDescription =  '{"en":{"Features":
      [
        "LED light for EMC laboratories and testfield with up to 40 W output",
        "High luminous flux up to over 4000 lm each lamp",
        "High color rendering index Ra (CRI) 90 to 97 (option)",
        "High efficiency, therefore low heat load",
        "Lowest electrical and electromagnetic interference (noise limit)",
        "Selectable light color (2700 K - 5000 K)",
        "Selectable opening angle (15° - 80°) of the reflectors",
        "Supply voltage for driver range 230 VAC (optional different)",
        "Developed and manufactured in Germany"
    ],
    "Options": [
        " Dimmable on driver (40... 100%)",
        "Higher outputs with different drivers"
    ],
    "Additional services":[
        "Cable extensions for LED lamps",
        "Installation services",
        "Planning and lighting calculations"   
    ],
    "Warranty":[
        "Standard: 2 years; optionally extendable by 1 year each"
    ],
     "Flyer Link": [
        "Frontend\\flayers\\AVT_EMCLED024_40-Flyer_en_v1_1.pdf"
    ]
    }
    , 
    "de":{"Eigenschaften:":
      [
        "LED-Leuchte für EMV-Labore und Prüffeld mit bis zu 40 W Leistung",
        "Hoher Lichtstrom bis zu über 4000 lm pro Lampe",
        "Hoher Farbwiedergabewert Ra (CRI) 90 bis 97 (Option)",
        "Hohe Effizienz, dadurch geringe Wärmebelastung",
        "Geringste elektrische und elektromagnetische Störungen (Rauschgrenze)",
        "Auswählbare Lichtfarbe (2700 K - 5000 K)",
        "Auswählbarer Öffnungswinkel (15° - 80°) der Reflektoren",
        "Versorgungsspannung für Treiberbereich 230 VAC (optional abweichend)",
        "Deutsches Produkt"
    ],
    "Optionen:": [
        "Dimmbar über Treiber (40... 100%)",
        "Höhere Leistungen mit verschiedenen Treibern"
    ],
    "Zusätzliche Dienstleistungen:": [
        "Kabelverlängerungen für LED-Leuchten",
        "Installationsdienstleistungen",
        "Planung und Beleuchtungsberechnungen"    
    ],
    "Garantie:":[
        "Standard: 2 Jahre; optional verlängerbar um je 1 Jahre"
    ],
    "Flugblatt Link:": [
        "Frontend\\flayers\\AVT_EMCLED024_40-Flyer_en_v1_1.pdf"
    ]
    }
    }'
WHERE ProductID = 5;

UPDATE Product
SET ProductDescription =  '{"en":{"Features":
        [
        "Control of highly precise processes with FPGA technology",
        "From 8 to 72 output trigger channels",
        "Good compatibility with devices because of optical and electrical 12V outputs",
        "Channel output as trigger signal and inverted trigger signal",
        "Synchronization of the trigger signals with a reference variable or external signal",
        "Switches for start, reset, standby and safety circuit",
        "Comfortable operation with rotary encoder and graphic display",
        "Connection of an external HD monitor possible",
        "Possibility of control by PC software via Ethernet or RS232",
        "Minimal installation effort, no software maintenance",
        "Saving and retrieval of parameters directly on the sequencer",
        "Devices can be cascaded",
        "Adjustable repeat of sequences",
        "Freely programmable trigger programs",
        "19″ rack mount",
        "Developed and manufactured in Germany"
    ],
     "Flyer Link": [
        "https://www.avt-ilmenau.de/wp-content/uploads/2024/03/AVT_NT01-Flyer_en_v1_02.pdf"
    ]
    }
    , 
    "de":{"Eigenschaften:":
       [
        "Steuern hochgenauer Abläufe mit FPGA-Technik",
        "Ausgabe von 8 bis zu 72 Triggerkanälen",
        "Gute Kompatibilität mit Geräten durch optische und elektrische 12V Ausgäng",
        "Kanalausgabe als Triggersignal und invertiertes Triggersignal",
        "Synchronisation der Triggersignale mit einer Bezugsgröße oder externen Signal",
        "Interner Zero Crossing Detector (ZCD)",
        "Schalter für Start, Reset, Bereitschaft und Sicherheitskreis",
        "Komfortable Bedienung mit Drehgeber und Grafikdisplay",
        "Anschluss eines externen HD-Monitors möglich",
        "Gerät kann autark ohne PC verwendet werden",
        "Möglichkeit der Steuerung per PC-Software über Ethernet oder RS232",
        "Geringer Installationsaufwand, keine Softwarepflege",
        "Speichern und Abrufen von Parametern direkt am Sequenzer",
        "Geräte kaskadierbar",
        "Einstellbare Wiederholungen von Sequenzen",
        "Freie programmierbarkeit der Triggerprogramme",
        "19″ Rackeinbau",
        "Deutsches Produkt"
    ],
    "Flugblatt Link:": [
        "https://www.avt-ilmenau.de/wp-content/uploads/2021/12/nt01_flyer_de.pdf"
    ]
    }
    }'
WHERE ProductID = 8;

UPDATE Product
SET ProductDescription =  
    '{"en":{"Features":
     [
        "USB 1.0 - 3.0 Converter",
        "USB-device types 1.0 - 2.0 and 3.0",
        "Maximum transmission data rate up to 5 Gbit/s",
        "Full data transparency (no driver dependency)",
        "Power supply for EUT with 5 V / 3 A /15 W",
        "Power supply device with 85 - 250 VAC / 47 - 63 Hz",
        "Data transmission and control with fiber optic cable",
        "Variants of fiber cable length 10 m / 20 m / 30 m / 50 m / 70 m / 100 m",
        "High interference immunity > 200 V/m",
        "Developed and manufactured in Germany"
    ],

    "Flyer Link": [
        "Frontend\\flayers\\AVT_EMVUSB_Converter-Flyer_en_v1_2.pdf"
    ]

    }
    , 
    "de":{"Eigenschaften:":
     [
        "USB 1.0 - 3.0 Konverter",
        "Gerätetypen für USB 1.0 - 2.0 und 3.0",
        "Maximale Übertragungsgeschwindigkeit bis 5 Gbit/s",
        "Volle Datentransparenz (keine Treiberabhängigkeit)",
        "Spannungsversorgung EUT mit 5 V / 3 A /15 W",
        "Spannungsversorgung Gerät 85 - 250 VAC / 47 - 63 Hz",
        "Datenübertragung und Steuerung mit Lichtwellenleiter",
        "Varianten der LWL-Längen 10 m / 20 m / 30 m / 50 m / 70 m / 100 m",
        "Hohe Störfestigkeit > 200 V/m",
        "Deutsches Produkt"
    ],
    "Flugblatt Link:": [
        "Frontend\\flayers\\AVT_EMVUSB_Converter-Flyer_de_v1_2.pdf"
    ]
    }
    }'
WHERE ProductID = 7;

UPDATE Product
SET ProductDescription =  
     
     '{"en":{"Features":
     [
        "Highly Emmission-free Light during Powerloss (HELP)",
        "Designed for EMC-laboratories and test fields with 5 W power",
        "Selectable color rendering value Ra (CRI) between 65... 90 typ.",
        "Selectable light signs or plates",
        "Minimal EMC interference (noise level)",
        "Selectable light color (2700 K - 5000 K)",
        "Battery power for more than 1 hour during powerloss",
        "Supply voltage 230 VAC (optional different)",
        "Developed and manufactured in Germany"
    ],
    "Options": [
        "Extended battery power",
        "Different power of LEDs",
        "Various housing colors"
    ],
    "Additional services":[
        "Cable extensions for LED lamps",
        "Installation services",
        "Planning and lighting calculations"   
    ],
    "Warranty":[
        "Standard: 2 years; optionally extendable by 1 year each"
    ],

    "Flyer Link": [
        "path": "Frontend\\flayers\\AVT_EMC_HELP-Flyer_en_v1_01.pdf"
    ]

    }
    , 
    "de":{"Eigenschaften:":
     [
        "Hochemissionsfreies Licht bei Leistungsverlust (HELP)",
        "Konzipiert für EMV-Labore und Testfelder mit 5 W Leistung",
        "Wählbarer Farbwiedergabewert Ra (CRI) zwischen 65... 90 typ.",
        "Wählbare Lichtzeichen oder Schilder",
        "Minimale EMV-Störungen (Rauschpegel)",
        "Auswählbare Lichtfarbe (2700 K - 5000 K)",
        "Batterieleistung für mehr als 1 Stunde bei Stromausfall",
        "Versorgungsspannung 230 VAC (optional anders)",
        "Deutsches Produkt"
    ],
    "Optionen:": [
        "Erweiterte Batterieleistung",
        "Unterschiedliche Leistung der LEDs",
        "Verschiedene Gehäusefarben"

    ],
    "Zusätzliche Dienstleistungen:": [
        "Kabelverlängerungen für LED-Leuchten",
        "Installationsdienstleistungen",
        "Planung und Beleuchtungsberechnungen"    
    ],
    "Garantie:":[
        "Standard: 2 Jahre; optional verlängerbar um je 1 Jahre"
    ],

    "Flugblatt Link:": [
        "path": "Frontend\\flayers\\AVT_EMC_HELP-Flyer_en_v1_01.pdf"
    ]

    }
    }'
WHERE ProductID = 10;

UPDATE Product
SET ProductDescription =  
     '{"en":{"Features":
     [
        "Driver power 70 W",
        "Driver EMVC immun and very low emission",
        "Driver can be installed inside or outside the EMC equipment",
        "Dimmable on driver (40... 100%)",
        "Cabling as fixed installation or as 230 V cable with plugs and sockets for LED cabling",
        "Developed and manufactured in Germany"
    ],
    "Options": [
        "Different housing colors possible (black as standard)",
        "Different housing forms possible"
    ],
    "Additional services":[
        "Cable extensions for LED lamps",
        "Installation services",
        "Planning and lighting calculations",
        "EMC-proof camera system with pan-tilt head"   
    ],
    "Warranty":[
        "Standard: 2 years; optionally extendable by 1 year each"
    ]

    }
    , 
    "de":{"Eigenschaften:":
     [
        "Treiberleistung 70 W",
        "Treiber EMV-fest (> 100 V/m) und besonders emmisionsarm (Rauschgrenze)",
        "Treiber kann innerhalb oder außerhalb der EMV-Kabine/Halle eingebaut werden",
        "Dimmbar über Treiber (40... 100%)",
        "Verkabelung als Festinstallation oder als 230 V Kabel mit Stecker und Buchsen der LED-Verkabelung",
        "Deutsches Produkt"
    ],
    "Optionen:": [
        "Verschiedene Gehäusefarben möglich (standardmäßig schwarz)",
        "Verschiedene Gehäuseformen möglich (abgesetzter Treiber oder mit Leuchte an Halterung)"
    ],
    "Zusätzliche Dienstleistungen:": [
        "Kabelverlängerungen für LED-Leuchten",
        "Installationsdienstleistungen",
        "Planung und Beleuchtungsberechnungen",
        "EMV-festes Kamerasystem und IR-Kamerasystem"    
    ],
    "Garantie:":[
        "Standard: 2 Jahre; optional verlängerbar um je 1 Jahre"
    ]
    }
    }'
WHERE ProductID = 6;

UPDATE Product
SET ProductDescription =  
     '{"en":{"Features":
     [
        "Control unit for AVT cameras in the visual and infrared wavelength range",
        "Controls up to 2 AVT EMC 4K MiniCams or one 4K MiniCam and one ThermoCam or 2 ThermoCams with USB3 fiber line",
        "Small housing in smart design (12,5 x10,5 x 5 cm)",
        "Output to HDMI monitors with FullHD resolution (4K resolution option)",
        "4.3 inch IPS touch display on device",
        "LEDs for power and connected cameras (Cam 1, Cam 2)",
        "Power connection via USB-C plug (5 A)",
        "Automatic detection of connected cameras",
        "Realization of camera functions (pan/tilt/zoom/resolution/ compression/brightness/contrast/temperature etc.)"
    ],
    "Options": [
        "Mouse and keyboard connection",
        "Ethernet connection to PC or Laptop"
    ],
     "Flyer Link": [
        "Frontend\\flayers\\AVT_EMC_CamControl_Flyer_en_v1_1.pdf"
    ]
    }
    , 
    "de":{"Eigenschaften:":
     [
        "Steuergerät für AVT-Kameras im visuellen und infraroten Wellenlängenbereich",
        "Steuert bis zu 2 AVT EMC 4K MiniCams oder eine 4K MiniCam und eine ThermoCam oder 2 ThermoCams mit USB3-Faserleitung",
        "Kleines Gehäuse im eleganten Design (12,5 x10,5 x 5 cm)",
        "Ausgabe an HDMI-Monitore mit FullHD-Auflösung (4K-Auflösung optional)",
        "4,3 Zoll IPS-Touch-Display auf dem Gerät",
        "LEDs für Stromversorgung und angeschlossene Kameras (Cam 1, Cam 2)",
        "Stromanschluss über USB-C-Stecker (5 A)",
        "Automatische Erkennung von angeschlossenen Kameras",
        "Realisierung von Kamerafunktionen (Schwenken/Neigen/Zoomen/Auflösung/Komprimierung/Helligkeit/Kontrast/Temperatur usw.)"
    ],
    "Optionen:": [
        "Anschluss von Maus und Tastatur",
        "Ethernet-Anschluss an PC oder Laptop"
    ],
    
   
    "Flugblatt Link:": [
        "Frontend\\flayers\\AVT_EMC_CamControl_Flyer_en_v1_1.pdf"
    ]
    }
    }'
WHERE ProductID = 9;






UPDATE Product
SET ProductMultimediaPath = '{"en":{
        "image1": {
            "path": "Frontend\\images\\4kminicam1.png",
            "caption": "English caption"
        },
        "image2": {
            "path": "Frontend\\images\\4kminicam3.png",
            "caption": "English caption"
        },
        
        
        "video1": {
            "path": "Frontend\\images\\MinicamAnimation.mp4",
            "caption": "English caption"
        }
    },
    
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
            "path": "Frontend\\images\\MinicamAnimation.mp4",
            "caption": "German caption"
        }
    }
}'
WHERE ProductID = 1;


UPDATE Product
SET ProductMultimediaPath =  '{"en":{
        "image1": {
            "path": "Frontend\\images\\thermocam_1000-768x488.jpg",
            "caption": "English caption"
        },
        "image2": {
            "path": "Frontend\\images\\thermocam2.pdf.png",
            "caption": "English caption"
        },
        "video1": {
            "path": "Frontend\\images\\ThermoCamAnimation.mp4",
            "caption": "English caption"
        }
    },
    
    "de": {
        "image1": {
            "path": "Frontend\\images\\thermocam_1000-768x488.jpg",
            "caption": "German caption"
        },
        "image2": {
            "path": "Frontend\\images\\thermocam2.pdf.png",
            "caption": "German caption"
        },
        "video1": {
            "path": "Frontend\\images\\ThermoCamAnimation.mp4",
            "caption": "German caption"
        }
    }
}'
WHERE ProductID = 2;


DROP TABLE IF EXISTS OrderItem;

PRAGMA table_info("Product");

PRAGMA foreign_key_list("OrderItem");
PRAGMA foreign_key_check;
PRAGMA table_info("Component");
PRAGMA foreign_key_list("ComponentValue");

UPDATE ComponentValue 
SET ComponentValueName = JSON_UNQUOTE(ComponentValueName)
WHERE JSON_VALID(ComponentValueName) = 0;

UPDATE ComponentValue 
SET ComponentValueName = REPLACE(REPLACE(ComponentValueName, '\\n', ''), '\\', '');


INSERT INTO ComponentValue (ComponentValueID,ComponentID,ComponentValueName,ComponentValuePrice,ComponentValueCurrency,created_at,updated_at) VALUES
    ('36', '4','{
    "en": {
        "ComponentValueName": "EU"
    },
    "de": {
        "ComponentValueName": "EU"
    }
}',NULL,'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('37', '4','{
    "en": {
        "ComponentValueName": "UK"
    },
    "de": {
        "ComponentValueName": "UK"
    }
}',NULL,'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('38', '4','{
    "en": {
        "ComponentValueName": "USA"
    },
    "de": {
        "ComponentValueName": "USA"
    }
}',NULL,'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO ComponentValue (ComponentValueID,ComponentID,ComponentValueName,ComponentValuePrice,ComponentValueCurrency,created_at,updated_at) VALUES
    ('39', '14','{
    "en": {
        "ComponentValueName": "2m"
    },
    "de": {
        "ComponentValueName": "2m"
    }
}',NULL,'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('40', '14','{
    "en": {
        "ComponentValueName": "3m"
    },
    "de": {
        "ComponentValueName": "3m"
    }
}',NULL,'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('41', '14','{
    "en": {
        "ComponentValueName": "5m"
    },
    "de": {
        "ComponentValueName": "5m"
    }
}',NULL,'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);



INSERT INTO ComponentValue (ComponentValueID,ComponentID,ComponentValueName,ComponentValuePrice,ComponentValueCurrency,created_at,updated_at) VALUES
    ('55', '22','{
    "en": {
        "ComponentValueName": "1.5m"
    },
    "de": {
        "ComponentValueName": "1.5m"
    }
}',NULL,'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('56', '22','{
    "en": {
        "ComponentValueName": "3m"
    },
    "de": {
        "ComponentValueName": "3m"
    }
}',NULL,'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('57', '22','{
    "en": {
        "ComponentValueName": "4.5m"
    },
    "de": {
        "ComponentValueName": "4.5m"
    }
}',NULL,'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);


INSERT INTO ComponentValue (ComponentValueID,ComponentID,ComponentValueName,ComponentValuePrice,ComponentValueCurrency,created_at,updated_at) VALUES
    ('42', '15','{
    "en": {
        "ComponentValueName": "With Plug"
    },
    "de": {
        "ComponentValueName": "Mit Stecker"
    }
}',NULL,'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('43', '15','{
    "en": {
        "ComponentValueName": "Without Plug"
    },
    "de": {
        "ComponentValueName": "Ohne Stecker"
    }
}',NULL,'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO ComponentValue (ComponentValueID,ComponentID,ComponentValueName,ComponentValuePrice,ComponentValueCurrency,created_at,updated_at) VALUES
    ('44', '16','{
    "en": {
        "ComponentValueName": "Variant 1"
    },
    "de": {
        "ComponentValueName": "Variante 1"
    }
}',NULL,'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO ComponentValue (ComponentValueID,ComponentID,ComponentValueName,ComponentValuePrice,ComponentValueCurrency,created_at,updated_at) VALUES
    ('45', '17','{
    "en": {
        "ComponentValueName": "Lamp EMVLED 24"
    },
    "de": {
        "ComponentValueName": "Lampe EMVLED 24"
    }
}','1540','EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),

 ('46', '17','{
    "en": {
        "ComponentValueName": "Lamp EMVLED 40"
    },
    "de": {
        "ComponentValueName": "Lampe EMVLED 40"
    }
}','1230','EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO ComponentValue (ComponentValueID,ComponentID,ComponentValueName,ComponentValuePrice,ComponentValueCurrency,created_at,updated_at) VALUES
    ('47', '18','{
    "en": {
        "ComponentValueName": "1.0 - 2.0"
    },
    "de": {
        "ComponentValueName": "1.0 - 2.0"
    }
}','1540','EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),

 ('48', '18','{
    "en": {
        "ComponentValueName": "3.0"
    },
    "de": {
        "ComponentValueName": "3.0"
    }
}','1230','EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO ComponentValue (ComponentValueID,ComponentID,ComponentValueName,ComponentValuePrice,ComponentValueCurrency,created_at,updated_at) VALUES
    ('49', '19','{
    "en": {
        "ComponentValueName": "15W"
    },
    "de": {
        "ComponentValueName": "15W"
    }
}',NULL,'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO ComponentValue (ComponentValueID,ComponentID,ComponentValueName,ComponentValuePrice,ComponentValueCurrency,created_at,updated_at) VALUES
    ('50', '20','{
    "en": {
        "ComponentValueName": "Nt01-08"
    },
    "de": {
        "ComponentValueName": "Nt01-08"
    }
}',NULL,'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),

 ('51', '20','{
    "en": {
        "ComponentValueName": "Nt01-16"
    },
    "de": {
        "ComponentValueName": "Nt01-16"
    }
}',NULL,'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),

('52', '20','{
    "en": {
        "ComponentValueName": "Nt01-64"
    },
    "de": {
        "ComponentValueName": "Nt01-64"
    }
}',NULL,'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),

('53', '20','{
    "en": {
        "ComponentValueName": "Nt01-72"
    },
    "de": {
        "ComponentValueName": "Nt01-72"
    }
}',NULL,'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO ComponentValue (ComponentValueID,ComponentID,ComponentValueName,ComponentValuePrice,ComponentValueCurrency,created_at,updated_at) VALUES
    ('54', '21','{
    "en": {
        "ComponentValueName": "ThermoCam Program"
    },
    "de": {
        "ComponentValueName": "ThermoCam Programm"
    }
}',NULL,'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);



DELETE FROM ProductComponent
WHERE ProductID = 2 AND ComponentID = 3;

