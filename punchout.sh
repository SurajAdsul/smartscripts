clear
punchin=`date +%I:%M`
date +%I:%M%p
sendEmail -f email@email.com -t email@email.com -cc email@email.com -u [Punch-Out] $punchin -m Thanks, -s smtp.mail.yahoo.com -xu email@email.com -xp password
exit 0
