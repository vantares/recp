#!/bin/bash
domain=example.com
username=example
mkdir -p /www/$domain/files/imagen
cd /www/example.com/files/imagen
wget http://almidon.org/images/PublicDomain/balloons_2_bg_060504.jpg
wget http://almidon.org/images/PublicDomain/beach_3_bg_010503.jpg
wget http://almidon.org/images/PublicDomain/bigsur_28_bg_101203.jpg
wget http://almidon.org/images/PublicDomain/canada_40_bg_061904.jpg
wget http://almidon.org/images/PublicDomain/chips_3_bg_102602.jpg
wget http://almidon.org/images/PublicDomain/ireland_37_bg_070504.jpg
wget http://almidon.org/images/PublicDomain/roadtrip_23_bg_021604.jpg
wget http://almidon.org/images/PublicDomain/fruit_2_bg_020203.jpg
wget http://almidon.org/images/PublicDomain/coffee_01_bg_031106.jpg
wget http://almidon.org/images/PublicDomain/ireland_102_bg_061602.jpg
chown -R apache:apache /www/$domain/files/imagen
echo "
INSERT INTO imagen (imagen, archivo) VALUES ('Ballons San Diego', 'balloons_2_bg_060504.jpg'):
INSERT INTO imagen (imagen, archivo) VALUES ('Playa Ocaso', 'beach_3_bg_010503.jpg'):
INSERT INTO imagen (imagen, archivo) VALUES ('Mar Big Sur', 'bigsur_28_bg_101203.jpg'):
INSERT INTO imagen (imagen, archivo) VALUES ('Lago de Canda', 'canada_40_bg_061904.jpg'):
INSERT INTO imagen (imagen, archivo) VALUES ('Zoom de chips de computadora', 'chips_3_bg_102602.jpg'):
INSERT INTO imagen (imagen, archivo) VALUES ('Ciudad en Irlanda', 'ireland_37_bg_070504.jpg'):
INSERT INTO imagen (imagen, archivo) VALUES ('Ciudad desconocida', 'roadtrip_23_bg_021604.jpg');
INSERT INTO imagen (imagen, archivo) VALUES ('Frutas en fondo oscuro', 'fruit_2_bg_020203.jpg');
INSERT INTO imagen (imagen, archivo) VALUES ('Granos de café', 'coffee_01_bg_031106.jpg');
INSERT INTO imagen (imagen, archivo) VALUES ('Treboles de Irlanda', 'ireland_102_bg_061602.jpg');
"
# | psql -Upostgres $username
